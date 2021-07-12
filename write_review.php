<?php
    require_once("session.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>리뷰 등록 결과</title>
    <meta charset="utf-8" />
</head>

<body>
    <?php
        require_once('dbcon.php');

        if(!isset($_SESSION['id'])){
            exit('<a href="main.php">로그인 상태가 아닙니다. 홈으로</a>');
        }

        if (empty($_POST['memo'])||empty($_FILES['picture']['tmp_name'])){
            exit('<a href="javascript:history.go(-1)">입력 폼을 채워주세요.</a></body></html');
        }
        
        if(!isset($_FILES['picture'])){
            exit('<a href="javascript:history.go(-1)">이미지 업로드 에러가 발생했습니다.</a></body></html');
        }

        $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");

        $id=$_SESSION['id'];
        $memo = mysqli_real_escape_string($dbc, trim($_POST['memo']));
        $image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));

        mysqli_query($dbc, 'set names utf8');


        $query = "insert into review values (null, $id, NOW(), '$image', '$memo')";

        $result = mysqli_query($dbc, $query) 
        or die ("Error Querying database.");

        mysqli_close($dbc);

        echo "리뷰가 등록되었습니다.<br/><br/>";
        echo '<a href="main.php">홈으로</a>';
    ?>
</body>

</html>