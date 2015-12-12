<?php
session_start();

include 'function.php';

$userstr = ' (Guest)';

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
}
else $loggedin = FALSE;
?>
<!DOCTYPE html>
<html>
<head><script src='OSC.js'></script>
    <title><?=$appname.$userstr?></title>
    <link rel='stylesheet' "href='styles.css' type='text/css' />
</head><body><div class='appname'><?=$appname.$userstr?></div>
<?php
if ($loggedin)
{
    echo "<br ><ul class='menu'>" .
        "<li><a href='members.php?view=$user'>Home</a></li>" .
        "<li><a href='members.php'>Members</a></li>" .
        "<li><a href='friends.php'>Friends</a></li>" .
        "<li><a href='messages.php'>Messages</a></li>" .
        "<li><a href='likemessage.php'>Like Messages</a></li>" .
        "<li><a href='logout.php'>Log out</a></li></ul><br />";
}
else
{
    echo ("<br /><ul class='menu'>" .
        "<li><a href='index.php'>Home</a></li>" .
        "<li><a href='signup.php'>Sign up</a></li>" .
        "<li><a href='login.php'>Log in</a></li></ul><br />" .
        "<span class='info'>&#8658; You must be logged in to " .
        "view this page.</span><br /><br />");
}
?>
