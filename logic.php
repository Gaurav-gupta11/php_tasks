<?php

/**
 * Defines a class to represent the form.
 */
class Form {
  /** @var string $first The first name input */
  public $first;
  /** @var string $last The last name input */
  public $last;
  /** @var string $full The full name concatenated from first and last names */
  public $full;
  /** @var string $filename The uploaded image filename.*/
  public $filename;
  /** @var string $filetemp The uploaded image temporary file path.*/
  public $filetemp;

  /**
   * Constructor to initalize the form object
   *
   * @param string $firstName
   * @param string $lastName
   * @param string $fileName
   * @param string $fileTemp
   * 
   * @return void
   */
  public function __construct($firstName, $lastName, $fileName, $fileTemp) {
    $this->first = $firstName;
    $this->last = $lastName;
    $this->filename = $fileName;
    $this->filetemp = $fileTemp;
  }

  /**
   * Method to show the full name.
   * 
   * @return void
   */
  public function showFullName() {
    // Concatenate the first and last name and store in the $full variable.
    $this->full = $this->first . ' ' . $this->last;
    // Create a message that includes the full name.
    $message = 'Hello ' . $this->full;

    // Output the message to the user.
    echo $message;
  }

  /**
   * Method to upload the image.
   * 
   * @return void
   */
  public function uploadImage() {
    // Validate if image is selected and not empty.
    if (!empty($this->filename) && !empty($this->filetemp)) {
      move_uploaded_file($this->filetemp, 'upload-images/' . $this->filename);
    }
  }

  /**
   * Method to split marks based on newline and '|' character.
   *
   * @param string $marks
   *
   * @return array
   */
  public function splitMarks($marks) {
    // Define the regular expression pattern.
    $pattern = '/[\n|]+/';
    // Use preg_split to split the marks string into an array.
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