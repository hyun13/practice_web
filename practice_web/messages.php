<?php
include_once 'header.php';

if (!$loggedin) die();

if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else                      $view = $user;

if (isset($_POST['text']))
{
    $text = sanitizeString($_POST['text']);

    if ($text != "")
    {
        //$pm   = substr(sanitizeString($_POST['pm']),0,1);
        $pm   = 0; //removed. dont separete the message.
        $time = time();
        queryMysql("INSERT INTO messages VALUES(NULL, '$user',
            '$view', '$pm', $time, '$text')");
    }
}

if ($view != "")
{
    if ($view == $user) $name1 = $name2 = "Your";
    else
    {
        $name1 = "<a href='members.php?view=$view'>$view</a>'s";
        $name2 = "$view's";
    }

    echo "<div class='main'><h3>$name1 Messages</h3>";

    echo <<<_END
<form method='post' action='messages.php?view=$view'>
Type here to leave a message:<br />
<textarea name='text' cols='40' rows='3'></textarea><br />
<input type='submit' value='Post Message' /></form><br />
_END;
    if (isset($_GET['add']))
    {
        $add = sanitizeString($_GET['add']);
        queryMysql("INSERT INTO addlike VALUES ('$user','$add')");
    }

    elseif (isset($_GET['erase']))
    {
        $erase = sanitizeString($_GET['erase']);
        queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
    }

    $query  = "SELECT * FROM messages LEFT JOIN friends ON messages.auth = friends.user WHERE friends.friend = '$user' OR messages.auth = '$user' ";
    $result = queryMysql($query);
    $num    = mysql_num_rows($result);

    while ( $row = mysql_fetch_object($result) )
    {
        if ($row->pm == 0 || $row->auth == $user || $row->recip == $user)
        {
            echo date('M jS \'y g:ia:', $row->time);
            echo " $row->auth ";
            if ($row->pm == 0)
                echo "wrote: &quot;{$row->message}&quot; ";

            if ($row->recip == $user)
                echo "[<a href='messages.php?view=$view" .
                    "&erase={$row->id}'>erase</a>]";
            else echo "[<a href='messages.php?add=$row->id" .
                "&like={$row->id}'>like</a>]";

            echo "<br>";

        }
    }
}

if (!$num) echo "<br /><span class='info'>No messages yet</span><br /><br />";

echo "<br /><a class='button' href='messages.php?view=$view'>Refresh messages</a>";
?>

</div><br /></body></html>
