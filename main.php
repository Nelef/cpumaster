<?php
    require_once("session.php");
    require_once("header.php");
    if (!isset($_SESSION['id']))
        echo '<form style="padding-inline-start: 40px;" method="POST" action="login.php" >
        이메일: <input type="text" name="email" placeholder="Enter your e-mail"/>
        비밀번호: <input type="password" name="pass" placeholder=" Enter your password." />
        
        <input class="login_btn" type="submit" value="로그인" /></form>';
        //<button type="submit" class="login_btn">로그인</button>';
    else
        echo '';
    require_once("nav.php");
?>

<section class="model">
    <div id="write_review"><a href="write_review_form.php">리뷰 등록</a></div>

    <article class="review">
        
    </article>
    
</section>

<?php
    require_once("footer.php");
?>