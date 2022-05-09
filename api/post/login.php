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
  
  $parts->userName = $data->userName;
  $parts->userPassword = $data->userPassword;

   // Login query
   $result = $parts->login();
   // Get row count
   $num = $result->rowCount();

  // Create part
  if($num > 0) {
    echo json_encode(
      array('message' => 'success')
    );
  } else {
    echo json_encode('Incorrect username password combination!');
  }

?>
