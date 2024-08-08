<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php require_once('function.php') ?>
<?php
$postday = date('Y-m-d');
$updateday = date('Y-m-d');

//print_r($_POST);die;


$id = $_GET['id'];

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

//echo $job_requirements;die;

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
    $tag = str_replace(' ', '', $tag);
    $tag = str_replace(',', '', $tag);
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

//echo $job_tags;die;

$sql_update_job = "UPDATE `job` SET `title`='$title',`category`='$job_categories',`job_type`='$type',`location`='$location',`job_tag`='$job_tags',
                 `description`='$desc', `job_requirements`='$job_requirements',`minimum_rate`='$minimum_rate',`maximum_rate`='$maximum_rate',`minimum_salary`='$minimum_salary',
                 `maximum_salary`='$maximum_salary',`closing_day`='$closing_date',`update_day`='$updateday' WHERE `id` = $id";
//    echo $sql_update_job;die;
if ($connect->query($sql_update_job) === TRUE) {
    $_SESSION['update_job'] = 1;
    header("location:manage.blade.php");
} else {
    $_SESSION['update_job'] = 0;
    echo "Lỗi: " . $sql_update_job . "<br>" . $conn->error;
    header("location:manage.blade.php");
}

?>
