<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php require_once('function.php') ?>
<?php

$postday = date('Y-m-d');
$updateday = date('Y-m-d');

$id_job = $_GET['id'];
$id_candidate = $_SESSION['login']['id_candidate'];
$full_name = $_POST['full_name'];
$email = $_SESSION['login']['email'];
$message = $_POST['message'];
$message = addslashes($message);

echo $message;die;

$select = mysqli_query($connect, "SELECT * FROM `apply_job` WHERE `id_job` = $id_job and `id_candidate` = $id_candidate ") or exit(mysqli_error($connect));
if(mysqli_num_rows($select)) {
    $_SESSION['apply_job'] = 2;
    header("location:detail.blade.php?id=".$id_job);
    exit();
}


$cv = '';
if (isset($_FILES["cv"]["name"])){
    $target_dir = "cv/";
    $cv = $target_dir . time() . basename($_FILES["cv"]["name"]);
    move_uploaded_file(basename($_FILES["cv"]["tmp_name"]), $cv);
}

$sql_apply_job = "INSERT INTO `apply_job`(`id`, `id_job`, `id_candidate`, `full_name`, `email`, `message`, `cv`, `create_day`, `update_day`)
VALUES ('','$id_job','$id_candidate','$full_name','$email','$message','$cv','$postday','$updateday')";

echo $sql_apply_job;die;

if ($connect->query($sql_apply_job) === true) {
    $_SESSION['apply_job'] = 1;
    header("location:detail.blade.php?id=" . $id_job);
} else {
    $_SESSION['apply_job'] = 0;
    header("location:detail.blade.php?id=" . $id_job);
}

?>
