<?PHP
    //启动会话
    session_start();
    //检测会话变量，是否已登录
    if (isset($_SESSION['mail'])) {
        //跳转到个人主页
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';
        header("Location: $home_url");
        exit();
    }
    //定义提醒变量并设置为空值
    $mailErr = $pwErr = "";
    $mail = $password = "";
    //检测是否提交表单
    if(isset($_POST['submit'])){
        //连接数据库服务器
        require_once('dbconnect.php');
        //提取表单数据，去掉前后空格以及特殊字符转义，防止SQL注入攻击
        $mail = mysqli_real_escape_string($dbc,trim($_POST['mail']));
        $password = mysqli_real_escape_string($dbc,trim($_POST['password']));
        //检查表单内容是否为空
        if (empty($mail)) {
            $mailErr = "邮箱不得为空！";
        }
        if (empty($password)) {
            $pwErr = "密码不得为空！";
        }
        //检查表单是否合法
        if(!empty($mail) && !empty($password)){
            //检查是否已注册邮箱
            $query = "SELECT * FROM user WHERE mail = '$mail'";
            $data = mysqli_query($dbc,$query);
            if (mysqli_num_rows($data) == 0) {
                $mailErr = "该邮箱未注册！";
            } else {
                //检查密码是否正确
                $query = "SELECT mail,password FROM user WHERE mail = '$mail' AND password = SHA('$password')";
                $data = mysqli_query($dbc,$query);
                if (mysqli_num_rows($data) == 0) {
                    $pwErr = "密码错误！";
                } else {
                    //退出数据库
                    mysqli_close($dbc);
                    //完成登录认证
                    $_SESSION['mail'] = $mail;
                    //跳转到个人主页
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';
                    header("Location: $home_url");
                    exit();
                }
            }
            
        }
        //退出数据库
        mysqli_close($dbc);
    }
?>
        
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>登录</title>
        <!-- 表单提醒设为红色 -->
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>
        <!-- 自引用表单，转义url，防止XSS攻击 -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr>
                    <td>邮箱：</td>
                    <td><input type="text" name="mail" value="<?php echo $mail;?>" /><span class="error">*<?php echo $mailErr;?></span></td>
                </tr>
                <tr>
                    <td>密码：</td>
                    <td><input type="password" name="password" value="<?php echo $password;?>" /><span class="error">*<?php echo $pwErr;?></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="登录" /></td>
                </tr>
            </table>
            <p>点击此处<a href="signup.php">注册</a></p>
        </form>
    </body>
</html>