<?php 
  require_once '../config/config.php';
  $table = new Config();
  $tableName = 'contact_form';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <title>SQL Table</title>
</head>
  <body>
    <div>
      <?php $table->createTableFromSql($tableName); ?>
    </div>
    
  </body>
</html>