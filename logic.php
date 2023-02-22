<?php
/**
 * Class Form
 *
 * Represents a form with inputs
 */
class Form {
  /** @var string $first The first name input */
  public $first;
  /** @var string $last The last name input */
  public $last;
  /** @var string $full The full name concatenated from first and last names */
  public $full;

  /**
   * Constructor to initialize the first and last name
   *
   * @param string $firstName
   * @param string $lastName
   * 
   * @return void
   */
  public function __construct($firstName, $lastName) {
    $this->first = $firstName;
    $this->last = $lastName;
  }

  /**
   * Method to show the full name
   *
   * @return void
   */
  public function showFullName() {
    // Concatenate the first and last name and store in the $full variable
    $this->full = $this->first . " " . $this->last;

    // Create a message that includes the full name
    $message = "Hello " . $this->full;

    // Output the message to the user
    echo $message;
  }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];

  // Create a new form instance 
  $task = new Form($firstName, $lastName);

  // Make variable namePattern to match only alphabets
  $namePattern = "/^[a-zA-Z]+$/";

  // Check if the first name and last name match the alphabets pattern
  if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName)) {
    // If they match, show the full name using the method
    $task->showFullName();
  }
  else {
    // If they don't match, display an error message
    echo "Invalid input. Please enter only alphabets for first name and last name.";
  }
}
?>
