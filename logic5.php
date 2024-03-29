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
  /** @var int $phone The phone number input */
  public $phone;
  /** @var string $email The email input */
  public $email;

  /**
   * Constructor to initalize the form object
   *
   * @param string $firstName
   * @param string $lastName
   * @param string $fileName
   * @param string $fileTemp
   * @param string $marks
   * @param int    $phone
   * @param string $email
   * 
   * @return void
   */
  public function __construct($firstName, $lastName, $fileName, $fileTemp, $marks, $phone, $email) {
    $this->first = $firstName;
    $this->last = $lastName;
    $this->filename = $fileName;
    $this->filetemp = $fileTemp;
    $this->marks = $marks;
    $this->phone = $phone;
    $this->email = $email;
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
   * @return array
   */
  public function splitMarks() {
    // Define the regular expression pattern.
    $pattern = '/[\n|]+/';
    // Use preg_split to split the marks string into an array.
    $subject_mark = preg_split($pattern, $this->marks);
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
   * @return string
   * The API response as a JSON string.
   */
  public function emailInformation() {
    // Initialize a new cURL session.
    $curl = curl_init();
    // Set cURL options.
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $this->email,
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
   */
  public function emailValid($string) {
    // Decode the JSON response from Mailboxlayer.
    $array = json_decode($string);
    // Check if the email is valid using the SMTP check.
    if ($array->smtp_check == '1') {
    echo 'Email is valid';
    }
    else {
    echo 'Email is not valid';
    }
  }
}
echo"<link rel=stylesheet href=style.css>";

//Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
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
    
    //set bool to true if pattern matches
    $bool=true;

    // Create a new form instance
    $task = new Form($firstName,$lastName,$file_name,$file_tmp,$marks,$phone,$email);

    //To check email syntax is correct
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      //If email syntax is not correct show error
      $emailErr = "Invalid email synatx check<br>";
      echo $emailErr;
    }
    else
    {
    
    // print the image
     echo "<p><img  width=400px; height=200px; src='upload-images/$file_name' alt='img'></p>";
    
    // if Pattern match,  call methods
    $task->uploadImage();// for uploading image
    $task->showFullName();  // for name 
    $subject_mark = $task->splitMarks();// for marks
    $j=count($subject_mark);// for count arraylength
    $task->phoneNumber();// for print phone number
    echo "<br>Valid email syntax<br>"; // print if email syntax is valid
    $string = $task->emailInformation(); // to get the information of email from mailboxlayer
    $task->emailValid($string); //check if email id is valid
    }
}
  else 
  { 
    // if they dont match, show the error message using the method
    echo "Invalid input. Please enter only alphabets for first name and last name or provide marks in specified format";
  }
}
