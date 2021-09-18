<?php
    //定义连接数据库参数
    define('db_host','localhost');
    define('db_user','oasis');
    define('db_password','456123');
    define('db_name','oasis');
    //连接数据库
    $dbc = mysqli_connect(db_host,db_user,db_password,db_name) or die('连接数据库失败');
?>