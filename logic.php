<?php
// Define a class to represent the form
class Form {
    // Public class properties
    public $first, $last, $full, $filename, $filetemp;

    // Constructor to initialize the first and last name
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
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Insert the value
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $file_name = $_FILES['img']['name'];
    $file_tmp = $_FILES['img']['tmp_name'];

    // Make variable namePattern to match only alphabets
    $namePattern = "/^[a-zA-Z]+$/";

    // Check if the first name and last name match the alphabets pattern
    if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName)) {
        // Create a new form instance
        $task = new Form($firstName, $lastName, $file_name, $file_tmp);

        // If they match, show the full name using the method
        $task->uploadImage();

        // Print the image
        echo "<p><img src='upload-images/$file_name' alt='img'></p>";
        $task->showFullName();
    } else {
        // If they don't match, show an error message
        echo "Invalid input. Please enter only alphabets for first name and last name.";
    }
}
?>
