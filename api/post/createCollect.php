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
  $parts->partCollected = $data->partCollected;

  /*if(empty($data->dealerCode)) {
    echo json_encode(
      array('message' => 'Can not submit black entry')
    );
  }*/

  // Create part
  if($parts->createCollect()) {
    echo json_encode(
      array('message' => 'Part entry Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Part entry Not Created')
    );
  }

?>
