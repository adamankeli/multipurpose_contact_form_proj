<?php

class Config{

    private $DBHOST='localhost';
	private $DBUSER='root';
	private $DBPASS='root';
	private $DBNAME='sql_database';
	public $con;

    public function __construct(){
		$this->con = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
		if(!$this->con){
			return false;
		}
    } 

}

?>