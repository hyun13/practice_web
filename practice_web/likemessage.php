<?php
include_once 'header.php';

if (!$loggedin) { die(); }
if (isset($_GET['view'])) { $view = sanitizeString($_GET['view']); }
else                      { $view = $user; }

echo "<div class='main'>";
    $likemessage = array();

    $result = queryMysql("SELECT  * FROM messages LEFT JOIN addlike ON messages.id = addlike.l_id WHERE addlike.user = '$view' ");
    //$num = mysql_num_rows($result);


while ( $row = mysql_fetch_object($result)){
    echo date('M jS \'y g:ia:', $row->time)
        ."&quot;$row->message&quot;</span><br />";
}

?>

</div><br /></body></html>
