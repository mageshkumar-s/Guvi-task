<?php

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "customer_details";

//create connection
$mysqli = new mysqli($serverName, $userName, $passWord, $dbName);

//check connection

// if ($mysqli->connect_error) {
//     die("Connection failed: " . $mysqli->connect_error);
//   }else{
//     echo "Connected successfully";
//   }


//get values
$email = $_POST['email'];
$passwrd = $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


if(isValidEmail(($email))){
    $stmt = $mysqli -> prepare("INSERT INTO login_details(email, password) VALUES(?,?)");
    $stmt -> bind_param("ss", $email, $passwrd);

    if ($stmt->execute()) {
      echo "Login successful!";
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $mysqli->close();
}else{
  echo "Invalid email address.";
}

function isValidEmail($email) {
  // Remove illegal characters from email
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  // Validate email address
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true; // Valid email
  } else {
      return false; // Invalid email
  }
}

?>