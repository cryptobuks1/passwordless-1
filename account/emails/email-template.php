<?php

$to = $email;
$subject = $emailSubject;
$fontFam = '&#34;Inter&#34;';
$message = '<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://'SITE URL'/account/includes/bootstrap.min.css">
        <link href="https://rsms.me/inter/inter.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <section style="padding: 3em 0;">
            <div style="padding-left: 50px;padding-right: 50px;max-width: 1600px;">
                <br><h2 style="text-align:center;color: #545454;font-family:'.$fontFam.',sans-serif;font-size:2rem;line-height:1.2;font-weight:500;">'.$emailTitle.'</h2>
                <p style="text-align:center;font-size: 16px;line-height: 1.8;color: #545454;font-family:'.$fontFam.', sans-serif;">'.$emailBody.'</p>
                <div style="text-align:center">
                    <a style="text-align:center;left:50%;text-decoration: none;display: inline-block;font-size:16px;color: #545454;border-radius: 10px;border: none;webkit-transition: .3s all ease;-o-transition: .3s all ease;transition: .3s all ease;background-color: #f9f9f9;padding:10px 30px 10px 30px;font-family:'.$fontFam.',sans-serif;" href="'.$emailButtonURL.'">'.$emailButtonTitle.'</a><br><br>
                </div>
            </div>
        </section>
    </body>
</html>';

$headers = "From: "SENDER NAME" <"SEND EMAIL">\r\n";
$headers .= "Reply-To: "REPLY EMAIL"\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);