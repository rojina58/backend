<?php
require_once(__DIR__.'/constants.php');
//now opening connection to database
/* $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
print_r(["conn1"=>$conn]); */
$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
if($conn->connect_error)
{
    die("Error: connection to database faile");
}
//echo "Connected to data base successfully";

//defining db helper functions for common operation
/**used to run select query */
function runSelectQuery($sqlQuery):array //:array indicates it return array
{
    global $conn;
    $data=null;
    $res=$conn->query($sqlQuery);
    //instructing to fetch associative array
    if($res)
       $data= $res->fetch_all(MYSQLI_ASSOC);

    return $data;
}

/**USed to run insert, update and delete query */
function runDMLQuery($sqlQuery) : int
{
  global $conn;
  $res=$conn->query($sqlQuery);
  if($res)
    return $conn->affected_rows;
  else 
    return -1;
}

/* $data=runSelectQuery("select * from users");
print_r($data); */

/* $rowAff=runDMLQuery("insert into users(name, email, password) value('sajid','sajid@gamil.com','456')");
print_r($rowAff); */
