<?php
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
}
?>
<div class='main'><h3>Please enter your details to log in</h3>
<form method='post' action='Login.php'>
    <span class='fieldname'>Username</span>
    <input type='text' maxlength='16' name='user' value='' /><br />
    <span class='fieldname'>Password</span>
    <input type='password' maxlength='16' name='pass' value='' />
    <br />
    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Login' />
</form><br /></div></body></html>