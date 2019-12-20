<?php
                        
    error_reporting(0);

    $selector = $_GET["selector"];
    $validator = $_GET["validator"];

    $currentDate = date("U");

    require 'account/includes/aura-config.php';
    
    $sql = "SELECT * FROM passwordless WHERE selector=? AND expires >= ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: https://"SITE URL"/account/auth/error?error=token");
        exit(); 
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            header("Location: https://"SITE URL"/account/auth/error?error=sqlerror");
            exit();
        }
        else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["token"]);
            
            if ($tokenCheck === false) {
                header("Location: https://"SITE URL"/account/auth/error?error=sqlerror");
                exit();
            }
            else if ($tokenCheck === true) {
                $tokenEmail = $row['email'];
                
                $sql = "SELECT * FROM accounts WHERE emailUsers=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: https://"SITE URL"/account/auth/error?error=nouser");
                    exit(); 
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        header("Location: https://"SITE URL"/account/auth/error?error=nouser");
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mysqli_stmt_execute($stmt);

                        $sql = "DELETE FROM passwordless WHERE email=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: https://"SITE URL"/account/auth/error?error=sqlerror");
                            exit(); 
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                            mysqli_stmt_execute($stmt);
                        }
    
                        session_start();
                                
                        $_SESSION['session_user_id'] = $row['user_idUsers'];
                        $_SESSION['session_username'] = $row['usernameUsers'];
                        $_SESSION['session_email'] = $row['emailUsers'];
                        $_SESSION['session_first_name'] = $row['first_nameUsers'];
                        $_SESSION['session_last_name'] = $row['last_nameUsers'];
                        
                        header("Location: https://"SITE URL"/");
                        exit();
                    }
                }
            } else {
                header("Location: https://"SITE URL"/account/auth/error");
            }
        }
    }
?>