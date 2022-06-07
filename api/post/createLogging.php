<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate parts object
  $parts = new Parts($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  $parts->partNumberImg = $data->partNumberImg;
  $parts->partOverviewImg = $data->partOverviewImg;
  $parts->warrantyTagImg = $data->warrantyTagImg;
  $parts->dealerCode = $data->dealerCode;
  $parts->vinNumber = $data->vinNumber;
  $parts->partNumber = $data->partNumber;
  $parts->partsQuantity = $data->partsQuantity;
  $parts->repairOrder = $data->repairOrder;
  $parts->partName = $data->partName;
  $parts->partNumberName = $data->partNumberName;
  $parts->partOverviewName = $data->partOverviewName;
  $parts->warrantyTagName = $data->warrantyTagName;
  $parts->partsNote = $data->partsNote;

  /*<?php

if( isset($_POST['submit']) )
{
    $prefix     =   $_POST['prefix'];
    $firstname  =   $_POST['firstname'];
    $lastname   =   $_POST['lastname'];
    $phone      =   $_POST['phone'];
    $school     =   $_POST['school'];
    $teammate1  =   $_POST['teammate1'];
    $teammate2  =   $_POST['teammate2'];
    $games      =   $_POST['games'];
    $division   =   $_POST['division'];

    mysql_connect("localhost", "acsp", "passwordhidden");
    mysql_select_db("logicgames");
    $order = "INSERT INTO data_logicgames (prefix, firstname, lastname, phone, school, teammate1, teammate2, games, division) VALUES ('$prefix', '$firstname', '$lastname', '$phone', '$school', '$teammate1', '$teammate2', '$games', '$division')";
    $result = mysql_query($order);
    if ($result) {
        echo "<p>Success</p>";
    } else {
        echo "<p>Failed</p>";
    }
}
else
{
    echo "<p>Failed</p>";
}
?>*/

  // Create part
  if($parts->createLogging()) {
    echo json_encode(
      array('message' => 'Part entry Created')
    );
  } else {
    echo ('Part creation unsuccessful');
  }

?>
