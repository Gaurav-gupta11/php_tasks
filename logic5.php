<?php
// Define a class to represent the form
class Form {
  public $first, $last, $full, $filename, $filetemp, $phone;
  //constructor to input data
  public function __construct($firstName, $lastName, $file_name, $file_temp,$phone) {
    $this->first = $firstName;
    $this->last = $lastName;
    $this->filename = $file_name;
    $this->filetemp = $file_temp;
    $this->phone = $phone;
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
  //Function to split string into array
  public function splitMarks($marks){
    $pattern = "/[\n\|]+/";
    $subject_mark = preg_split($pattern, $marks);
    return $subject_mark;
  }
  //Function to print phone number
  public function phoneNumber(){
    echo "<br>+91" . $this->phone . "<br>";
  }
  
  //Function to take info of email by mailboxlayer
  public function emailInformation($email){
    $curl = curl_init();

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
      CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    "<br>";
    return $response;
  }

  //method to check valid email
  public function emailValid($string){
    $array = json_decode($string);
    if($array->smtp_check == '1'){
      echo 'Email is valid';
    }
    else{
      echo 'Email is not valid';
    }
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
    
    //set bool to true if pattern matches
    $bool=true;

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
    $task->uploadImage($file_name);
    
    // print the image
     echo "<p><img  width=400px; height=200px; src='upload-images/$file_name' alt='img'></p>";
    
    // if Pattern match,  call methods
    $task->uploadImage($file_name);// for uploading image
    $task->showFullName();  // for name 
    $subject_mark = $task->splitMarks($marks);// for marks
    $j=count($subject_mark);// for count arraylength
    $task->phoneNumber();// for print phone number
    echo "Valid email syntax<br>"; // print if email syntax is valid
    $string = $task->emailInformation($email); // to get the information of email from mailboxlayer
    $task->emailValid($string); //check if email id is valid
    }
}
  else 
  { 
    // if they dont match, show the error message using the method
    echo "Invalid input. Please enter only alphabets for first name and last name or provide marks in specified format";
  }
}
