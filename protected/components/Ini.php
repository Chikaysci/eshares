<?php

class Ini extends CApplicationComponent
{
    public function init()
    {
        parent::init();
    }
    public function db()
    {
        return Yii::app()->db;
    }
    public function g($settingName, $unserialize = false)
    {
        return coreSettings::model()->getDetails($settingName, $unserialize);
    }
    public function s($settingName, $settingValue, $onExistsUpdate = false, $serialize = false)
    {
        return coreSettings::model()->createSetting($settingName, $settingValue, $onExistsUpdate, $serialize);
        
    }
    public function v($string, $default='')
    {
        return Yii::app()->request->getParam($string, $default);
    }
    public function d($string)
    {
        return html_entity_decode($string);
    }
    public function url($direct = false)
    {
        return ($direct) ? '/' : Ini::info('hostUrl');
    }
    public function info($type = 'rootDir')
    {
        return Yii::app()->params->{$type};
    }
    public function load($classname, $args0=null, $args1=null, $args2=null, $args3=null )
    {
        Yii::import('application.components.classes.'.$classname);
        if(class_exists($classname))
            return new $classname($args0, $args1, $args2, $args3);
        return false;
    }
    public function tUrl($direct = true)
    {
        return (($direct) ? '/' : Ini::info('hostUrl')) . ltrim(Yii::app()->theme->baseUrl,'/');
    }
    public function userId($userSlug = '')
    {
        return Yii::app()->user->userDetails()->userid;
    }
    public function userDetails($userId = -1)
    {
        $userId = $userId == -1 ? self::userId() : $userId;
        return users::model()->findByPk($userId);
    }
    public function userLevel($userId = 0)
    {
        if(!$userId):
            $userId = Yii::app()->user->userDetails()->userid;
        endif;
        $admin = admin::model()->findByAttributes(array('userid'=>$userId));
        return (int) $admin->admin_level;
    }
    public function sSt($stateName, $stateValue)
    {
        Yii::app()->user->setState($stateName, $stateValue);
        return null;
    }
    public function gSt($stateName)
    {
        return Yii::app()->user->getState($stateName);
    }
    public function rip($type='both')
    {
        $return = array();
        if(getenv('HTTP_CLIENT_IP'))
            $return['ip'] = getenv('HTTP_CLIENT_IP');
        elseif (getenv('HTTP_X_FORWARDED_FOR'))
            $return['ip'] = getenv('HTTP_X_FORWARDED_FOR');
        elseif (getenv('HTTP_X_FORWARDED'))
            $return['ip'] = getenv('HTTP_X_FORWARDED');
        elseif (getenv('HTTP_FORWARDED_FOR'))
            $return['ip'] = getenv('HTTP_FORWARDED_FOR');
        elseif (getenv('HTTP_FORWARDED'))
            $return['ip'] = getenv('HTTP_FORWARDED');
        else
            $return['ip'] = $_SERVER['REMOTE_ADDR'];

        $return['long']   = ip2long($return['ip']);

        switch ($type):
            case 'long':
                return $return['long'];
            break;
            case 'ip':
                return $return['ip'];
            break;
            default:
                return $return;
            break;
        endswitch;
    }
    public function isGuest($redirectCode = false, $typeAjax = false, $returnAjaxUrl = false, $returnInt = false)
    {
        $isGuest = Yii::app()->user->isGuest;
        if($returnInt):
            return intval($isGuest);
        endif;
        if($isGuest && $typeAjax):
            header('Content-Type: application/json');
            if($returnAjaxUrl)
                echo CJSON::encode(array('s'=>0,'x'=>Ini::redirecAuthtUrl($_POST, true)));
            else
                echo CJSON::encode(array('s'=>0,'r'=>'You need to login first.'));
            Ini::end();
        endif;
        if($isGuest)
            if($redirectCode)
                Ini::redirecAuthtUrl('http://'.$_SERVER['HTTP_HOST'], $returnRedirectUrl);
        return $isGuest;
    }
    public function aN($string, $whiteSpace = '', $replaceSpace = false, $toLower = false)
    {
        if($toLower)
            $string = strtolower($string);
        if($replaceSpace):
            $string = str_replace(array(' ','_'), '-', $string);
            return preg_replace('/[^a-zA-Z0-9\-' . $whiteSpace . ']/', '', (string) trim($string));
        else:
            return preg_replace('/[^a-zA-Z0-9' . $whiteSpace . ']/', '', (string) trim($string));
        endif;
        
    }
    public function aD($string)
    {
        return preg_replace('/[^0-9]/', '', (string) trim($string));
    }
    public function offset($currentPage, $perPage)
    {
        if(intval($perPage) == 0)
            $perPage = Ini::info('perPage');
        $result = (($currentPage * $perPage) - $perPage);
        if($result < 1)
            return 0;
        return $result;
    }
    public function randomString($lower=2,$upper=2,$number=2, $special=0)
    {
        $setArray   = array();
        $setArray[] = array('count' => $lower,   'chars' => 'abcdefghijkmnpqrstuvwxyz');
        $setArray[] = array('count' => $upper,   'chars' => 'ABCDEFGHJKLMNPQRSTUVWXYZ');
        $setArray[] = array('count' => $number,  'chars' => '0123456789');
        $setArray[] = array('count' => $special, 'chars' => '!@#$+-*&?:');
        $return = array();
        foreach ($setArray as $set):
            for ($i = 0; $i < $set['count']; $i++)
                $return[] = $set['chars'][ rand(0, strlen($set['chars']) - 1)];
        endforeach;
        shuffle($return);
        return implode('',$return);
    }
    public function paginatorAjax($totalItems, $page, $perpage, $function, $params = array(), $showOptions = true)
    {
        $totalpages = @($totalItems/$perpage);
        $param = '';
        if(count($params))
            foreach ($params as $k => $v)
                $param .= ',\''.$v.'\'';
        $temp = (int)$totalpages;
        if($temp != $totalpages) $totalpages++;
        $totalpages = (int) $totalpages;
        if($totalpages < 2) return '';
        if($page == 0) $page = 1;

        $firstpage = $page - 5;
        if($firstpage < 1)
            $firstpage = 1;
        $lastpage = $page + 5;
        if($lastpage > $totalpages)
            $lastpage = $totalpages;
        $return .= '<div class="pages-link"><div>';
        if($page != 1 && $totalpages > 1)                                                              
            $return .= '<a href="javascript:void(null);" onclick="'.$function.'('.($page-1).$param.');">&laquo; prev</a> ';
        for($i = $firstpage; $i < $page; $i++):
            if($i != 1)
                $return .= '<a href="javascript:void(null);" onclick="'.$function.'('.($i).$param.');">'.$i.'</a> ';
            else
                $return .= '<a href="javascript:void(null);" onclick="'.$function.'(1'.$param.');">'.$i.'</a> ';
        endfor;
        $return .= ' <span class="current">'.$page.'</span> ';
        for($i = ($page+1); $i <= $lastpage; $i++ )
            $return .= '<a href="javascript:void(null);" onclick="'.$function.'('.($i).$param.');">'.$i.'</a> ';
        if($page != $totalpages && $totalpages > 1)
            $return .= '<a href="javascript:void(null);" onclick="'.$function.'('.($page+1).$param.');">next &raquo;</a> ';
        $offset = (($page*$perpage)-$perpage+1);
        $return .= '</div>';
        if($showOptions):
            $return .= '<span style="float:right;">Showing Record '.number_format(($offset>$totalItems)?$totalItems:$offset).
                       ' - '.number_format((($page*$perpage)>$totalItems)?$totalItems:($page*$perpage)).' of '.number_format($totalItems).' '.
                       '(Page <input type="text" class="to-page" value="'.$page.'" size="1" onblur="$(\'input[class=to-page]\').val(this.value)" /> of '.$totalpages.') '.
                       '<input type="button" class="btn success small" value="Go &raquo;" onclick="'.$function.'($(\'input[class=to-page]\').val()'.$param.');"></span>';
        endif;
        $return .= '</div>';
        return $return;
    }
    public function redirecAuthtUrl($url, $returnUrl = false)
    {
        Yii::app()->getRequest()->redirect('http://admin.'.Ini::info('tld'),true,302);
        Ini::end();
    }
    public function agent()
    {
        $u_agent  = $_SERVER['HTTP_USER_AGENT'];
        $bname    = 'Unknown';
        $platform = 'Unknown';
        $version = '';

        if (preg_match('/linux/i', $u_agent))
            $platform = 'linux';
        elseif (preg_match('/macintosh|mac os x/i', $u_agent))
            $platform = 'mac';
        elseif (preg_match('/windows|win32/i', $u_agent))
            $platform = 'windows';
       
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)):
            $bname = 'Internet Explorer';
            $ub    = "MSIE";
        elseif(preg_match('/Firefox/i',$u_agent)):
            $bname = 'Mozilla Firefox';
            $ub    = "Firefox";
        elseif(preg_match('/Chrome/i',$u_agent)):
            $bname = 'Google Chrome';
            $ub    = "Chrome";
        elseif(preg_match('/Safari/i',$u_agent)):
            $bname = 'Apple Safari';
            $ub    = "Safari";
        elseif(preg_match('/Opera/i',$u_agent)):
            $bname = 'Opera';
            $ub    = "Opera";
        elseif(preg_match('/Netscape/i',$u_agent)):
            $bname = 'Netscape';
            $ub    = "Netscape";
        endif;

        $known   = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)):
            // we have no matching number just continue
        endif;
       
        $i = count($matches['browser']);
        if ($i != 1):
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub))
                $version= $matches['version'][0];
            else
                $version= $matches['version'][1];
        else:
            $version= $matches['version'][0];
       endif;

        if ($version==null || $version=="")
            $version="?";
       
        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'   => $pattern
        );
    }
    public function createSqlTime($isClear = false, $time = 0)
    {
        if($isClear)
            return '0000-00-00 00:00:00';
        if($time<1)
            return date("Y-m-d H:i:s", mktime());
        return date("Y-m-d H:i:s", intval($time));
    }
    public function end()
    {
        Yii::app()->end();
    }
    
    public function getSlicesByUser($userid,$contrib,$domain_id = null){
    	
    	if ($domain_id){
    		$sql = "
    		SELECT members.*,SUM(amount) AS total,contribution_type.`name` FROM
    		`domain_contributions` LEFT JOIN `contribution_type` ON (`contribution_type`.`c_id` = domain_contributions.`c_type_id`)
    		LEFT JOIN members ON (members.`member_id` = domain_contributions.`member_id`)
    		WHERE domain_contributions.`member_id` =$userid AND `name` = '$contrib' AND domain_id = $domain_id";
    	}else {
    	$sql = "
    	SELECT members.*,SUM(amount) AS total,contribution_type.`name` FROM 
`domain_contributions` LEFT JOIN `contribution_type` ON (`contribution_type`.`c_id` = domain_contributions.`c_type_id`)
LEFT JOIN members ON (members.`member_id` = domain_contributions.`member_id`)
WHERE domain_contributions.`member_id` =$userid AND `name` = '$contrib' 
    	";
    	}		
    		
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	$rows = $dbCommand->queryAll();
    	if (count($rows) >0){
    		foreach ($rows as $k=>$v){
    			$total = $v['total'];
    		}
    	}else {
    		$total = 0;
    	}
    	
    	return $total;
    }
    
    
    public function getSlicesByUserDomain($userid,$domain_id){
    	$sql = "
    	SELECT SUM(amount) AS total FROM 
`domain_contributions` 
WHERE domain_contributions.`member_id` =$userid AND `domain_id` = $domain_id
    	
    	";
    	
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	$rows = $dbCommand->queryAll();
    	if (count($rows) >0){
    	foreach ($rows as $k=>$v){
    		$total = $v['total'];
    	}
    		}else {
    			$total = 0;
    		}
    		 
    		return $total;
    }
    
    public function getPiePerDomain($userid,$domain_id){
    	$percent = 0;
    	$sql = "
    	SELECT SUM(amount) AS total FROM 
        `domain_contributions` 
        WHERE  `domain_id` = $domain_id
    	
    	";
    	 
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	$rows = $dbCommand->queryAll();
    	if (count($rows) >0){
    	foreach ($rows as $k=>$v){
    		$total_brand = $v['total'];
    	}
    		}else {
    		$total_brand = 0;
    	}
    	
    	$total_user = $this->getSlicesByUserDomain($userid,$domain_id);
    	if ($total_brand >0){
    		$percent = ($total_user/$total_brand) * 100;
    	}
    	
    	return $percent;
    }
    
    public function getTotalSlicesByUser($userid){
    	$sql = "
    	SELECT SUM(amount) AS total FROM 
		`domain_contributions` 
		WHERE  `member_id` = $userid
    	";
    
    
    	$dbCommand = Yii::app()->db->createCommand($sql);
    	$rows = $dbCommand->queryAll();
    	if (count($rows) >0){
    	foreach ($rows as $k=>$v){
    		$total = $v['total'];
    	}
    		}else {
    		$total = 0;
    		}
    		 
    		return $total;
      }
      
     public function initDomain($domain){
     	$details = Domain::model()->findByAttributes(array('domain_name'=>$domain));
     	$domain_id = $details->domain_id;
     	
     	//add equity percentage
     	$count = DomainEquityPercent::model()->count("domain_id=:domain_id", array("domain_id" => $domain_id));
     	if ($count == 0){
     		
     		// add default domain percent
     		$es = EquityType::model()->findAll();
     		foreach ($es as $k=>$v){
     	
     			switch ($v->type_id){
     				case 1:
     					$percent = 50;
     					break;
     				case 2:
     					$percent = 18;
     					break;
     				case 3:
     					$percent = 15;
     					break;
     				case 4:
     					$percent = 15;
     					break;
     				case 5:
     					$percent = 2;
     					break;
     			}
     	
     			$s = new  DomainEquityPercent();
     			$s->domain_id = $domain_id;
     			$s->equity_type_id =  $v->type_id;
     			$s->percent = $percent;
     			$s->save();
     		}
     		
     	}
     	
     	//add default umbrella on members
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
     	$c_m_e = MemberEquityType::model()->count("domain_id=:domain_id AND member_id=:member_id", array("domain_id" => $domain_id,'member_id'=>$row['member_id']));
     	if ($c_m_e == 0) {
     	switch ($row['member_id']){
     	case 8:
     		$type_id = 1;
     	break;
     	case 12:
     		$type_id = 1;
     	break;
     	default:
     		$type_id = 2;
     	break;
     	}
     	
     	$er = new MemberEquityType();
     	$er->domain_id = $domain_id;
     	$er->equity_type_id = $type_id;
     	$er->member_id = $row['member_id'];
     	$er->save();
     	}
     	 
     	}
     	}
     }
     
     public function getTotalByEquityType($domain_id,$type_id){
     	$sql = "
     	SELECT SUM(amount) AS total FROM `domain_contributions` WHERE member_id IN ( SELECT member_id FROM `member_equity_type` WHERE `equity_type_id` = $type_id AND `domain_id` = $domain_id)
AND domain_contributions.`domain_id` = $domain_id
     	";
     	 
     	$dbCommand = Yii::app()->db->createCommand($sql);
     	$rows = $dbCommand->queryAll();
     	if (count($rows) >0){
     	foreach ($rows as $k=>$v){
     		$total = $v['total'];
     	}
     		}else {
     		$total = 0;
     	}
     	 
     	return $total;
     }
     
     public function getDomainMonetization($domain_id){
     	$sql = "
     	SELECT SUM(`referral_monetization_revenue`.`sale_amount`) AS total FROM 
`referral_monetization_revenue` INNER JOIN 
`referral_monetization_domains` ON (`referral_monetization_domains`.`ref_id` = referral_monetization_revenue.`ref_id`)
WHERE referral_monetization_domains.`domain_id` = $domain_id
     	";
     
     
     	$dbCommand = Yii::app()->db->createCommand($sql);
     	$rows = $dbCommand->queryAll();
     	if (count($rows) >0){
     	foreach ($rows as $k=>$v){
     	$total = $v['total'];
     	}
     	}else {
     	$total = 0;
     	}
     	 
     	return $total;
     	}
     	

      public function isSuperAdmin(){
      	 $admin = array(8,12,1);
      	 $status = false;
      	 $userid = Yii::app()->user->getId();
      	 if (in_array($userid, $admin)) {
      	 	$status = true;
      	 }
      	 
      	 return $status;
      }
      
      public function hasAccess($domain){
      	$has_access = false;
      	$userid = Yii::app()->user->getId();
      	
      	$details = Members::model()->findByAttributes(array('member_id'=>$userid));
      	if ($details->is_admin == 1){
      		$has_access = true;
      	}else {
      		$sql = "
      		SELECT COUNT(*) AS total FROM `team_member` INNER JOIN team ON (team.`team_id` = `team_member`.`team_id`)
INNER JOIN domain ON (domain.`domain_id` = team.`domain_id`)
WHERE team_member.`role_id` = 29 AND team_member.`member_id` = $userid AND domain.`domain_name` = '$domain'
      		";
      		$dbCommand = Yii::app()->db->createCommand($sql);
      		$rows = $dbCommand->queryAll();
      		if (count($rows) >0){
      			foreach ($rows as $k=>$v){
      				$total = $v['total'];
      			}
      		}else {
      			$total = 0;
      		}
      		
      		if ($total > 0){
      			$has_access = true;
      		}
      	}
      	
      	return $has_access;
      }
      
      public function getTotalExpensesByDomain($domain_id){
      	$sql = "SELECT SUM(amount) AS total FROM domain_expenses WHERE domain_id = $domain_id";
      	 
	      	$dbCommand = Yii::app()->db->createCommand($sql);
	      	$rows = $dbCommand->queryAll();
	      	if (count($rows) >0){
	      	foreach ($rows as $k=>$v){
	      	$total = $v['total'];
	      	}
	      	}else {
	      	$total = 0;
	      	}
      	 
      	return $total;
      	}
      		 
    
}
