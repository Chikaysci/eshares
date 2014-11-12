<?php

class FundajaxController extends Controller
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
	
	public function addfunds($post){
		$domain = $post['domain'];
		$details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $details->domain_id;
    	$members = array();
		$sql = "
    	SELECT * FROM members m
LEFT JOIN team_member tm ON (tm.`member_id` = m.`member_id`)
LEFT JOIN team t ON (t.`team_id` = tm.`team_id`)
LEFT JOIN teamrole tr ON (tr.`role_id` = tm.`role_id`)
WHERE t.`domain_id` = '".$domain_id."' ORDER BY firstname	
    	";
    		
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$rows=$command->queryAll(); // execute a query SQL
		
		$param = array('team_members'=>$rows);
		
		$return['html'] = $this->renderPartial('_addfund', $param, true);
    	$this->renderJSON($return, true);
	}

	public function drawfunds($post){
		$param['domain'] = $post['domain'];
		$return['html'] = $this->renderPartial('_drawfund', $param, true);
    	$this->renderJSON($return, true);
	}
	
	public function savedrawfund($post){
		$domain = $post['domain'];
		$details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $details->domain_id;
		
		$amount = $post['amount'];
		//$member_id = Yii::app()->user->getId();
		$member_id = '10';
		
		$description = "Draw Fund";
		$contribution_id = "2"; //cash
		$status = false;
		
			$record = new DomainContributions();
    		$record->c_type_id = $contribution_id;
    		$record->domain_id = $domain_id;
    		$record->member_id = $member_id;
    		$record->amount = $amount;
    		$record->description = $description;
		
		if ($record->save()){
    		$status = true;
    	}
		
		
		$return['status'] = $status;
    	$this->renderJSON($return, true);
	}
	
	public function saveaddfund($post){
		$domain = $post['domain'];
		$details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $details->domain_id;
		
		$amount = $post['amount'];
		$member_id = $post['member_id'];
		
		$description = "Added fund";
		$contribution_id = "2"; //cash
		$status = false;
		
			$record = new DomainContributions();
    		$record->c_type_id = $contribution_id;
    		$record->domain_id = $domain_id;
    		$record->member_id = $member_id;
    		$record->amount = $amount;
    		$record->description = $description;
		
		if ($record->save()){
    		$status = true;
    	}
		
		
		$return['status'] = $status;
    	$this->renderJSON($return, true);
	}
}
?>