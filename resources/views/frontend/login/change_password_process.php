<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php require_once('function.php') ?>
<?php

$select_user = "select * from user where id_user = '" . $_SESSION['login']['id_user'] . "' ";
$cur_password = callsql($select_user);
$cur_password = $cur_password[0]['password'];

$pass = md5($_POST['cur_password']);
$new_pass = $_POST['new_password'];
$confirm_pass = $_POST['confirm_password'];

if ($pass != $cur_password){
    $_SESSION['change_password'] = 2;
    header("location:detail.blade.php");
}
if ($new_pass != $confirm_pass){
    $_SESSION['change_password'] = 3;
    header("location:detail.blade.php");
}
$new_pass = md5($new_pass);
$sql_update_password = "update user set password = '$new_pass' where id_user = '" . $_SESSION['login']['id_user'] . "' ";
if ($connect->query($sql_update_password) === TRUE) {
    $_SESSION['change_password'] = 1;
    header("location:detail.blade.php");
} else {
    $_SESSION['change_password'] = 0;
    echo "Lỗi: " . $sql_update_password . "<br>" . $conn->error;
    header("location:detail.blade.php");
}
?>
