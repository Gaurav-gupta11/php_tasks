<?php

// Define a class to represent the form
class Form {
  
  // Public class properties
  public $first, $last, $full, $filename, $filetemp;
  
  // Constructor to input data
  public function __construct($firstName, $lastName, $file_name, $file_temp) {
    $this->first = $firstName;
    $this->last = $lastName;
    $this->filename = $file_name;
    $this->filetemp = $file_temp;
  }

  // Method to show the full name
  public function showFullName() {
    // Concatenate the first and last name and store in the $full variable
    $this->full = $this->first . " " . $this->last;
    // Create a message that includes the full name
    $message = "Hello " . $this->full;

    // Output the message to the user
    echo $message;
  }

  // Function to upload the image
  public function uploadImage() {
    // Validate if image is selected and not empty
    if (!empty($this->filename) && !empty($this->filetemp)) {
      move_uploaded_file($this->filetemp, "upload-images/$this->filename");
    }
  }

  // Function to split marks based on newline and '|' character
  public function splitMarks($marks) {
    // Define the regular expression pattern
    $pattern = "/[\n\|]+/";
    // Use preg_split to split the marks string into an array
    $subject_mark = preg_split($pattern, $marks);
    return $subject_mark;
  }
}
 
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Insert the value
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $file_name = $_FILES['img']['name'];
  $file_tmp = $_FILES['img']['tmp_name'];
  $marks = $_POST['marks'];

  // Make variable namePattern to match only alphabets
  $namePattern = "/^[a-zA-Z]+$/";

  // Make variable namePattern to match only alphabets
  $marksPattern = '/^[a-zA-Z]+\|[0-9]+$/m';

  // Check if the first name and last name and marks match the pattern  
  if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName) && preg_match($marksPattern,$marks)) {
    // Create a new form instance
    $task = new Form($firstName,$lastName,$file_name,$file_tmp);
    
    // If they match, upload image using the method
    $task->uploadImage($file_name);
    
    // Print the image
    echo "<p><img src='upload-images/$file_name' alt='img'></p>";
    
    // If they match, show the full name using the method
    $task->showFullName();   
    
    // Split the marks using the method
    $subject_mark = $task->splitMarks($marks);
    $j = count($subject_mark);
  }
  else { 
    // If they don't match, show the error message
    echo "Invalid input. Please enter only alphabets for first name and last name or provide marks in specified format";
  }
}

?>