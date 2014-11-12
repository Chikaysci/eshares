<?php
	class ProfileajaxController extends Controller
	{
		public function actionIndex(){
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
		
		public function actionUpdatepersonalprofile(){
			$firstname = Yii::app()->request->getPost('firstname');
			$lastname = Yii::app()->request->getPost('lastname');
			$password = Yii::app()->request->getPost('password');
			$userid = Yii::app()->user->getId();
			
			Members::model()->updateByPk($userid, array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'password' =>  $password
			));
			
			$return['success'] = true;
	
			$this->renderJSON($return, true);
		}
		
		
		
	public function actionLoadteammembers(){
		$domain = $_POST['domain'];
		$details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $details->domain_id;
		
		//$teammembers = TeamMember::model()->findByAttributes(array('domain_id'=>$domain_id));
		
		
		/*$SQL="SELECT members.`member_id`,members.`firstname`,members.`lastname`,team.`domain`
FROM team_member 
JOIN members ON team_member.`member_id` = members.`member_id`
JOIN team ON team.`domain_id` = '".$domain_id."' AND team_member.`team_id` = team.`team_id`";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$dataReader=$command->query(); // execute a query SQL*/
		
		
		$dataReader = Yii::app()->db->createCommand()
    ->select('members.member_id,members.firstname,members.lastname,team.domain')
	->from('team_member')
    ->join('members','team_member.member_id = members.member_id')
	->join('team','team.domain_id = "'.$domain_id.'" AND team_member.team_id = team.team_id')
    ->queryAll();
		
		$param['development'] = "in production";
		$param['data'] = $dataReader;
		$return['html'] = $this->renderPartial('team_members', $param, true);
    	
		$this->renderJSON($return, true);
		
	}
	
	
	public function actionSavePieSettings($post){
		$s_id = $post['s_id'];
		$non_cash_multiplier = $post['non_cash_multiplier'];
		$cash_multiplier = $post['cash_multiplier'];
		$commission_rate = $post['commission_rate'];
		$royalty_rate = $post['royalty_rate'];
		$currency = $post['currency'];
		
		DomainPieSettings::model()->updateByPk($s_id, array(
				'non_cash_multiplier' => $non_cash_multiplier,
				'cash_multiplier' => $cash_multiplier,
				'commission_rate' => $commission_rate,
				'royalty_rate' => $royalty_rate,
				'currency' => $currency
			));
		
		$return['success'] = true;
		$this->renderJSON($return, true);
	}
	
	public function actionLoadbranddetails(){
		$domain = $_POST['domain'];
		$details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
    	$domain_id = $details->domain_id;
			
			
			$pie_data = DomainPieSettings::model()->findByAttributes(array('domain_id'=>$domain_id));
			if(count($pie_data) > 0){
				$param['s_id'] = $pie_data->s_id;
				$param['domain_id'] = $pie_data->domain_id;
				$param['non_cash_multiplier'] = $pie_data->non_cash_multiplier;
				$param['cash_multiplier'] = $pie_data->cash_multiplier;
				$param['commission_rate'] = $pie_data->commission_rate;
				$param['royalty_rate'] = $pie_data->royalty_rate;
				$param['currency'] = $pie_data->currency;
				
			}else{
				   $pie = new DomainPieSettings();
				   $pie->domain_id = $domain_id; $param['domain_id'] = $domain_id;
				   $pie->non_cash_multiplier = 2; $param['non_cash_multiplier'] = 2;
				   $pie->cash_multiplier = 4; $param['cash_multiplier'] = 4;
				   $pie->commission_rate = 10; $param['commission_rate'] = 10;
				   $pie->royalty_rate = 5; $param['royalty_rate'] = 5;
				   $pie->currency = "USD"; $param['currency'] = "USD";
				   if($pie->save()){
						$param['s_id'] = Yii::app()->db->getLastInsertID();
				   }
			}
	
		$param['currencies'] = array('USD','EUR','GBP','AED','AUD','CAD','CHF','CNY','COP','INR','THB','MYR');
		$param['domain_name'] = $domain;
    	$return['html'] = $this->renderPartial('brand_details', $param, true);
    	$this->renderJSON($return, true);
	}
		
	
}	
?>