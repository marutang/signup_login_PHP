<?PHP
    
    //检测是否提交表单
    if (isset($_POST['submit'])) {
        //启动会话
        session_start();
        //清除会话变量
        $_SESSION = array();
        //清除可能被会话使用的cookie
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(),'',time() - 3600);
        }
        //销毁会话
        session_destroy();
    }
    //跳转到首页
    $index_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.html';
    header("Location: $index_url");
?>