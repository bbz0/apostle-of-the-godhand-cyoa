<?php 
	session_start();

	function isLoggedIn() {
		if(isset($_SESSION['apostle_id'])) {
			return true;
		} else {
			return false;
		}
	}

	function isAcknowledged() {
		if(isset($_SESSION['acknowledged'])) {
			return true;
		} else {
			return false;
		}
	}
 ?>