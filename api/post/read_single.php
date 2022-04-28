<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $parts = new Parts($db);

  // Get ID
  $parts->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $parts->read_single();

  // Create array
  $parts_arr = array(
    'id' => $parts->id,
    'dealerID' => $parts->dealerID,
    'dealerCode' => $parts->dealerCode,
    'vinNumber' => $parts->vinNumber,
    'partNumber' => $parts->partNumber, 
    'partsQuantity' => $parts->partsQuantity,
    'repairOrder' => $parts->repairOrder,
    'partName' => $parts->partName,
    'partNumberName' => $parts->partNumberName,
    'partOverviewName' => $parts->partOverviewName,
    'warrantyTagName' => $parts->warrantyTagName,
    'partsNote' => $parts->partsNote,
    'partCollected' => $parts->partCollected
  );

  // Make JSON
  print_r(json_encode($parts_arr));