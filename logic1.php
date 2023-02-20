<?php
// define a class to represent the form
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

// check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];

  // create a new form instance 
  $task = new form($firstName,$lastName);
   
  // make variable namePattern to match only alphabets
  $namePattern = "/^[a-zA-Z]+$/";
  
  // check if the first name and last name match the alphabets pattern
  if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName)) {
      // if they match, show the full name using the method
      $task->showfullname();
  } else {
      // if they don't match, display an error message
      echo "Invalid input. Please enter only alphabets for first name and last name.";
  }
}
?>