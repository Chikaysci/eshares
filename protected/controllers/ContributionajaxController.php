<?php

class ContributionajaxController extends Controller
{
   public function filters()
    {
        return array(array('application.filters.DefaultFilter', 'actions'=>'*'));
    }

    public function actionIndex()
    {
        $method = Yii::app()->Ini->v('t');
        if(method_exists(__CLASS__, Yii::app()->Ini->aN($method)))
            return $this->{Yii::app()->Ini->aN($method)}($_POST);
        return null;
    }
    
    private function renderJSON($array = array(), $status = true)
    {
    	header('Content-Type: application/json');
    	if(!is_array($array))
    		$array = array('r'=>$array);
    	if($status)
    		echo CJSON::encode(array_merge(array('s'=>1), $array));
    	else
    		echo CJSON::encode(array_merge(array('s'=>0), $array));
    	Yii::app()->Ini->end();
    }
    
    public function showaddcontribution($post){
    	$member_id = $post['member_id'];
    	$contrib = $post['contrib'];
    	$type = ContributionType::model()->findByAttributes(array('c_id'=>$contrib));
    	$return['html'] = $this->renderPartial('_form', array('member_id'=>$member_id,'type'=>$type), true);
    	$this->renderJSON($return, true);
    }
    
    public function savecontribution($post){
    	$status = false;
    	$contrib = $post['contrib'];
    	$member_id = $post['member_id'];
    	$domain = $post['domain'];
    	$description = $post['description'];
    	$amount = $post['amount'];
    	
    	$domain_details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $domain_details->domain_id;
    	
    	$contrib_details = ContributionType::model()->findByAttributes(array('c_id'=>$contrib));
    	$contrib_id = $contrib_details->c_id;
    	
    	switch ($contrib_id){
    		default:
    			$record = new DomainContributions();
    			$record->c_type_id = $contrib_id;
    			$record->domain_id = $domain_id;
    			$record->member_id = $member_id;
    			$record->amount = $amount;
    			$record->description = $description;
    	   break;
    	}
    	
    	
    	if ($record->save()){
    		$status = true;
    	}
    	$return['status'] = $status;
    	$this->renderJSON($return, true);
    }
    
    public function loadsummary($post){
    	$domain = $post['domain'];
    	$members = array();
    	$chart = array();
    	$p = array();
    	$i=0;
    	$domain_details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $domain_details->domain_id;
    	$contributions = ContributionType::model()->findAll();
    	
    	$sql = "
    	SELECT * FROM members m
    	LEFT JOIN team_member tm ON (tm.`member_id` = m.`member_id`)
    	LEFT JOIN team t ON (t.`team_id` = tm.`team_id`)
    	LEFT JOIN teamrole tr ON (tr.`role_id` = tm.`role_id`)
    	WHERE t.`domain_id` = $domain_id ORDER BY firstname
    	";
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	$rows = $dbCommand->queryAll();
    	
    	if (count($rows) > 0){
    		foreach ($rows as $key=>$row){
    			$total = 0;
    			$members[$i]['name'] = $row['firstname'].' '.$row['lastname'];
    			
    			foreach ($contributions as $k=>$v){
    				$slice = Yii::app()->Ini->getSlicesByUser($row['member_id'],$v->name,$row['domain_id']);
    				$members[$i]['type_'.$v->c_id] = $slice;
    				$total = $total + $slice;
    			}
    			
    			$percent = round(Yii::app()->Ini->getPiePerDomain($row['member_id'],$row['domain_id']),2);
    			$members[$i]['total'] = $total;
    			$members[$i]['percent'] = $percent;
    			$i++;
    			
    			
    			//get equity summary
    			
    			$etype_model =  MemberEquityType::model()->findByAttributes(array('domain_id'=>$row['domain_id'],'member_id'=>$row['member_id']));
    			$etype_name = $etype_model->type->equity_name;
    			$etype_id = $etype_model->equity_type_id;
    			
    			$etpercent_model = DomainEquityPercent::model()->findByAttributes(array('domain_id'=>$row['domain_id'],'equity_type_id'=>$etype_id));
    			$equity_percent = $etpercent_model->percent;
    			
    			$total_slice_per_type =  Yii::app()->Ini->getTotalByEquityType($row['domain_id'],$etype_id);
    			$slices =   Yii::app()->Ini->getSlicesByUserDomain($row['member_id'],$row['domain_id']);
    			
    			if ($slices > 0){
    				$percent = round((($slices/$total_slice_per_type) * $equity_percent),2) ;
    				$chart[$etype_id][] = array(
    						"name" => ucfirst($row['firstname']),
    						"type"=>$etype_name,
    						"data" => $percent
    				);
    			}	 
    			
    			
    		}
    	}
    		
    	
    	$types = EquityType::model()->findAll();
    	foreach ($types as $k=>$v){
    		$etpercent_model = DomainEquityPercent::model()->findByAttributes(array('domain_id'=>$domain_id,'equity_type_id'=>$v->type_id));
    		$equity_percent = $etpercent_model->percent;
    		 
    		if (isset($chart[$v->type_id])){
    			foreach ($chart[$v->type_id] as $v){
    				$p[] = $v;
    			}
    		}else {
    			 
    			 
    			$p[] = array(
    					"name"=>'Others',
    					"type" => $v->equity_name,
    					"data" =>intval($equity_percent)
    			);
    		}
    	}
    	
    	
    	$theodetails = DomainTheoreticalValue::model()->findByAttributes(array('domain_id'=> $domain_id));
    	if (count($theodetails)>0){
    		$theo_value = $theodetails->total; 
    	}else {
    		$theo_value = 0;
    	}
    	
    	$return['html'] = $this->renderPartial('summary', array('domain'=>$domain,'contributions'=>$contributions,'members'=>$rows,'members'=>$members,'p'=>$p,'theo_value'=>$theo_value), true);
    	$this->renderJSON($return, true);
    }
    
    public function loadcontributions($post){
    	$domain = $post['domain'];
    	$domain_details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $domain_details->domain_id;
    	$sql = "
    	SELECT members.`member_id`, members.`firstname`, members.`lastname`,`contribution_type`.`name` AS c_type,`domain_contributions`.`amount`,
`domain_contributions`.`date_added`, `domain_contributions`.`description`,`domain_contributions`.`c_id` FROM `domain_contributions`
LEFT JOIN members ON (members.`member_id` = `domain_contributions`.`member_id`)
LEFT JOIN `contribution_type` ON (`contribution_type`.`c_id` = `domain_contributions`.`c_type_id`)
WHERE `domain_contributions`.`domain_id` = $domain_id ORDER BY `domain_contributions`.`c_id` DESC
    	";
    	
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	$rows = $dbCommand->queryAll();
    	$return['html'] = $this->renderPartial('contributions', array('domain'=>$domain,'contributions'=>$rows), true);
    	$this->renderJSON($return, true);
    }
    
    
    public function showaddedittype($post){
    	$type_id = $post['type_id'];
    	$type = ContributionType::model()->findByAttributes(array('c_id'=>$type_id));
    	$return['html'] = $this->renderPartial('edit_type', array('type'=>$type), true);
    	$this->renderJSON($return, true);
    }
    
    public function savetype($post){
    	$type_name = $post['type_name'];
    	if (isset($post['type_id'])){
    		$type_id = $post['type_id'];
    		$type = ContributionType::model()->findByAttributes(array('c_id'=>$type_id));
    	}else {
    		$type = New ContributionType();
    	}
    	
    	$type->name = $type_name;
    	if ($type->save()){
    		$return['status'] = true;
    	}else {
    		$return['status'] = false;
    	}
    	$this->renderJSON($return, true);
    }
    
    public function typedatatable($post){
    	$columns = array('c_id','name','c_id');
    	echo Yii::app()->Datatables->generate($columns,'c_id','contribution_type');
    }
    
    
    public function confirmdeletetype($post){
    	$type_id = $post['type_id'];
    	$type = ContributionType::model()->findByAttributes(array('c_id'=>$type_id));
    	$return['html'] = $this->renderPartial('confirm_delete_type', array('type'=>$type), true);
    	$this->renderJSON($return, true);
    }
    
    public function deletetype($post){
    	$type_id = $post['type_id'];
    	$type = ContributionType::model()->findByAttributes(array('c_id'=>$type_id));
    	$type->delete();
    	$return['status'] = true;
    	$this->renderJSON($return, true);
    }
    
    public function addctype($post){
    	$return['html'] = $this->renderPartial('add_type_form', array(), true);
    	$this->renderJSON($return, true);
    }
}