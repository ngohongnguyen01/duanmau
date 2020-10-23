<?php

//đường dãn

function connect()
{
    $host = "127.0.0.1";
    $dbname = "duanmau";
    $db_username = "root";
    $db_password = "";
    return new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
}

// lấy dữ liệu tất
function selectAll($sql)
{
    $conne = connect();
    $stml = $conne->prepare($sql);
    $stml->execute();
    return $slect = $stml->fetchAll();
}

//lấy 1 dữ liệu
function select_once($sql)
{
    $conne = connect();
    $stml = $conne->prepare($sql);
    $stml->execute();
    return $select = $stml->fetch();
}

// thêm dữ liệu , xóa , cập nhập
function insert_delete_update($sql)
{
    $conn = connect();
    $stml = $conn->prepare($sql);
    $stml->execute();
}

function dem($sql){
    $conn = connect();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}
