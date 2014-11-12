<?php

class HomeController extends Controller
{
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest){
			$this->pageTitle = 'Eshares.com - Dynamic equity split systems and methods for Contrib venture companies.';
			
			$model=new LoginForm;
			$error_message = "";
			
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
				if($model->validate() && $model->login()){
					$this->redirect(Yii::app()->homeUrl.'dashboard/');
				}else {
					$error_message = "Account does not exist!";
				}	
			}
			// display the login form
			$this->render('index',array('model'=>$model,'error_message'=>$error_message));
			
		}else {
				$this->redirect(Yii::app()->homeUrl.'dashboard/');
		}
	}
}