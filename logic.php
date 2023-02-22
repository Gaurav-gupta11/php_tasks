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
  /** @var int $phone The phone number input */
  public $phone;

  /**
   * Constructor to initalize the form object
   *
   * @param string $firstName
   * @param string $lastName
   * @param string $fileName
   * @param string $fileTemp
   * @param int    $phone
   * 
   * @return void
   */
  public function __construct($firstName, $lastName, $fileName, $fileTemp, $phone) {
    $this->first = $firstName;
    $this->last = $lastName;
    $this->filename = $fileName;
    $this->filetemp = $fileTemp;
    $this->phone = $phone;
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

  /**
   * Method to print phone number
   *
   * @return void
   */
  public function phoneNumber(){
    echo "<br>+91" . $this->phone;
  }

  /**
   *
   * Returns information about an email using the Mailboxlayer API.
   *
   * @param string $email
   * 
   * @return string
   * The API response as a JSON string.
   */
  public function emailInformation($email) {
    // Initialize a new cURL session.
    $curl = curl_init();
    // Set cURL options.
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $email,
    CURLOPT_HTTPHEADER => array(
    "Content-Type: text/plain",
    "apikey: 9di1H8UdmecvJtJilzeHnETFhsPQN17I"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    ));
    
    // Execute the cURL request and store the response.
    $response = curl_exec($curl);
    
    // Close the cURL session.
    curl_close($curl);
    
    // Return the response.
    return $response;
  }
    
  /**
   * Checks if an email is valid using the Mailboxlayer API response.
   *
   * @param string $string
   * 
   * @return string
   */
  public function emailValid($string) {
    // Decode the JSON response from Mailboxlayer.
    $array = json_decode($string);
    // Check if the email is valid using the SMTP check.
    if ($array->smtp_check == '1') {
    return 'Email is valid';
    }
    else {
    return 'Email is not valid';
    }
  }

  /**
   * Prints subject marks in an HTML table.
   *
   * @param array $subject_mark
   *
   * @return void
   */
  public function printMarks(array $subject_mark) {
    // Print the HTML table format.
    echo "<table><thead><tr><th>Subject</th><th>Marks</th></tr></thead>";
  
    // For loop to print subject and marks in table.
    for ($i = 0, $j = count($subject_mark); $i < $j; $i++) {
      echo "<tr><td>";
      echo $subject_mark[$i];
      echo "</td><td>";
      echo $subject_mark[$i=$i+1];
      echo "</td></tr>";
    }
    echo "</table>";
  }
  
  /**
   * Generates and downloads a file with given user information and marks.
   *
   * @param string $firstName
   *   First name of the user.
   * @param string $lastName
   *   Last name of the user.
   * @param string $email
   *   Email of the user.
   * @param string $phone
   *   Phone number of the user.
   * @param string $marks
   *   A string containing subject and corresponding marks.
   */
  public function downloadFile(string $firstName, string $lastName, string $email, string $phone, string $marks) {
    // Define the file name.
    $filename = uniqid() . '.doc';
  
    // Define the document content.
    $doc_content = "Name: $firstName $lastName \nEmail: $email\nPhone: $phone\nMarks:\n Subject | Marks\n";
  
    // Split the subject and marks using the splitMarks method.
    $subject_mark = $this->splitMarks($marks);
  
    // Get the array length.
    $j = count($subject_mark);
  
    // For loop to add the subject and marks to the document content.
    for ($i = 0; $i < $j; $i++) {
      $doc_content .= "    " . $subject_mark[$i] . "   ";
      $doc_content .= "    " . $subject_mark[$i=$i+1] . "\n";
    }
  
    // Put contents in file.
    file_put_contents($filename, $doc_content);
  
    // Print doc_content.
    echo $doc_content;
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
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  // make variable namePattern to match only alphabets
  $namePattern = "/^[a-zA-Z]+$/";

  // make variable namePattern to match only alphabets
  $marksPattern = '/^[a-zA-Z]+\|[0-9]+$/m';
  
  //set bool to false
  $bool=false;

  // check if the first name and last name and marks match the pattern  
  if (preg_match($namePattern, $firstName) && preg_match($namePattern, $lastName) && preg_match($marksPattern,$marks)) {

    // Create a new form instance
    $task = new Form($firstName,$lastName,$file_name,$file_tmp,$phone);

    //To check email syntax is correct
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      //If email syntax is not correct show error
      $emailErr = "Invalid email synatx check<br>";
      echo $emailErr;
    }
    else
    {
      //If click on download butto
      if (isset($_POST['download'])) {
      // Define the content-type and headers for the downloaded document
      header('Content-Type: application/vnd.ms-word');
      header('Content-Disposition: attachment;filename="form_data.doc"');
      //Call downloadFile method
      $task->downloadFile($firstName ,  $lastName ,$email, $phone,$marks);
      
      // Output the document content for download
      

      //If click on submit button
    } elseif (isset($_POST['submit'])) {
      // Display the document content in the browser
      $bool=true;
    
    
    // print the image
     echo "<p><img  width=400px; height=200px; src='upload-images/$file_name' alt='img'></p>";
    
    // if Pattern match,  call methods
    $task->uploadImage($file_name);// for uploading image
    $task->showFullName();  // for name 
    $subject_mark = $task->splitMarks($marks);// for marks
    $j=count($subject_mark);// for count arraylength
    $task->printMarks($subject_mark,$j);
    $task->phoneNumber();// for print phone number
    echo "Valid email syntax<br>"; // print if email syntax is valid
    $string = $task->emailInformation($email); // to get the information of email from mailboxlayer
    $task->emailValid($string); //check if email id is valid
    }
}
  }
   else 
  { 
    // if they dont match, show the error message using the method
    echo "Invalid input. Please enter only alphabets for first name and last name or provide marks in specified format";
  }

}

?>