<?php

if (isset($_SESSION['session_username'])) {
    echo '<h1>Redirecting</h1>
          <meta http-equiv="Refresh" content="0; url='SITE URL'">';
} else {
    echo '<h1>Sign In</h1>
          <br><p class="text-success">A link has been sent to your email address. You can now close this tab.</p><br>';
}

?>