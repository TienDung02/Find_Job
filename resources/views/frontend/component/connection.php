<?php
global $connect;
$connect;
$connect = new mysqli('localhost', 'root', '', 'worksout');
if ($connect->errno !== 0) {
    die("Error: Could not connect to the database. An error " . $connect->error . " ocurred.");
}
$connect->set_charset('utf8');
define("FULL_URL", 'http://localhost/vieclam/git/job-board/HTML');
?>