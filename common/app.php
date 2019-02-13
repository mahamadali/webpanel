<?php

	class App {

		function redirect($url) {
			?>
				<script type="text/javascript">
					window.location.href = '<?php echo $url; ?>';
				</script>
			<?php
		}

		function startSession() {
			if(empty(session_id()))
				session_start();
		}

		function destroySession() {
			unset($_SESSION);
			session_destroy();
		}

		function setSession($key,$value) {
			$_SESSION[$key] = $value;
		}

		function getSession($key) {
			if(empty($_SESSION[$key]))
				return '';
			else
				return $_SESSION[$key];
		}

		function removeSession($key) {
			if(!empty($_SESSION[$key])) {
				$_SESSION[$key] = '';
				unset($_SESSION[$key]);
			}
		}

		function setErrReporting($on = true) {
			if($on) {
				error_reporting(E_ALL);
				ini_set("DISPLAY_ERRORS", 1);
			}
			else {
				error_reporting(E_PARSE|E_ERROR);
				ini_set("DISPLAY_ERRORS", 0);
			}
		}

		function logout($redirectTo = '') {
			$this->destroySession();
			if(!empty($url)) {
				$this->redirect(SITE_URL);
			}
			else {
				$this->redirect($redirectTo);
			}
		}

	}

?>