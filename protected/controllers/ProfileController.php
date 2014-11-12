<?php

class ProfileController extends Controller
{

	public $layout='/layouts/main-login';
	public $page = '';
	
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest){
			$this->pageTitle = 'Eshares.com - Dynamic equity split systems and methods for Contrib venture companies.';
			
			$model=new LoginForm;
			
			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
			
			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					$this->redirect(Yii::app()->homeUrl.'dashboard/');
			}
			// display the login form
			$this->render('index',array('model'=>$model));
			
		}else {
				$this->redirect(Yii::app()->homeUrl.'dashboard/');
		}
	}
	
	public function actionSettings(){
		
	    $this->page = 'profile';
		$param['menu'] = 'profile';
		
		if (!Yii::app()->user->isGuest){
			
			$userid = Yii::app()->user->getId();
			
			$member = Members::model()->findbyPk($userid);
			
			$param['firstname']=$member->firstname;
			$param['lastname']=$member->lastname;
			$param['email']=$member->email;
			$param['password']=$member->password;
			
			$this->render('settings',$param);
			
		}else {
			$this->redirect(Yii::app()->homeUrl);
		}
			
		
	}
	
	public function actionMycontribution(){
		$this->page = 'profile';
		$param['menu'] = 'mycontributions';
		
		$userid = Yii::app()->user->getId();
		
		$sql = "SELECT 
  members.`firstname`,
  members.`lastname`,
  contribution_type.`name`,
  domain_contributions.`amount`,
  domain_contributions.`date_added` ,
  domain_contributions.`c_id` ,
  domain_contributions.`description`
  FROM domain_contributions 
  JOIN members ON domain_contributions.`member_id` = members.`member_id`
  JOIN contribution_type ON domain_contributions.`c_type_id` = contribution_type.`c_id`
  WHERE domain_contributions.`member_id` = '".$userid."'
  ORDER BY domain_contributions.`c_id` DESC";
  
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	$rows = $dbCommand->queryAll();
		
		$param['contributions'] = $rows;
		
		$this->render('my-contributions',$param);
	}
	
}