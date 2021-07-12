<?php
    header('Content-Type: application/json;charset=UTF-8');
    require_once('dbcon.php');

    $dbc = mysqli_connect($host, $user, $pass, $dbname)
                    or die("Error Connecting to MySQL Server.");
    mysqli_query($dbc, 'set names utf8');

    $query = "select reviewid, userid, email, memo, time from review, user 
                        where userid=user.id order by time desc limit 0, 30";
                        // 0, 30 : 0부터 29까지 
                        // 수많은 내용들중 30개씩 잘라서 가져온다는 의미.
    $result = mysqli_query($dbc, $query) or die("Error Querying database.");
    $json = array();
    while($row = mysqli_fetch_assoc($result)){
        $replyquery = "select replyid, userid, email, memo, time from reply, user where reviewid = $row[reviewid] and user.id=reply.userid order by time desc limit 0, 30";
        $replyresult = mysqli_query($dbc, $replyquery) or die("Error Querying Reply.");
        $replyjson = array();

        while($replyrow=mysqli_fetch_assoc($replyresult)){
            $replyjson['reply'][]=$replyrow;
        }
        $json['review'][]=$row + $replyjson;

        mysqli_free_result($replyresult);
    }
    mysqli_free_result($result);
    mysqli_close($dbc);

    echo json_encode($json);
?>