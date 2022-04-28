<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate part object
  $parts = new Parts($db);

  // Parts query
  $result = $parts->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any parts exist
  if($num > 0) {
    // Parts array
    $parts_arr = array();
    //$parts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $parts_item = array(
        'id' => $id,
        'vinNumber' => $vinNumber,
        'partNumber' => $partNumber,
        'partsQuantity' => $partsQuantity,
        'repairOrder' => $repairOrder,
        'partName' => $partName,
        'partNumberName' => $partNumberName,
        'partOverviewName' => $partOverviewName,
        'warrantyTagName' => $warrantyTagName,
        'partsNote' => $partsNote,
        'partCollected' => $partCollected
      );

      // Push to "data"
      array_push($parts_arr, $parts_item);
      //array_push($parts_arr['data'], $parts_item);
    }

    // Turn to JSON & output
    echo json_encode($parts_arr);

  } else {
    // No Parts
    echo json_encode(
      array('message' => 'No Parts Found')
    );
  }

?>