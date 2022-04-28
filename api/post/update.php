<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to update
  $parts->id = $data->id;

  $parts->partNumberImg = $data->partNumberImg;
  $parts->partOverviewImg = $data->partOverviewImg;
  $parts->warrantyTagImg = $data->warrantyTagImg;
  $parts->partNumberName = $data->partNumberName;
  $parts->partOverviewName = $data->partOverviewName;
  $parts->warrantyTagName = $data->warrantyTagName;
  $parts->partsNote = $data->partsNote;
  $parts->partCollected = $data->partCollected;

  // Update part
  if($parts->update()) {
    echo json_encode(
      array('message' => 'Part ' . $data->id . ' Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Part Not Updated')
    );
  }

