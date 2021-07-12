<!DOCTYPE html>
<html>

<head>
    <title>회원 가입 결과</title>
    <meta charset="utf-8" />
</head>

<body>
    <?php
        require_once('dbcon.php');

        if (empty($_POST['email'])||empty($_POST['pass'])||empty($_POST['passcon'])){
            exit('<a href="javascript:history.go(-1)">입력 폼을 채워주세요.</a>');
        }

        if(!isset($_FILES['userimg'])){
            exit('<a href="javascript:history.go(-1)">이미지 업로드 에러가 발생했습니다.</a>');
        }

        // echo $_FILES['userimg']['tmp_name'];
        // $imagepath = "./images/" . uniqid("img") . "." . pathinfo($_FILES['userimg']['name'],PATHINFO_EXTENSION );
        // if(!move_uploaded_file($_FILES['userimg']['tmp_name'], $imagepath)){
        //     exit('<a href="javascript:history.go(-1)">이미지 에러가 발생했습니다.</a>');
        // }


        $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");

        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $pass = mysqli_real_escape_string($dbc, trim($_POST['pass']));
        $passcon = mysqli_real_escape_string($dbc, trim($_POST['passcon']));
        $image = addslashes(file_get_contents($_FILES['userimg']['tmp_name']));

        $query = "select id from user where email='$email'";
        $result = mysqli_query($dbc, $query) 
        or die ("Error Querying database.");

        if (mysqli_num_rows($result) != 0){
            exit('<a href="javascript:history.go(-1)">이미 등록된 e-mail 입니다.</a>');
        }
        mysqli_free_result($result);

        mysqli_query($dbc, 'set names utf8');

        $query = "insert into user values (null, '$email', SHA('$pass'), '$image')";
        
        $result = mysqli_query($dbc, $query) 
        or die ("Error Querying database.");

        mysqli_close($dbc);
        echo "<img src='userimage.php?email=$email' alt='User image' style='width:80px;height:80px'/><br/>";
        echo "$email" . "님의 회원 가입을 축하드립니다.<br/><br/>";
        echo '<a href="/main.php">홈으로</a>';
        
    ?>
</body>

</html>