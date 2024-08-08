<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php require_once('function.php') ?>
<?php
$type_user = 'employer';
if (isCandidate()) {
    $type_user = 'candidate';
}
$updateday = date('Y-m-d');

if (isset($_FILES["avatar"]["name"]) && $_FILES['avatar']['name'] != '') {
    $target_dir = "img_temp/";
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
}else{
    $target_file = $_POST['avatar_old'];
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$tel = $_POST['tel'];
$desc = $_POST['desc'];

$sql_update_profile = "update `$type_user` set avatar = '$target_file', first_name = '$first_name', last_name = '$last_name', tel = '$tel', about = '$desc', update_day = '$updateday'  where id_user = '" . $_SESSION['login']['id_user'] . "' ";

if ($connect->query($sql_update_profile) === TRUE) {
    $_SESSION['insert_job'] = 1;
    header("location:index.blade.php");
} else {
    $_SESSION['insert_job'] = 0;
    echo "Lỗi: " . $sql_update_profile . "<br>" . $conn->error;
    header("location:index.blade.php");
}



?>
