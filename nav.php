<nav>
    <ul>
        <?php
            if (!isset($_SESSION['id']))
                echo '';
            else
                echo '<li><a href="logout.php">로그아웃</a></li>';
        ?>
        <li><a href="signup.html">회원 가입</a></li>
        <li><a href="main_0428.php">사진 게시판</a></li>
        <li><a href="grade.php">등급 설명</a></li>
    </ul>
</nav>