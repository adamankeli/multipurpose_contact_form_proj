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

    public function htmlvalidation($form_data){
        $form_data = mysqli_real_escape_string($this->con, trim(strip_tags($form_data)));
        $form_data = trim( stripslashes( htmlspecialchars( $form_data ) ) );
        return $form_data;
    }  
    
    public function alter($tblname, $column_name){
        $query= "SELECT $column_name FROM $tblname";
        $insert_fire = mysqli_query($this->con, $query);
        if ($insert_fire){
            //my_column exists in my_table
            return $column_name;
        }
        else{
            //my_column doesn't exist in my_table
            $query= "ALTER TABLE $tblname ADD $column_name VARCHAR(50) NULL";
            $insert_fire = mysqli_query($this->con, $query);
        }

        if($insert_fire){
            return $insert_fire;
        }
        else{
            return false;
        }
    }

    public function insert($tblname, $filed_data){
        $query_data = "";
        foreach ($filed_data as $q_key => $q_value) {
            $query_data = $query_data."$q_key='$q_value',";
        }

        $query_data = rtrim($query_data,",");
        $query = "INSERT INTO $tblname SET $query_data";
        $insert_fire = mysqli_query($this->con, $query);

        if($insert_fire){
            return $insert_fire;
        }
        else{
            return false;
        }
    }

}

?>