<?php
class DashboardController extends Controller
{

	public $layout='/layouts/main-login';
	public $page = '';
	public $menu = '';
	
	public function missingAction($action)
	{
		$action=str_replace('-','_',$action);
		$action='action'.ucfirst(strtolower($action));
		if(method_exists($this,$action))
			$this->$action();
		else
			$this->actionIndex();
	}
	
	public function actionIndex(){
	    $this->page = 'dashboard';
	    $this->menu = 'dashboard';
		if (!Yii::app()->user->isGuest){
			
			$userid = Yii::app()->user->getId();
			
			$criteria = new CDbCriteria();
			$criteria->condition = "equity_points>0 and member_id = $userid  ORDER BY equity_points desc";
			$criteria->limit = 10;
			$details = MemberEquity::model()->findAll($criteria);
			
			
			$c = new CDbCriteria;
			$c->select = array(
					'SUM(equity_points) as total_equity',
			);
			$c->condition = 'member_id='.$userid;
			
			$list = MemberEquity::model()->findAll($c);
			if (count($list)>0){
				foreach ($list as $k=>$v){
					$sum = $v->total_equity;
				}
			}
			
			
			$c2 = new CDbCriteria();
			$c2->condition = "member_id = $userid  ORDER BY team_member_id desc";
			$c2->limit = 30;
			$teams = TeamMember::model()->findAll($c2);
				
			
			$param = array('points'=>$details,'total_equity'=>$sum,'teams'=>$teams,'eshares'=>Yii::app()->Ini->getTotalSlicesByUser($userid));
			
			$this->render('index',$param);
			
		}else {
			$this->redirect(Yii::app()->homeUrl);
		}
			
	}
	
	public function actionContribution_Types(){
		$this->page = 'dashboard';
		$this->menu = 'contributions';
		
		if (!Yii::app()->user->isGuest){
			if (Yii::app()->Ini->isSuperAdmin()){
				$types = ContributionType::model()->findAll();
				$param = array('types'=>$types);
				$this->render('contributions',$param);
			}else {
				$param = array('message'=>'You are not allowed to view this page.');
				$this->render('error-page',$param);
			}
		}else {
			$this->redirect(Yii::app()->homeUrl);
		}
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}