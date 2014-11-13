<?php

class SettingsajaxController extends Controller
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
    
    public function loadbrand($post){
    	$eq = array();
    	$domain = $post['domain'];
    	$domain_details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $domain_details->domain_id;
    	$c = new CDbCriteria;
		$c->condition = 'domain_id = '.$domain_id;
		$list = DomainEquityPercent::model()->findAll($c);
		if (count($list)>0){
			foreach ($list as $k=>$v){
				$eq[$v->equity_type_id] = $v->percent;
			}
		}
    	
		$types = EquityType::model()->findAll();
    	$return['html'] = $this->renderPartial('brand-settings', array('ep'=>$eq,'domain_id'=>$domain_id,'types'=>$types,'domain'=>$domain), true);
    	$this->renderJSON($return, true);
    }
    
    public function savebrandsettings($post){
    	$domain_id = $post['domain_id'];
    	$p = $post['p'];
    	$error = 0;
    	$total = 0;
    	$total_input = 0;
    	$status = false;
    	$message = "";
    	$types = EquityType::model()->findAll();
    	$c = new CDbCriteria;
    	$c->condition = 'domain_id = '.$domain_id;
    	$list = DomainEquityPercent::model()->findAll($c);
    	
    	for ($i=0;$i<count($p);$i++){
    		$total_input = $total_input + intval($p[$i]);
    	}
    	
    	if ($total_input == 100){
	    	if (count($list)>0){
	    		foreach ($list as $k=>$v){
	    			$model = DomainEquityPercent::model()->findByAttributes(array('equity_type_id'=>$v->equity_type_id,'domain_id'=>$domain_id));
	    			$model->percent = $p[$v->equity_type_id];
	    			$total = $total + intval($p[$v->equity_type_id]);
	    			if ($model->save()){
	    				
	    			}else {
	    				$error++;
	    			}
	    		}
	    	}
	    	$status = true;
    	}else {
    		$message = 'Total percentage should be 100%';
    	}
    	
    	$return['status'] = $status;
    	$return['message'] = $message;
    	$this->renderJSON($return, true);
    }
    
    
    public function loadmembers($post){
    	$members = array();
    	$i = 0;
    	$domain = $post['domain'];
    	$domain_details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $domain_details->domain_id;
    	
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
    			$mdetails = MemberEquityType::model()->findByAttributes(array('domain_id'=>$domain_id,'member_id'=>$row['member_id']));
    			if (count($mdetails) > 0){
    				$type_id = $mdetails->equity_type_id;
    			}else {
    				$type_id = "";
    			}
    			
    			$members[$i]['member_id'] = $row['member_id'];
    			$members[$i]['name'] = ucfirst($row['firstname']).' '.ucfirst($row['lastname']);
    			$members[$i]['type_id'] = $type_id;
    			
    			$i++;
    		}
    	}	
    	
    	$types = EquityType::model()->findAll();
    	
    	$return['html'] = $this->renderPartial('member-settings', array('members'=>$members,'types'=>$types,'domain'=>$domain,'domain_id'=>$domain_id), true);
    	$this->renderJSON($return, true);
    }
    
    public function savemembersettings($post){
    	$domain_id = $post['domain_id'];
    	$member_id = $post['member_id'];
    	$type_id = $post['type_id'];
    	
    	$model =  MemberEquityType::model()->findByAttributes(array('domain_id'=>$domain_id,'member_id'=>$member_id));
    	$model->domain_id = $domain_id;
    	$model->member_id = $member_id;
    	$model->equity_type_id = $type_id;
    	$model->save();
    	$return['status'] = true;
    	$return['id'] = $member_id;
    	$this->renderJSON($return, true);
    }
    
    public function expensesdatatable(){
    	$domain = Yii::app()->Ini->v('domain');
    	$domain_details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $domain_details->domain_id;
    	$columns = array('ex_id','description','amount','date_spent','added_by');
    	echo Yii::app()->Datatables->generate($columns,'ex_id','domain_expenses','domain_id='.$domain_id);
    }
    
    public function addexpenses($post){
    	$return['html'] = $this->renderPartial('_form_add_expenses', array(), true);
    	$this->renderJSON($return, true);
    }
    
    public function saveexpenses($post){
    	$description = $post['description'];
    	$amount =   $post['amount'];
    	$date =  $post['ex_date'];
    	$domain = $post['domain'];
    	$status = false;
    	
    	
    	$domain = Yii::app()->Ini->v('domain');
    	$domain_details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $domain_details->domain_id;
    	 
    	if (isset($post['ex_id'])){
    	  $model = DomainExpenses::model()->findByAttributes(array('ex_id'=>$post['ex_id']));	
    	}else {
    	  $model = new DomainExpenses();
    	}
    	$model->domain_id = $domain_id;
    	$model->amount = $amount;
    	$model->description = $description;
    	$model->date_spent = $date;
    	$model->added_by = Yii::app()->user->getId();
    	if ($model->save()){
    		$status = true;
    	}else {
    		var_dump($model->getErrors());
    	}
    	
    	$return['status'] = $status;
    	$this->renderJSON($return, true);
    }
    
    public function editexpenses($post){
    	$ex_id = $post['ex_id'];
    	$model = DomainExpenses::model()->findByAttributes(array('ex_id'=>$ex_id));
    	$return['html'] = $this->renderPartial('_form_edit_expenses', array('model'=>$model), true);
    	$this->renderJSON($return, true);
    }
    
    public function confirmdeleteexpense($post){
    	$ex_id = $post['ex_id'];
    	$model = DomainExpenses::model()->findByAttributes(array('ex_id'=>$ex_id));
    	$return['html'] = $this->renderPartial('confirm_delete_expense', array('model'=>$model), true);
    	$this->renderJSON($return, true);
    }
    
    public function deleteexpense($post){
    	$ex_id = $post['ex_id'];
    	$model = DomainExpenses::model()->findByAttributes(array('ex_id'=>$ex_id));
    	$model->delete();
    	$return['status'] = true;
    	$this->renderJSON($return, true);
    }
}