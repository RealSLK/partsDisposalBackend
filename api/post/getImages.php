<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate part object
  $parts = new Parts($db);

  $data = json_decode(file_get_contents("php://input"));
  $parts->id = $data->id;

  // Parts query
  $result = $parts->getImages();
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
        'partNumberImg' => $partNumberImg,
        'partOverviewImg' => $partOverviewImg,
        'warrantyTagImg' => $warrantyTagImg,
      );

      // Push to "data"
      array_push($parts_arr, $parts_item);
      //array_push($parts_arr['data'], $parts_item);
    }

    // Turn to JSON & output
    echo json_encode($parts_arr);

  } else {
    // No Parts
    echo ('No records found.');
  }

?>