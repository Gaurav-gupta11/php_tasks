
<?php
class form{
      public $first,$last,$full;
       
      public function __construct($firstName,$lastName){
          $this->first=$firstName;
          $this->last=$lastName;
      }
      public function showfullname($fullName){
        $this->full = $fullName;
        echo "Hello " . $this->full;
      }
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $fullName = $firstName . " " . $lastName;

  }
  
  $task = new form($firstName,$lastName);
   
  
  $task->showfullname($fullName);
?>
