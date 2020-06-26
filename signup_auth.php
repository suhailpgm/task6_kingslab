<?php
// Include config file
include "connection.php";
 
// Define variables and initialize with empty values
$username = $password=$phone= "";
$username_err = $password_err = $phone_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
   // Validate username 
   if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
} else{
    // Prepare a select statement
    $sql = "SELECT ID FROM userdata WHERE username = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_username);
        
        // Set parameters
        $param_username = trim($_POST["username"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // store result
            $stmt->store_result();
            
            
                $username = trim($_POST["username"]);
        
        } else{
            echo "Oops! Something went wrong. Please try again later.11";
        }

        // Close statement
        $stmt->close();
    }
}





    // Validate phone 
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number";
    } else{
        // Prepare a select statement
        $sql = "SELECT ID FROM userdata WHERE phone = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_phone);
            
            // Set parameters
            $param_phone = trim($_POST["phone"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $phone_err = "This phone number is already taken.";
                } else{
                    $phone = trim($_POST["phone"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.22";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($phone_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO userdata (name, phone  ,password) VALUES (?,?,?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sis", $param_username,$param_phone, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_phone = $phone;
            $param_password =md5($password); // Creates a password hash
            echo $param_password;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.html");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>