<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>로그인 결과</title>
    <meta charset="utf-8" />
</head>

<body>
    <?php
        require_once('dbcon.php');

        if (isset($_SESSION['id'])){
            exit('<a href="main.php">세션을 통해서 로그인 정보를 확인했습니다.</a></body></html>');
        }

        if (empty($_POST['email'])||empty($_POST['pass'])){
            echo "<script>alert('로그인 폼을채워주세요.');</script>";
            exit("<script>javascript:history.go(-1)</script>");
            //exit('<a href="">로그인 폼을 채워주세요.</a>');
        }

        $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");

        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $pass = mysqli_real_escape_string($dbc, trim($_POST['pass']));
    
        $query = "select id, email from user where email='$email' and password=SHA('$pass')";
        $result = mysqli_query($dbc, $query) 
        or die ("Error Querying database.");

        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            // $_SESSION['id'] = $row['id']; -> 에러 발생
            $userid = $row['id'];
            $_SESSION['id'] = $userid;

            setcookie('id', $row['id'], time() + (60*60*24));
            setcookie('email', $row['email'], time() + (60*60*24));

            echo "$email" . "님의 로그인에 성공했습니다.<br/><br/><a href='main.php'>홈으로</a>";
        }
        else{
            echo "로그인에 실패했습니다.<br/><br/><a href='main.php'>홈으로</a>";
        }
        mysqli_free_result($result);       
    ?>
</body>

</html>