<?php

class EquityController extends Controller
{
	public $layout='/layouts/main-login';
	public $page = '';
	public $domain = '';
	
	public function actionDetails(){
		$this->page = 'equity';
		$domain = Yii::app()->Ini->v('t');
		if (!Yii::app()->user->isGuest){
			
			$count = Domain::model()->count("domain_name=:domain", array("domain" => $domain));
			      
			if ($count>0){
				Yii::app()->Ini->initDomain($domain);
				$param = array('domain'=>$domain);
				$this->domain = $domain;
				$this->render('details',$param);
				
			}else{
				$this->page = 'error';
				$this->render('error',array('error'=>'Team does not exist!'));
			}
		}else {
			$this->redirect(Yii::app()->homeUrl);
		}
		
	}
	
	
}