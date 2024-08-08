<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php require_once('function.php') ?>
<?php
    $job_id[] = $_GET['job_id'];
    $id_candidate = $_GET['id_candidate'];
    $sql_select_apply_job = "select * from apply_job where id_candidate = $id_candidate ";
    $apply_jobs = callsql($sql_select_apply_job);
    foreach ($apply_jobs as $apply_job){
        if (in_array($apply_job['id_job'], $job_id)) {
            $_SESSION['apply_job'] = 2;
            header("location:detail.blade.php?id=" . $job_id[0]);
            exit();
        }
    }

    $sql_apply_job = "INSERT INTO `apply_job`(`id_apply`, `id_candidate`, `id_job`) VALUES ('','$id_candidate','$job_id[0]')";
    if ($connect->query($sql_apply_job) === true) {
        $_SESSION['apply_job'] = 1;
        header("location:detail.blade.php?id=" . $job_id[0]);
    } else {
        $_SESSION['apply_job'] = 0;
        header("location:detail.blade.php?id=" . $job_id[0]);
    }

?>
