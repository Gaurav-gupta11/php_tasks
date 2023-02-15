<?php
// Define a class to represent the form
class Form {
  public $first, $last, $full, $filename, $filetemp;
  //constructor to input data
  public function __construct($firstName, $lastName, $file_name, $file_temp) {
    $this->first = $firstName;
    $this->last = $lastName;
    $this->filename = $file_name;
    $this->filetemp = $file_temp;
  }

  // Function to display the full name
  public function showFullName() {
    $message = "Hello " . $this->full = $this->first . " " . $this->last;
    echo $message;
  }

  // Function to upload the image
  public function uploadImage() {
    // Validate if image is selected and not empty
    if (!empty($this->filename) && !empty($this->filetemp)) {
      move_uploaded_file($this->filetemp, "upload-images/$this->filename");
    }
  }

  public function splitMarks($marks){
    $pattern = "/[\n\|]+/";
    $subject_mark = preg_split($pattern, $marks);
    return $subject_mark;
  }
}
 
//Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //insert the value
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $file_name = $_FILES['img']['name'];
  $file_tmp = $_FILES['img']['tmp_name'];
  $marks = $_POST['marks'];
  // make variable namePattern to match only alphabets
  $namePattern = "/^[a-zA-Z]+$/";

  // make variable namePattern to match only alphabets
  $marksPattern = '/^[a-zA-Z]+\|[0-9]+$/m';

  // check if the first name and last name and marks match the pattern  
  if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName) && preg_match($marksPattern,$marks)) {

    // Create a new form instance
    $task = new Form($firstName,$lastName,$file_name,$file_tmp);
    
    // if they match, upload image using the method
    $task->uploadImage($file_name);
    
    // print the image
     echo "<p><img src='upload-images/$file_name' alt='img'></p>";
    
    // if they match, show the full name using the method
    $task->showFullName();   
    $subject_mark = $task->splitMarks($marks);
    $j=count($subject_mark);
  }
  else 
  { 
    // if they dont match, show the error message using the method
    echo "Invalid input. Please enter only alphabets for first name and last name or provide marks in specified format";
  }
}

