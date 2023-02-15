<?php
class form{
      public $first,$last,$full;
       
      public function __construct($firstName,$lastName){
          $this->first=$firstName;
          $this->last=$lastName;
      }
      public function showfullname(){
        return $this->full = $this->first . " " . $this->last;
      }
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $task = new form($firstName,$lastName);
   
  $message = "Hello" . $task->showfullname();
  echo $message;


  }
  ?>

 
