<?PHP
    //启动会话
    session_start();
    //检测会话变量，是否已登录
    if (!isset($_SESSION['mail'])) {
        //跳转到登录页面
        $login_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
        header("Location: $login_url");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>个人中心</title>
    </head>
    <body>
        <h3><a href="index.html">首页</a></h3>
        <h3>Welcome,<?php echo $_SESSION["mail"]; ?>!</h3>
        <form method="post" action="logout.php">
            <input type="submit" name="submit" value="退出登录" />
        </form>
    </body>
</html>