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

	/*
	 * Приводит массив к строке вида
	 * значение1, значение2...
	 */
	public static function StringFromArray(array $array) {
		if(count($array) == 0) {
			return '';
		}
		$result = $array[0];
		for($i = 1; $i < count($array); $i++) {
			$result .= ' , ' . $array[$i];
		}
		return $result;
	}

	protected static function StringFromAssoc(array $values) {
		if(!self::is_assoc($values))
			return NULL;
		$result = "";
		foreach ($values as $key => $value){
			$result = $result . $key . '=' . $value . ',';
		}
		$result[strlen($result) - 1] = " ";
		return $result;
	}

	protected static function is_assoc(array $arr) {
		if (array() === $arr) return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}

	public static function SELECT(array $fields_array, $table) {
		self::connect();
		$fields = self::StringFromArray($fields_array);
		$query = 'SELECT ' . $fields . ' from '. $table;

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

	public static function INSERT_set($table_name, array $values) {
		if(($query_body = self::StringFromAssoc($values)) == NULL){
			return NULL;
		}
		$query = 'INSERT INTO ' . $table_name . ' SET ' . $query_body;
		self::connect();
		return mysqli_query(self::$mysqli, $query) ? true : false;
	}

	// Функции кодирования и раскодирования строк для хранения в БД
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
