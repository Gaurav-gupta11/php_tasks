<?php
class form{
      public $first,$last,$full;
       
      public function __construct($firstName,$lastName){
          $this->first=$firstName;
          $this->last=$lastName;
      }
      public function showfullname(){
        $message = "Hello " . $this->full = $this->first . " " . $this->last;
        echo $message;
      }
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $task = new form($firstName,$lastName);
   
  $name = "/^[a-zA-Z]+$/";
  if (preg_match($name, $firstName) && preg_match($name, $lastName)) {
      $task = new form($firstName,$lastName);
      $task->showfullname();
  } else {
      echo "Invalid input. Please enter only alphabets for first name and last name.";
  }
}

  ?>

 
