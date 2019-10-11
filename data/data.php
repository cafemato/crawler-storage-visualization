<?php
ini_set('display_errors','1');
error_reporting(E_ALL);
//setting header to json
header('Content-Type: application/json; charset=utf-8');

//database
define('DB_HOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'job_bank');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT industry, count(*) AS counts FROM bigdata GROUP BY industry ");
$query2 = sprintf("SELECT * FROM bigdata");
//execute query
$result = $mysqli->query($query);
$result2 = $mysqli->query($query2);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

$data2 = array();
foreach ($result2 as $row) {
  $data2[] = $row;
}
$posts = array();
$posts[] = array('data1'=> $data, 'data2'=> $data2);

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($posts);
// print json_encode($data2);

?>