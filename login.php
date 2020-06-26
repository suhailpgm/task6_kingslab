

<?php

include "connection.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Username and password sent from form in HTML
    $login_phone = $_POST['lphone'];
    $login_password = $_POST['lpassword'];
    $login_password=md5($login_password);


    
    


    $sql= "SELECT ID FROM userdata WHERE phone='$login_phone' and password='$login_password' ";
    
    $result = mysqli_query($mysqli,$sql);
    
    // $row    = mysql_fetch_array($result);
    // $active = $row['active'];
    $count  = mysqli_num_rows($result);
     
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count === 1){
    
        header('location:home.php');
    }else{
        echo "invalid credential";
        header('location:welcome.php');
        
    }
    }
    ?>