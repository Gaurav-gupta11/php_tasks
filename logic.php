<?php
class form{
      public $first,$last,$full,$filename,$filetemp;
       
      public function __construct($firstName,$lastName,$file_name,$file_temp){
          $this->first=$firstName;
          $this->last=$lastName;
          $this->filename=$file_name;
          $this->filetemp=$file_temp;

      }
      public function showfullname(){
        $message = "Hello " . $this->full = $this->first . " " . $this->last;
        echo $message;
      }
      public function uploadimage(){
        move_uploaded_file($this->filetemp,"upload-images/$this->filename");
      }
}
 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $file_name= $_FILES['img']['name'];
  $file_tmp = $_FILES['img']['tmp_name'];

  $name = "/^[a-zA-Z]+$/";
  if (preg_match($name, $firstName) && preg_match($name, $lastName)) {
      $task = new form($firstName,$lastName,$file_name,$file_tmp);
      $task->uploadimage();
      echo "<p><img src='upload-images/$file_name' alt='img'></p>";
      $task->showfullname();
  } else {
      echo "Invalid input. Please enter only alphabets for first name and last name.";
  }
}
  ?>