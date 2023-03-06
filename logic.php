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
  /** @var string $marks The marks input in alphabet|number.*/
  public $marks;

  /**
   * Constructor to initalize the form object
   *
   * @param string $firstName
   * @param string $lastName
   * @param string $fileName
   * @param string $fileTemp
   * @param string $marks
   * 
   * @return void
   */
  public function __construct($firstName, $lastName, $fileName, $fileTemp,$marks) {
    $this->first = $firstName;
    $this->last = $lastName;
    $this->filename = $fileName;
    $this->filetemp = $fileTemp;
    $this->marks=$marks;
  }

  /**
   * Method to show the full name.
   * 
   * @return void
   */
  public function showFullName() {
    // Concatenate the first and last name and store in the $full variable.
    $this->full = $this->first . " " . $this->last;

    // Print a message that includes the full name.
    echo "Hello " . $this->full;
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
   * 
   * @return array
   */
  public function splitMarks() {
    // Define the regular expression pattern.
    $pattern = '/[\n|]+/';
    // Use preg_split to split the marks string into an array.
    $subject_mark = preg_split($pattern, $this->marks);
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

  // Check if the first name and last name and marks match the pattern  
  if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName)) {
    // Create a new form instance
    $task = new Form($firstName,$lastName,$file_name,$file_tmp,$marks);
    
    // If they match, upload image using the method
    $task->uploadImage();
    
    // Print the image
    echo "<p><img src='upload-images/$file_name' alt='img'></p>";
    
    // If they match, show the full name using the method
    $task->showFullName();   
    
    // Split the marks using the method
    $subject_mark = $task->splitMarks();
    $j = count($subject_mark);
  }
  else { 
    // If they don't match, show the error message
    echo "Invalid input. Please enter only alphabets for first name and last name or provide marks in specified format";
  }
}

?>