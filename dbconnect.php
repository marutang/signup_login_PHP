<?php
    //定义连接数据库参数
    define('db_host','');
    define('db_user','');
    define('db_password','');
    define('db_name','');
    //连接数据库
    $dbc = mysqli_connect(db_host,db_user,db_password,db_name) or die('连接数据库失败');
?>
