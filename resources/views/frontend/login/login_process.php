<?php

$user_name = $_POST['user_name'];
$user_password = $_POST['password'];
$pass = md5($user_password);
//$pass = $user_password;
$sql_select_login = "SELECT * FROM `user` WHERE user_name = '$user_name'";
$login = callsql($sql_select_login);
if (!empty($login)) {
    $login = $login[0];
    if ($pass == $login['password']) {
        $_SESSION['login'] = $login;
        $_SESSION['login_success'] = 1;
        if ($login['role'] == 3){
            $_SESSION['login']['role'] == 3;
            header("location:admin/industry/admin-industry-page.php?page=1");
        }else{

            if (isset($_SESSION['url_before_login']) && $_SESSION['url_before_login'] != ''){
                $url_before_login = $_SESSION['url_before_login'];
                header("location:".$url_before_login);
            }else{
                header("location:detail.blade.php");
            }
        }
    } else {
        $_SESSION['login_success'] = 0;
        header("location:detail.blade.php");
    }
} else {
    $_SESSION['login_success'] = 0;
    header("location:detail.blade.php");
}
?>

