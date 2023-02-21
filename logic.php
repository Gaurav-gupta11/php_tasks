<?php
// Define a class to represent the form
class Form {
  
  // Public class properties
  public $first, $last, $full, $filename, $filetemp, $phone;
  
  // constructor to input data
  public function __construct($firstName, $lastName, $file_name, $file_temp, $phone) {
    $this->first = $firstName;
    $this->last = $lastName;
    $this->filename = $file_name;
    $this->filetemp = $file_temp;
    $this->phone = $phone;
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

  // Function to split string into array
  public function splitMarks($marks){
    // Define the regular expression pattern
    $pattern = "/[\n\|]+/";
    
    // Use preg_split to split the marks string into an array
    $subject_mark = preg_split($pattern, $marks);
    
    // Return the resulting array
    return $subject_mark;
  }

  // Function to print phone number
  public function phoneNumber(){
    echo "<br>+91" . $this->phone;
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
  $phone = $_POST['phone'];

  // Make variable namePattern to match only alphabets
  $namePattern = "/^[a-zA-Z]+$/";

  // Make variable marksPattern to match only alphabets and numbers in specified format
  $marksPattern = '/^[a-zA-Z]+\|[0-9]+$/m';

  // Check if the first name, last name and marks match the pattern  
  if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName) && preg_match($marksPattern, $marks)) {

    // Create a new form instance
    $task = new Form($firstName, $lastName, $file_name, $file_tmp, $phone);
    
    // If they match, upload image using the method
    $task->uploadImage($file_name);
    
    // Print the image
    echo "<p><img src='upload-images/$file_name' alt='img'></p>";
    
    // If they match, show using method
    $task->showFullName();  // for name 
    
    // Split the marks string into an array
    $subject_mark = $task->splitMarks($marks);// for marks
    
    // Get the length of the array
    $j = count($subject_mark);// for count arraylength
    
    // Print the phone number using the method
    $task->phoneNumber();
  }
}
  ?>