<?php
// Temporary hotfix for index error
error_reporting(E_ERROR);

// Breakdown post to variables for easier Email & CSV creation
$fullname = $_POST['firstname']. ' ' . $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address1 = $_POST['address1'];
$address2 =  $_POST['address2'];
$zip = $_POST['zipcode'];
$city = $_POST['city'];
$state = $_POST['state'];
$image = $_FILES['file_upload']['name'];
$date = date('h:iA F jS Y');
$time = $date;

// Change this to your installs URL
$link = "http://josephtesta.rocks/vfproject/";

// Require config.php
require(dirname(__FILE__)."/config.php");

// Check to see if file_upload is there
if (isset($_FILES['file_upload'])) 
{   
    
    // Set file location and upload file
    if (!move_uploaded_file($_FILES['file_upload']['tmp_name'], 'C:\wamp\www\JT-VividProject\images/' . $_FILES['file_upload']['name'])) {
    }
    
}

// Set the picture to default.jpg if nothing is uploaded
$_FILES['file_upload']['name'] = $_FILES['file_upload']['name'] ? $_FILES['file_upload']['name'] : 'default.jpg';

// Post submitted info to database
$sql = "INSERT INTO demo (name, email, phone, address1, address2, zip, city, state, image, time) VALUES ('" . $_POST['firstname'] . ' ' . $_POST['lastname'] . "','" . $_POST["email"] . "','" . $_POST["phone"] . "','" . $_POST["address1"] . "','" . $_POST["address2"] . "','" . $_POST["zipcode"] . "','" . $_POST["city"] . "','" . $_POST["state"] . "','" . $_FILES['file_upload']['name'] . "','" . $date . "')";

// Success message then send Email and create CSV file 
if ($conn->query($sql) === TRUE) {
    echo "<div class='container-fluid wrap'><div class='row center'><div class='col-whole'><h3 class='fancy center'>Your info has been submitted, good luck!</h3></div></div></div>";
// Checks if Emails unique, if not, exits script
} else {
    exit("<h3 class='fancy center'>This email has already been used!</h3>");
}

// Setup Email messages to admin and submitter
$to = "me@josephtesta.rocks";
$from = $email;
$title = 'Contest Submission';
$title2 = 'Contest Entry Information';
$message = $fullname . " submitted the following:" . "\n\n" . "Their Information:" . "\n" . "Name: " . $fullname . "\n" . "Phone: " . $phone . "\n" . "Address: " . $address1 . "\n" . "Address Two: " . $address2 . "\n" . "City: " . $city . "\n" . "State: " . $state . "\n" . "Image: " . $link . "images/" . $image . "\n" . "Time: " . $time . "\n";
$message2 = $fullname . ", we've recieved your entry!" . "\n\n" . "Your Information:" . "\n" . "Name: " . $fullname . "\n" . "Phone: " . $phone . "\n" . "Address: " . $address1 . "\n" . "Address Two: " . $address2 . "\n" . "City: " . $city . "\n" . "State: " . $state . "\n" . "Image: " . $link . "images/" . $image . "\n";

// Sending Email messages to admin and submitter
$headers = "From:" . $from;
$headers2 = "From:" . $to;
mail($to,$title,$message,$headers);
mail($from,$title2,$message2,$headers2); // sends a copy of the message to the sender

// Create new CSV file in subdirectory /csv and add posted data
$fp = fopen("csv/$fullname-$email.csv", "a");
$savestring = $fullname .",". $email .",". $phone .",". $address1 .",". $address2 .",". $zip .",". $city .",". $state .",". $image .",". $time;
fwrite($fp, $savestring);
fclose($fp);

// Close connection to database
$conn->close();

?>