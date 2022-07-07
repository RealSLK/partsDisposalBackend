<?php 
  class Parts {
    // DB stuff
    private $conn; 

    // Parts Properties
    public $userName;
    public $userPassword;
    public $dealerID;
    public $id;
    public $partNumberImg;
    public $partOverviewImg;
    public $warrantyTagImg;
    public $dealerCode;
    public $vinNumber;
    public $partNumber;
    public $partsQuantity;
    public $repairOrder;
    public $partName;
    public $partNumberName;
    public $partOverviewName;
    public $warrantyTagName;
    public $partsNote;
    public $partCollected;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get user login credentials
    public function login() {
      // Read query
      $query = 'SELECT * FROM users WHERE userName = "' . $this->userName . '" AND userPassword = "' . $this->userPassword . '"';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get specific dealer Parts
    public function collectionTable() {
      // filter query
      $query = 'SELECT id,
                      dealerCode,
                      vinNumber,
                      partNumber, 
                      partsQuantity, 
                      repairOrder, 
                      partName, 
                      partOverviewName, 
                      warrantyTagName, 
                      partsNote,
                      partCollected
                                FROM collectionmaster WHERE dealerCode = "' . $this->dealerID . '"';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get specific dealer Parts
    public function loggingTable() {
      // filter query
      $query = 'SELECT id,
                      dealerCode,
                      vinNumber,
                      partNumber, 
                      partsQuantity, 
                      repairOrder, 
                      partName, 
                      partNumberName, 
                      partOverviewName, 
                      warrantyTagName, 
                      partsNote
                                FROM loggingmaster WHERE dealerCode = "' . $this->dealerID . '" ORDER BY id DESC LIMIT 50';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    // Get images
    public function getImages() {
      // Read query
      $query = 'SELECT partNumberImg,
                      partOverviewImg,
                      warrantyTagImg
                                FROM loggingmaster WHERE id = "' . $this->id . '"';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
    // Get Parts
    public function read() {
      // Read query
      $query = 'SELECT 
                      dealerCode,
                      vinNumber,
                      partNumber, 
                      partsQuantity, 
                      repairOrder, 
                      partName, 
                      partNumberName, 
                      partOverviewName, 
                      warrantyTagName, 
                      partsNote
                                FROM loggingmaster ORDER BY id DESC LIMIT 100';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create part in collection database
    public function createCollect() {
      // Create query
      $query = 'INSERT INTO collectionmaster SET  
                                                    partOverviewImg = :partOverviewImg, 
                                                    warrantyTagImg = :warrantyTagImg, 
                                                    dealerCode = :dealerCode, 
                                                    vinNumber = :vinNumber, 
                                                    partNumber = :partNumber, 
                                                    partsQuantity = :partsQuantity, 
                                                    repairOrder = :repairOrder, 
                                                    partName = :partName,  
                                                    partOverviewName = :partOverviewName, 
                                                    warrantyTagName = :warrantyTagName, 
                                                    partsNote = :partsNote,
                                                    partCollected = :partCollected';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      $stmt->bindParam(':partOverviewImg', $this->partOverviewImg);
      $stmt->bindParam(':warrantyTagImg', $this->warrantyTagImg);
      $stmt->bindParam(':dealerCode', $this->dealerCode);
      $stmt->bindParam(':vinNumber', $this->vinNumber);
      $stmt->bindParam(':partNumber', $this->partNumber);
      $stmt->bindParam(':partsQuantity', $this->partsQuantity);
      $stmt->bindParam(':repairOrder', $this->repairOrder);
      $stmt->bindParam(':partName', $this->partName);
      $stmt->bindParam(':partOverviewName', $this->partOverviewName);
      $stmt->bindParam(':warrantyTagName', $this->warrantyTagName);
      $stmt->bindParam(':partsNote', $this->partsNote);
      $stmt->bindParam(':partCollected', $this->partCollected);

      // Execute query
      if($stmt->execute()) {
        return true;
  }
}

    // Create part in collection database
    public function createLogging() {
      // Create query
      if($this->dealerCode != null){
        $query = 'INSERT INTO loggingmaster SET partNumberImg = :partNumberImg, 
                                                    partOverviewImg = :partOverviewImg, 
                                                    warrantyTagImg = :warrantyTagImg, 
                                                    dealerCode = :dealerCode, 
                                                    vinNumber = :vinNumber, 
                                                    partNumber = :partNumber, 
                                                    partsQuantity = :partsQuantity, 
                                                    repairOrder = :repairOrder, 
                                                    partName = :partName, 
                                                    partNumberName = :partNumberName, 
                                                    partOverviewName = :partOverviewName, 
                                                    warrantyTagName = :warrantyTagName, 
                                                    partsNote = :partsNote;';
      }
      

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      $stmt->bindParam(':partNumberImg', $this->partNumberImg); 
      $stmt->bindParam(':partOverviewImg', $this->partOverviewImg);
      $stmt->bindParam(':warrantyTagImg', $this->warrantyTagImg);
      $stmt->bindParam(':dealerCode', $this->dealerCode);
      $stmt->bindParam(':vinNumber', $this->vinNumber);
      $stmt->bindParam(':partNumber', $this->partNumber);
      $stmt->bindParam(':partsQuantity', $this->partsQuantity);
      $stmt->bindParam(':repairOrder', $this->repairOrder);
      $stmt->bindParam(':partName', $this->partName);
      $stmt->bindParam(':partNumberName', $this->partNumberName);
      $stmt->bindParam(':partOverviewName', $this->partOverviewName);
      $stmt->bindParam(':warrantyTagName', $this->warrantyTagName);
      $stmt->bindParam(':partsNote', $this->partsNote);

      // Execute query
      if($stmt->execute()) {
        return true;
  }
}

    // Update part
    public function update() {
      // update query
      $query = 'UPDATE collectionmaster
                            SET  
                            partOverviewImg = :partOverviewImg, 
                            warrantyTagImg = :warrantyTagImg, 
                            partOverviewName = :partOverviewName, 
                            warrantyTagName = :warrantyTagName, 
                            partsNote = :partsNote, 
                            partCollected = :partCollected
                            WHERE id = "' . $this->id . '"';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      //$stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':partOverviewImg', $this->partOverviewImg);
      $stmt->bindParam(':warrantyTagImg', $this->warrantyTagImg);
      $stmt->bindParam(':partOverviewName', $this->partOverviewName);
      $stmt->bindParam(':warrantyTagName', $this->warrantyTagName);
      $stmt->bindParam(':partsNote', $this->partsNote);
      $stmt->bindParam(':partCollected', $this->partCollected);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
      }
}

?>