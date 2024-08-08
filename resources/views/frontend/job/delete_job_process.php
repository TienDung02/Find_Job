<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php
//$page = $_GET['page'];
$id = $_GET['id'];
$sql = "DELETE FROM job WHERE id  = $id ";
if ($connect->query($sql) === TRUE) {
    $_SESSION['delete_job'] = 1;
    header("location:manage.blade.php");
} else {
    $_SESSION['delete_job'] = 0;
    header("location:manage.blade.php");
}
?>
