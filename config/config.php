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

    function createTableFromSql($tblname) {
        $query = "SELECT * FROM $tblname";
        $result= mysqli_query($this->con, $query);

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive-sm'><table class='table'><thead class='thead-dark'>";

            $field = $result->fetch_fields();
            $fields = array();
            $j = 0;
            foreach ($field as $col){
                echo "<th scope='col'>".$col->name."</th>";
                array_push($fields, array(++$j, $col->name));
            }
            echo "</thead >";

            while($row = $result->fetch_array()){
                echo "<tbody><tr>";
                for ($i=0 ; $i < sizeof($fields) ; $i++){
                    $fieldname = $fields[$i][1];
                    $filedvalue = $row[$fieldname];
                    if(ctype_digit($filedvalue) && strlen($filedvalue) == 10){ //has phone Number
                        $filedvalue = ltrim($filedvalue, '0'); 
                        $filedvalue =  substr($filedvalue , 0, 2).' '.substr($filedvalue , 2, 3).' '.substr($filedvalue , 5, 4);
                        $filedvalue = '+27 '.$filedvalue; // SA phone number

                    }
                    echo "<td>" . $filedvalue . "</td>";
                }
                echo "</tr></tbody>";
            }
                echo "</table></div>";


        }

    }

}

?>