<?php

class TestController extends Controller
{
	public function actionEquity(){
			$criteria = new CDbCriteria();
		    $criteria->condition = "is_active = 1 ORDER BY member_id";
			$details = Members::model()->findAll($criteria);
			$i = 0;
			if(count($details) > 0){
				foreach($details as $k=>$v){
					
					$dbCommand = Yii::app()->db->createCommand("
					  SELECT 
		DISTINCT(theo.`domain_id`),domain_name
		FROM domain_theoretical_value AS theo
		JOIN domain_tasks ON (domain_tasks.`domain_id` = theo.`domain_id`)
		JOIN members ON (members.`member_id` = domain_tasks.`assigned_to`)
		WHERE domain_tasks.`status` = 'completed' AND domain_tasks.`assigned_to`= $v->member_id ORDER BY domain_name ASC
										
					");
					
					$rows = $dbCommand->queryAll();
					if (count($rows) > 0){
						foreach ($rows as $key2=>$row)
						{
						    $__domainid = $row['domain_id'];
				            $__domainname = $row['domain_name'];
				            
				            $__hourssql = "
				            SELECT  COALESCE(SUM(dt.equity_hours),0) as hours FROM domain_tasks dt
				            JOIN members m ON (m.member_id = dt.assigned_to)
				            WHERE dt.status = 'completed'
				            AND m.member_id='$v->member_id'
				            AND dt.domain_id='$__domainid'
				           ";

				            
				            $dbCommand2 = Yii::app()->db->createCommand($__hourssql);
				            			
				            $rows2 = $dbCommand2->queryAll();
				            
				            $theo = DomainTheoreticalValue::model()->findByAttributes(array('domain_id'=>$__domainid));
				            $rate = $v->rate;
				            
				            if (!$rate){
				            	$rate = 10;
				            }
				            
				            
				            if (count($rows2)>0){
				            	if (count($theo)>0){
					            		$theo_total = $theo->total;
					            		$crowd = $theo_total * .18;
					            		$total_rate_cost = $rate * $rows2[0]['hours'];
					            		
					            		$condetails = DomainContributions::model()->findByAttributes(array('c_type_id'=>1,'domain_id'=>$__domainid,'member_id'=>$v->member_id));
					            		if (count($condetails)==0){
					            			$condetails = new DomainContributions();
					            		}
					            		
					            		
					            		$condetails->c_type_id = 1;
					            		$condetails->domain_id = $__domainid;
					            		$condetails->member_id = $v->member_id;
					            		$condetails->amount = $total_rate_cost;
					            		$condetails->description = 'completed task';
					            		$condetails->save();
					            		
					            		$equity_percentage = round(($total_rate_cost/$crowd)*100,2);
					            		$equity_equivalent = $equity_percentage * $crowd;
					            		
					            		$param = array('select'=>'domain_id', 'condition'=>"domain_id=$__domainid AND member_id = $v->member_id");
	   	                                $exist = MemberEquity::model()->count($param);
	   	                                if ($exist == 0){
	   	                                	$me = new MemberEquity();
	   	                                }else {
	   	                                	$me = MemberEquity::model()->findByAttributes(array('domain_id'=>$__domainid,'member_id'=>$v->member_id));
	   	                                }
	   	                                	
	   	                                $me->member_id= $v->member_id;
	   	                                $me->domain_id = $__domainid;
	   	                                $me->equity_points = intval($equity_equivalent);
	   	                                $me->save();
	   	                                $i++;
   	                                }
				            	}
				            
				            
				            
				            
				            
						}
						
					}
					
				}
					
				
			}
			echo 'Updated '.$i.' records';
	}
}