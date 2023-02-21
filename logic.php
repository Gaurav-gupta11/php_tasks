<?php
// Define a class to represent the form
class Form {
    // Public class properties
    public $first, $last, $full, $filename, $filetemp, $phone;

    //constructor to input data
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

    //Function to split string into array
    public function splitMarks($marks){
        // Define the regular expression pattern
        $pattern = "/[\n\|]+/";

        // Use preg_split to split the marks string into an array
        $subject_mark = preg_split($pattern, $marks);

        // Return the resulting array
        return $subject_mark;
    }

    //Function to print phone number
    public function phoneNumber(){
        // Print the phone number with appropriate formatting
        echo "<br>+91" . $this->phone . "<br>";
    }

    //Function to take info of email by mailboxlayer
    public function emailInformation($email){
        // Initialize a new curl session
        $curl = curl_init();

        // Set curl options
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

        // Execute the curl request and store the response
        $response = curl_exec($curl);

        // Close the curl session
        curl_close($curl);

        // Return the response
        return $response;
    }

    //method to check valid email
    public function emailValid($string){
        // Decode the JSON response from mailboxlayer
        $array = json_decode($string);

        // Check if the email is valid using the SMTP check
        if($array->smtp_check == '1'){
            echo 'Email is valid';
        } else {
            echo 'Email is not valid';
        }
    }
    //Method to print marks
    public function printMarks($subject_mark,$j){
      //Print the HTML Table format
      echo"<table> <thead><tr><th>Subject</th><th>Marks</th></tr></thead>";
        
        //For loop to print subject and marks in table
        for($i=0;$i<$j;$i++) {

          echo"<tr><td>";echo $subject_mark[$i];echo"</td><td>";    
          echo $subject_mark[$i=$i+1];echo"</td></tr>";
        } echo "</table>";


    }
    // Method to download file
    public function downloadFile($firstName ,  $lastName ,$email, $phone,$marks){
      // Define the file name
      $filename = uniqid() . '.doc';
      // Define the document content
      $doc_content = "Name: $firstName $lastName \nEmail: $email\nPhone: $phone\nMarks:\n Subject | Marks\n";

      // Split the subject and marks using the splitMarks method
      $subject_mark = $this->splitMarks($marks);

      // Get the array length
      $j = count($subject_mark);

      // For loop to add the subject and marks to the document content
      for($i=0; $i<$j; $i++) {
        $doc_content .= "    " . $subject_mark[$i] . "   ";
            $doc_content .= "    " . $subject_mark[$i=$i+1] . "\n";
          }

      //Put contents in file
      file_put_contents($filename, $doc_content);

      //Print doc_content
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