<?php

class ApiController extends Controller
{
	private function renderRequest($data, $message = '', $type = 'json')
	{
		header('Content-Type: application/json');
		if(!is_array($data)){
			$data = array('error_message'=> array(((!empty($message)? $message : 'No input data'))));
			echo CJSON::encode(array_merge(array('success'=>false, 'data'=>$data)));
		}else{
			echo CJSON::encode(array_merge(array('success'=>true, 'data'=>$data)));
		}
	
	
		Yii::app()->Ini->end();
	}

	public function actionGetpie(){
		header('Access-Control-Allow-Origin: *');
		$domain    = Yii::app()->Ini->v('domain');
		$count = Domain::model()->count("domain_name=:domain", array("domain" => $domain));
		if ($count>0){
			Yii::app()->Ini->initDomain($domain);
			
			$details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
			$domain_id = $details->domain_id;
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
			
			if (count($rows) > 0){
				foreach ($rows as $key=>$row){
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
							"label" => $v->equity_name,
							"data" =>intval($equity_percent)
					);
				}
			}
			 
			$this->renderRequest($p);
		}else{
			$this->renderRequest(false, 'Invalid domain');
		}
	}
	
}