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
   * Method to show the full name
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
   * Method to uploads the image.
   * 
   * @return void
   */
  public function uploadImage() {
    // Validate if image is selected and not empty.
    if (!empty($this->filename) && !empty($this->filetemp)) {
      move_uploaded_file($this->filetemp, "upload-images/$this->filename");
    }
  }
}

// Check if the form has been submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Insert the value.
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $fileName = $_FILES['img']['name'];
  $fileTemp = $_FILES['img']['tmp_name'];

  // Make variable namePattern to match only alphabets.
  $namePattern = "/^[a-zA-Z]+$/";

  // Check if the first name and last name match the alphabets pattern.
  if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName)) {
    // Create a new form instance.
    $form = new Form($firstName, $lastName, $fileName, $fileTemp);

    // If they match, show the full name using the method.
    $form->uploadImage();

    // Print the image.
    echo "<p><img src='upload-images/$fileName' alt='img'></p>";
    $form->showFullName();
  } else {
    // If they don't match, show an error message.
    echo "Invalid input. Please enter only alphabets for first name and last name.";
  }
}

?>