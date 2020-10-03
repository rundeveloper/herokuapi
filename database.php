<?php
class Database{

    public function getConnection(){
      $localhost = 'bjeinhljkvgjxtnufqej-mysql.services.clever-cloud.com';
		$database = 'bjeinhljkvgjxtnufqej';
		$user = 'uohtx3roycvhvief';
		$password = 'SBCu4PUBWCZoEAwXkE9P';

		$link = new PDO("mysql:host=$localhost;dbname=$database",$user,$password);

		return $link;
    }
}
?>
