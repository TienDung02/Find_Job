<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php require_once('function.php') ?>
<?php
$job_id = $_GET['job_id'];
$id_candidate = $_GET['id_candidate'];

$sql_bookmark_job = "DELETE FROM `bookmark` WHERE `id_candidate` = $id_candidate and `id_job` = $job_id";
//echo $sql_bookmark_job;die;


if ($connect->query($sql_bookmark_job) === true) {
    header("location:detail.blade.php?id=" . $job_id);
} else {
    header("location:detail.blade.php?id=" . $job_id);
}

?>
