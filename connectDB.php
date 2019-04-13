<?php
class SQL {

	protected static $mysqli = NULL;

	protected static function connect() {
		if(self::$mysqli !== NULL)
			return;
		include('passwords.php');
		self::$mysqli = new mysqli($dblocation, $dbuser, $dbpasswd, $dbname);
		mysqli_set_charset(self::$mysqli, 'utf8');
		setlocale(LC_ALL, 'ru_RU.UTF-8');
	}

	public static function InsertPost ($title, $body) {
		$query = 'INSERT INTO POSTS SET title = ' . $title . ', body = ' . $body ;
		self::connect();
		return mysqli_query(self::$mysqli, $query) ? true : false;
	}

	public static function selectAllPosts() {
		self::connect();
		$query = 'SELECT title, body from POSTS';

		if($response = mysqli_query(self::$mysqli, $query)) {
			$array_response = array();
			while($t = mysqli_fetch_assoc($response)) {
				array_push($array_response, $t);
			}
			return $array_response;
		} else {
			return NULL;
		}
	}

	public static function safeEncodeString($string) {
		self::connect();
		$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
		$string = mysqli_real_escape_string(self::$mysqli, $string);
		$string = str_replace('\r\n', '<br>', $string);
    $string = str_replace('\n', '<br>', $string);
		return $string;
	}
}
?>
