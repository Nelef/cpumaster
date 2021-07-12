<?php
    header('Content-Type: text/xml;charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<review_list>
    <?php
        require_once('dbcon.php');

        $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");

        mysqli_query($dbc, 'set names utf8');

        $query = "select reviewid, userid, email, memo, time from review, user where userid=user.id order by time desc";
        $result = mysqli_query($dbc, $query)
        or die("Error Querying database.");

        while($row = mysqli_fetch_assoc($result)){
            print ('<review>');
            printf('<user_image>getpicture.php?reviewid=%s</user_image>', $row['reviewid']);
            printf('<user_memo>%s</user_memo>', $row['memo']);
            print ('<user_info>');
            printf('<user_thumbnail>userimage.php?email=%s</user_thumbnail>', $row['email']);
            printf('<user_email>%s</user_email>', $row['email']);
            print ('</user_info>');
            printf('<user_date>%s</user_date>', $row['time']);
            print ('</review>');
            
        }
        mysqli_free_result($result);
        mysqli_close($dbc);
    ?>
</review_list>
