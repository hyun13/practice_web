<?php
require_once('includes/config.php');
require_once('login.php');

$login = new Login();

if ( $login->isUserLoggedIn() == true ) {
    include('index.php');
} else {
    include('not_logged_in.php');
}