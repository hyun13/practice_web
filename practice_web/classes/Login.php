<?php
include_once '..header.php';
//echo "<div class='main'><h3>Please enter your details to log in</h3>";
$error = $user = $pass = "";
class Login {
    public $errors = array();

    public function __construct()
    {
        session_start();
        //if user tried to log out..
        if ( isset($_GET['logout']) ){
            $this->doLogout();
        }
        //login
        elseif (isset($_POST['login'])) {
            $this->dologinWithPostData();
        }
    }
    /*
     * log in post data
     */
    private function dologinWithPostData(){

        //check login form contents
        if (empty($_POST['user'])||$_POST['pass']) {
            $this->errors[] = "Not all fields were entered";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            $user = sanitizeString($_POST['user']);
            $pass = sanitizeString($_POST['pass']);

            $query = "SELECT user,pass FROM members
            WHERE user='$user' AND pass='$pass'";

            //if this user exists
            if (mysql_num_rows(queryMysql($query)) == 1)
            {
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
            }

        }
    }

    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";

    }

    public function isUserLoggedIn()
    {
        if ( isset($user) AND $_SESSION['pass']==1 ) {
            return true;
        }
        //default return
        return false;
    }
}
/*if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
    {
        //$error = "Not all fields were entered<br />";
        $error = "Not all fields were entered";
    }
    else
    {
        $query = "SELECT user,pass FROM members
            WHERE user='$user' AND pass='$pass'";

        if (mysql_num_rows(queryMysql($query)) == 0)
        {
            $error = "<span class='error'>Username/Password
                      invalid</span><br /><br />";
        }
        else
        {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            die("You are now logged in. Please <a href='members.php?view=$user'>" .
                "click here</a> to continue.<br /><br />");
        }
    }
}*/

//<<<_END
//<form method='post' action='login.php'>$error
//<span class='fieldname'>Username</span><input type='text'
//    maxlength='16' name='user' value='$user' /><br />
//<span class='fieldname'>Password</span><input type='password'
//    maxlength='16' name='pass' value='$pass' />
//_END;