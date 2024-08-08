<?php session_start() ?>
<?php require_once('connection.php') ?>
<?php require_once('function.php') ?>
<?php


$id_employer = $_POST['id_employer'];
$company_name = $_POST['company_name'];
$company_tagline = $_POST['company_tagline'];
$headquarter = $_POST['headquarter'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];


$target_dir_company_logo = "img_temp/";
$target_file_company_logo = $target_dir_company_logo  . basename($_FILES["company_logo"]["name"]);
move_uploaded_file($_FILES["company_logo"]["tmp_name"], $target_file_company_logo);

$link_video = $_POST['link_video'];

$since_day = $_POST['since_day'];
$since_month = $_POST['since_month'];
$since_year = $_POST['since_year'];
$since = $since_day . '-' . $since_month . '-' . $since_year;

$company_website = $_POST['company_website'];
$company_email = $_POST['company_phone'];
$company_phone = $_POST['company_phone'];
$company_twitter = $_POST['company_twitter'];
$company_facebook = $_POST['company_facebook'];

$industry = $_POST['industry'];
if ($industry == '-'){
    $industry = '';
}
$company_size = $_POST['company_size'];
if ($company_size == '-'){
    $company_size = '';
}
$average_salary = $_POST['average_salary'];
if ($average_salary == '-'){
    $average_salary = '';
}
$desc = $_POST['desc'];
$header_img = '';
if (isset($_FILES["header_img"]["name"])) {
    $company_logo = $_FILES['header_img']["name"];
}

$target_dir_header_img = "img_temp/";
$target_file_header_img = $target_dir_header_img . time() . basename($_FILES["header_img"]["name"]);
move_uploaded_file($_FILES["header_img"]["tmp_name"], $target_file_header_img);

$active = 0;
$create_day = date('Y-m-d');
$update_day = date('Y-m-d');

$sql_insert_company = "INSERT INTO `company` (`id_company`, `id_employer`, `company_name`, `company_tagline`, `headquarters`, `latitude`,
                       `longitude`, `company_logo`, `video`, `since`, `company_website`, `email`, `phone`, `twitter`, `facebook`, `industry`,
                       `company_size`, `company_average_salary`, `description`, `header_img`, `active`, `create_day`, `update_day`)
VALUES ('', $id_employer, '$company_name', '$company_tagline', '$headquarter', '$latitude', '$longitude', '$target_file_company_logo',
        '$link_video', '$since', '$company_website', '$company_email', '$company_phone', '$company_twitter', '$company_facebook',
        '$industry','$company_size','$average_salary','$desc','$target_file_header_img', $active, '$create_day', '$update_day')";

if ($connect->query($sql_insert_company) === TRUE) {
    $_SESSION['insert_company_status'] = 1;
    header("location:add.blade.php");
} else {
    $_SESSION['insert_company_status'] = 0;
    header("location:add.blade.php");
//    echo "Lỗi: " . $sql_insert_company . "<br>" . $conn->error;
}
?>
