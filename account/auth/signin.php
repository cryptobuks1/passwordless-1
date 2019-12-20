<?php

require '../includes/aura-config.php';

if (isset($_POST['signin-submit'])) {

    $authid = $_POST["authid"];

    $file_pointer = 'data/auth-'.$authid.'.php';
    
    if (file_exists($file_pointer)) { 
        include 'data/auth-'.$authid.'.php';
    } else { 
        echo '<meta http-equiv="Refresh" content="0; url=https://'SITE URL'/account/auth/error">';
    }

    # Security Variables
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    
    # Name and URL Variables
    $name = $authname;
    $url = $authurl."/auth?selector=".$selector."&validator=".bin2hex($token);
    
    # Database Variables
    $expires = date("U") + 1800;
    $userEmail = $_POST["email"];
    
    # Delete previous Passwordless requests
    $sql = "DELETE FROM passwordless WHERE email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: https://"SITE URL"/account/auth?authid=".$authid."&error=sqlerror");
        exit(); 
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }
    
    # Add new Passwordless request to the database
    $sql = "INSERT INTO passwordless (email, selector, token, expires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: https://"SITE URL"/account/auth?authid=".$authid."&error=sqlerror");
        exit(); 
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    # Set email variables
    
    $email = $userEmail;
    $emailSubject = "Sign in to your account";
    $emailTitle = "Sign In";
    $emailBody = "You have requested a link to sign in to ".$name.". This link will expire in a few minutes and you should delete this email when you've signed in.";
    $emailButtonURL = $url;
    $emailButtonTitle = "Sign In";
    
    # Send email to user
    include '../emails/email-template.php';
    
    session_unset();
    
    header("Location: https://"SITE URL"/account/auth/emailsent");
    
} else {
    header("Location: https://"SITE URL"/account/auth");
    exit();
}
?>