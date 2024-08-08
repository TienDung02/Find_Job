<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php require_once('function.php') ?>
<?php
    $postday = date('Y-m-d');
    $updateday = date('Y-m-d');


    $tags_input = '';
    if (isset($_POST['tags_input'])){
        $tags_input = $_POST['tags_input'];

    }
    $id_employer = $_POST['id_employer'];
    $location = $_POST['location'];
    $title = $_POST['job_title'];
    $type = $_POST['job_type'];
    $categories = $_POST['category'];
    $desc = $_POST['description'];
    $job_requirements = $_POST['job_requirements'];

    $minimum_rate = $_POST['minimum_rate'];
    $maximum_rate = $_POST['maximum_rate'];
    $minimum_salary = $_POST['minimum_salary'];
    $maximum_salary = $_POST['maximum_salary'];

    $closing_day = $_POST['closing_day'];
    $closing_month = $_POST['closing_month'];
    $closing_year = $_POST['closing_year'];
    $closing_date = $closing_day . '-' . $closing_month . '-' . $closing_year;

    $job_categories = '';
    $job_tags = '';

    foreach ($categories as $category){
        $job_categories = $job_categories . $category . ', ';
    }

    foreach ($tags_input as $tag){
        $tag = trim($tag, ' ');
        $job_tags = $job_tags . $tag . ',' ;
        $sql_select_tag = mysqli_query($connect, "select * from tags where name = '$tag' ") or exit(mysqli_error($connect));
        if(mysqli_num_rows($sql_select_tag)) {
            $sql_update_tag = "update tags set popular = (popular + 1) where  name = '$tag' ";
            $connect->query($sql_update_tag);
        }else{
            $sql_insert_tag = "insert into tags (tag_id, name, popular, create_day, update_day) values ('', '$tag', 1, $postday, $updateday)";
            $connect->query($sql_insert_tag);
        }
    }

    $sql_insert_job = "INSERT INTO job (`id`, `id_employer`, `title`, `category`, `job_type`, `location`, `job_tag`, `description`, `job_requirements` ,`minimum_rate`, `maximum_rate`, `minimum_salary`, `maximum_salary`, `closing_day`, `active`, `create_day`, `update_day`)
                        VALUES ('', '$id_employer', '$title', '$job_categories', '$type', '$location', '$job_tags', '$desc', '$job_requirements','$minimum_rate', '$maximum_rate', '$minimum_salary', '$maximum_salary', '$closing_date', 0, '$postday', '$updateday')";
//    echo $sql_insert_job;die;
    if ($connect->query($sql_insert_job) === TRUE) {
        $_SESSION['insert_job'] = 1;
        header("location:add.blade.php");
    } else {
        $_SESSION['insert_job'] = 0;
        echo "Lỗi: " . $sql_insert_job . "<br>" . $conn->error;
        header("location:add.blade.php");
    }

?>
