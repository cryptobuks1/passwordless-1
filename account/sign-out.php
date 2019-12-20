<?php

require 'includes/aura-config.php';

session_start();
session_unset();
session_destroy();
header("Location: https://".$siteURL."/account/auth/?authid=1&sign-out");

?>