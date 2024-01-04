<?php
/**
 * Data base connection class
 */
class DbConx {
	protected function connect() {
		$server = "localhost";
		$user = "root";
		$password = "root";
		$dbName = "bincomphptest";
		$dbConx = mysqli_connect($server, $user, $password, $dbName);
		if (!$dbConx) {
			echo "Connection failed : ". mysqli_connect_error();
			die();
		} else {
			return $dbConx;
		}
	}
}