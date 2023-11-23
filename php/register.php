<?php

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "customer_details";

//create connection
$mysqli = new mysqli($serverName, $userName, $passWord, $dbName);

//check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


//get values
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$passwrd = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (isValidEmail($email)) {
    //check if the email already exist
    $stmt = $mysqli->prepare("SELECT email FROM registration_details WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists, display an error
        echo "Error: This email is already registered.";
    }else{
        //Email does not exist
        $stmt = $mysqli->prepare("INSERT INTO registration_details (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullName, $email, $passwrd);

        if ($stmt->execute()) {
            echo "Sign-up successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

$mysqli->close();

} else {
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
