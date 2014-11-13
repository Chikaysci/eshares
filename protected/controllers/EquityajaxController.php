<?php

class EquityajaxController extends Controller
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
    
    public function loaddashboard($post)
    {
    
    	$domain = $post['domain'];
    	$details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $details->domain_id;
    	$members = array();
    	$chart = array();
    	
    	$sql = "
    	SELECT * FROM members m
LEFT JOIN team_member tm ON (tm.`member_id` = m.`member_id`)
LEFT JOIN team t ON (t.`team_id` = tm.`team_id`)
LEFT JOIN teamrole tr ON (tr.`role_id` = tm.`role_id`)
WHERE t.`domain_id` = $domain_id ORDER BY firstname
    	
    			
    	";
    		
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	
    	$rows = $dbCommand->queryAll();
    	$i=0;
    	$brand_total = 0;
    	$p = array();
    	
    	if (count($rows) > 0){
    		foreach ($rows as $key=>$row){
    			$equity = MemberEquity::model()->findByAttributes(array('domain_id'=>$row['domain_id'],'member_id'=>$row['member_id']));
    			if (count($equity)>0){
    				$total_equity = $equity->equity_points;
    			}else {
    				$total_equity = 0;
    			}
    			
    			$brand_total = $brand_total + $total_equity;
    		}
    	}	
    	
    	
    	if (count($rows) > 0){
    		foreach ($rows as $key=>$row){
    			
    		   if ($row['picture']){
                  $avatar = 'http://manage.vnoc.com/uploads/picture/'.$row['picture'];
               }else {
                   $avatar = 'http://manage.vnoc.com/images/avatar2.png';
                }
    			
                
                $equity = MemberEquity::model()->findByAttributes(array('domain_id'=>$row['domain_id'],'member_id'=>$row['member_id']));
                if (count($equity)>0){
                	$total_equity = $equity->equity_points;
                }else {
                	$total_equity = 0;
                }

                /*if ($brand_total>0){
                  $percent = ($total_equity/$brand_total) * 100;
                }else {
                  $percent = 0;	
                }*/
               
                $etype_model =  MemberEquityType::model()->findByAttributes(array('domain_id'=>$row['domain_id'],'member_id'=>$row['member_id']));
                $etype_name = $etype_model->type->equity_name;
                $etype_id = $etype_model->equity_type_id;
                
                $etpercent_model = DomainEquityPercent::model()->findByAttributes(array('domain_id'=>$row['domain_id'],'equity_type_id'=>$etype_id));
                $equity_percent = $etpercent_model->percent;
                
                $total_slice_per_type =  Yii::app()->Ini->getTotalByEquityType($row['domain_id'],$etype_id);
                $slices =   Yii::app()->Ini->getSlicesByUserDomain($row['member_id'],$row['domain_id']);
                
                if ($slices > 0){
                   //$percent = round((($slices/$total_slice_per_type)*$equity_percent) * 100);
                	$percent = round((($slices/$total_slice_per_type) * $equity_percent),2) ;
                	$chart[$etype_id][] = array(
    		   		"label" => ucfirst($row['firstname']),
    		   		"data" => $percent
    		   );
                	
                }else {
                   $percent = 0;
                }
                
                
               $members[$i]['member_id'] = $row['member_id'];
    		   $members[$i]['avatar'] = $avatar;
    		   $members[$i]['name'] = ucfirst($row['firstname']).' '.ucfirst($row['lastname']);
    		   $members[$i]['equity'] = $total_equity;
    		   $members[$i]['role'] = $etype_name;
    		   $members[$i]['percent'] = $percent;
    		   $members[$i]['slices'] =  Yii::app()->Ini->getSlicesByUserDomain($row['member_id'],$row['domain_id']);
    		   $members[$i]['pie'] = Yii::app()->Ini->getPiePerDomain($row['member_id'],$row['domain_id']);
    		   
    		   $i++;	
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
    					"label" => $v->equity_name,
    					"data" =>intval($equity_percent)
    			);
    		}
    	}
    	
    	
    	$contributions =ContributionType::model()->findAll(array(
    	'condition' => 'c_id > 2',
    	'order'=>'c_id'
    			));
    		
    	$htmlParams = array('domain'=>$domain,'members'=>$members,'points'=>json_encode($p),'contributions'=>$contributions,'domain'=>$domain);
    	$return['html']           = $this->renderPartial('dashboard', $htmlParams, true);
    	$this->renderJSON($return, true);
    }
    
    public function seachdomain($post){
    	$keyword = $post['keyword'];
    	$sql = "Select * from domain where domain_name like '%$keyword%' ORDER BY domain_name ASC LIMIT 0, 10";
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	$rows = $dbCommand->queryAll();
    	$return['html']           = $this->renderPartial('searchlist', array('list'=>$rows,'keyword'=>$keyword), true);
    	$this->renderJSON($return, true);
    }
	
	public function deletecontribution($post){
		$selected = $post['selectedarray'];
		foreach($selected AS $id){
			DomainContributions::model()->deleteByPk($id);
		}
		
		$return['status'] = true;
    	$this->renderJSON($return, true);
	}
   
}