<?php

$authid = $_GET["authid"];

$file_pointer = 'data/auth-'.$authid.'.php';

if (file_exists($file_pointer)) { 
    include 'data/auth-'.$authid.'.php';
} else { 
    echo '<meta http-equiv="Refresh" content="0; url=https://'SITE URL'/account/auth/?authid=1&error=badauth">';
}

?>

<?php

if (isset($_SESSION['session_username'])) {
    echo '<h1 data-aos="fade-up" data-aos-delay="500">Redirecting</h1>
          <p class="lead" data-aos="fade-up" data-aos-delay="750">Please wait...</p>
          <meta http-equiv="Refresh" content="0; url=https://'SITE URL'/">';
} else {
    include 'signin-form.php';
}

?>
