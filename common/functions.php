<?php 
	
	require_once(BASE_PATH.'/common/database.php');

	function login($request) {
		global $db;
		$request = $db->realEscapeRequest($request);
		$sql = "SELECT id from users WHERE username='".$request['username']."' AND password='".encrypt($request['password'])."'";
		if($db->numRows($db->query($sql)) > 0) {
			return $db->getOne($db->query($sql));
		}
		else {
			return "false";
		}
	}

	function register($request) {
		global $db;
		$request = $db->realEscapeRequest($request);
		$sql = "SELECT id from users WHERE username='".$request['username']."'";
		if($db->numRows($db->query($sql)) > 0) {
			return array('status' => 'failed','msg' => 'Email already exists.','old' => $request);
		}
		else {
			$sql = "INSERT INTO `users`(`username`,`password`) VALUES('".$request['username']."','".encrypt($request['password'])."')";
			$db->query($sql);
			$user_id = $db->getLastInsertedId();
			return array('status' => 'success','msg' => 'Register completed successfully.','id' => $user_id);
		}
	}

	function get_user_meta($id, $field) {
		global $db;
		$sql = 'SELECT '.$field.' FROM `users` WHERE id='.$id.'';
		$result = $db->query($sql);
		$row = $db->getOne($result);
		return $row->$field;
	}

	function get_dummy_account_details($limited = false,$offset = 0,$limit = 0,$searchWith = '') {
		global $db,$app;
		$limitedSql = "";
		$where = "";
		if(!empty($searchWith)) {
			$where.= " AND email LIKE '%".$searchWith."%'";
		}
		if($limited) {
			$limitedSql = " LIMIT ".$offset.",".$limit;
		}
		$sql = 'SELECT * FROM `account_details` WHERE `user_id` = '.$app->getSession("loggedin").$where.' ORDER BY ID DESC'.$limitedSql;
		$result = $db->get($db->query($sql));
		return $result;
	}

	function get_template_details($limited = false,$offset = 0,$limit = 0,$searchWith = '') {
		global $db,$app;
		$limitedSql = "";
		$where = "";
		// $where = " WHERE 1=1";
		if(!empty($searchWith)) {
			$where.= " AND text LIKE '%".$searchWith."%'";
		}
		if($limited) {
			$limitedSql = " LIMIT ".$offset.",".$limit;
		}

		$sql = 'SELECT * FROM `template_details` WHERE `user_id` = '.$app->getSession("loggedin").$where.' ORDER BY ID DESC'.$limitedSql;
		$result = $db->get($db->query($sql));
		return $result;
	}

	function getMatchedTemplate($dummy_account_id) {
		global $db;
		$sql = "select template_details.image,template_details.text FROM account_template_matching LEFT JOIN template_details ON template_details.id = account_template_matching.template_id WHERE dummy_account_id=".$dummy_account_id;
		$result = $db->getOne($db->query($sql));
		return $result;
	}

	function get_urls($limited = false,$offset = 0,$limit = 0,$searchWith = '') {
		global $db,$app;
		$limitedSql = "";
		$where = "";
		if(!empty($searchWith)) {
			$where.= " AND url LIKE '%".$searchWith."%'";
		}
		if($limited) {
			$limitedSql = " LIMIT ".$offset.",".$limit;
		}
		$sql = 'SELECT * FROM `urls` WHERE `user_id` = '.$app->getSession("loggedin").$where.' ORDER BY ID DESC'.$limitedSql;
		$result = $db->get($db->query($sql));
		return $result;
	}

	function get_proxies($limited = false,$offset = 0,$limit = 0,$searchWith = '') {
		global $db,$app;
		$limitedSql = "";
		$where = "";
		if(!empty($searchWith)) {
			$where.= " AND proxy LIKE '%".$searchWith."%'";
		}
		if($limited) {
			$limitedSql = " LIMIT ".$offset.",".$limit;
		}
		$sql = 'SELECT * FROM `proxies` WHERE `user_id` = '.$app->getSession("loggedin").$where.' ORDER BY ID DESC'.$limitedSql;
		$result = $db->get($db->query($sql));
		return $result;
	}

	function addDummyAccountDetails($request) {
		global $db,$app;
		$request = $db->realEscapeRequest($request);
		$sql = "INSERT INTO `account_details`(`email`,`password`,`user_id`) VALUES('".$request['email']."','".$request['password']."',".$app->getSession('loggedin').")";
		$db->query($sql);
		return true;
	}

	function addTemplateDetails($request,$files = '') {
		global $db,$app;
		$request = $db->realEscapeRequest($request);
		$allowed_extensions = array('image/png','image/jpg','image/jpeg','image/bmp','image/gif');
		if(!in_array($files['image']['type'],$allowed_extensions)) {
			return array('status' => 'failed','msg' => 'Please select image type of file.','old' => $request);
		}
		else {
			$encodedImage = base64_encode(file_get_contents($files['image']["tmp_name"]));
			$encodedImage = str_replace('data:image/png;base64,', '', $encodedImage);
			$encodedImage = str_replace(' ', '+', $encodedImage);
			$sql = "INSERT INTO `template_details`(`image`,`text`,`user_id`) VALUES('".$encodedImage."','".$request['text']."',".$app->getSession('loggedin').")";
			$db->query($sql);
			return true;
		}
	}

	function addAccountTemplateMatching($request) {
		global $db;
		$request = $db->realEscapeRequest($request);
		extract($request);
		$sql = "DELETE FROM `account_template_matching` WHERE `dummy_account_id`=".$dummy_account_id;
		$db->query($sql);
		$sql = "INSERT INTO `account_template_matching`(dummy_account_id,template_id) VALUES($dummy_account_id,$template_id)";
		$db->query($sql);
		return true;
	}

	function addUrl($request) {
		global $db,$app;
		$request = $db->realEscapeRequest($request);
		$urls = str_replace('\r\n', '<br />', $request['url']);
		$urls = explode("<br />",$urls);
		foreach ($urls as $key => $url) {
			$sql = "INSERT INTO `urls`(`url`,`user_id`) VALUES('".$url."',".$app->getSession('loggedin').")";
			$db->query($sql);
		}
		return true;
	}

	function addProxy($request) {
		global $db,$app;
		$request = $db->realEscapeRequest($request);
		$proxies = str_replace('\r\n', '<br />', $request['proxy']);
		$proxies = explode("<br />",$proxies);
		foreach ($proxies as $key => $Proxy) {
			$sql = "INSERT INTO `proxies`(`proxy`,`user_id`) VALUES('".$Proxy."',".$app->getSession('loggedin').")";
			$db->query($sql);
		}
		return true;
	}

	function deleteURL($id) {
		global $db;
		$sql = "DELETE FROM `urls` WHERE id=".$id;
		$db->query($sql);
	}

	function deleteProxy($id) {
		global $db;
		$sql = "DELETE FROM `proxies` WHERE id=".$id;
		$db->query($sql);
	}
	function deleteAccount($id) {
		global $db;
		$sql = "DELETE FROM `account_details` WHERE id=".$id;
		$db->query($sql);
	}
	function deleteTemplate($id) {
		global $db;
		$sql = "DELETE FROM `template_details` WHERE id=".$id;
		$db->query($sql);
	}
	

	function get_status_text($status = 0) {
		if($status == 0) {
			return '<strong><span class="text-danger">FALSE</span></strong>';
		}
		else {
			return '<strong><span class="text-success">TRUE</span></strong>';
		}
	}

	function showTabActive($url,$tabs) {
		$showActive = false;
		foreach($tabs as $key => $tab) {
			if(strpos($url, $tab) !== FALSE) {
				$showActive = true;
				break;
			}
		}
		return $showActive;
	}

?>