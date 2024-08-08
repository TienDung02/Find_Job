<?php require_once('connection.php') ?>

<?php

function custom_echo($x, $string_2)
{
    $y = substr($x, 0);
    $z = strrpos($y, $string_2);
    $t = substr($y, 0, $z);
    echo $t;
}

function callsql($sql)
{
        $data = [];
        $connect = $GLOBALS['connect'];
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
                while ($row__ = $result->fetch_assoc()) {
                        $data[] = $row__;
                }
        }
    return $data;
}

function custom_price_echo($numbers)
{
    $fmt = numfmt_create('de_DE', NumberFormatter::CURRENCY);
    echo numfmt_format_currency($fmt, $numbers, "VND") . "\n";
}

function time_ago($post_date)
{
    $date = new DateTime($post_date);
    $now = new DateTime();
    echo $date->diff($now)->format("%d days, %h hours ago");
}


function checkLogged()
{
    if (isset($_SESSION['login_success']) && $_SESSION['login_success'] != 0) {
        return 1;
    } else {
        return 0;
    }
}


function isCandidate()
{
    if (isset($_SESSION['login']['role']) && $_SESSION['login']['role']== 1) {
        $sql_select_id = "select id_candidate  from candidate where id_user = " . $_SESSION['login']['id_user'];
//        echo $sql_select_id;die;
        $id_candidate = callsql($sql_select_id);
        $id_candidate = $id_candidate[0];
        $_SESSION['login']['id_candidate'] = $id_candidate['id_candidate'];
        return 1;
    }
}

function isEmployer()
{
    if (isset($_SESSION['login']['role']) && $_SESSION['login']['role']== 2) {
//        $sql_select_id = "select id_candidate  from candidate where id_user = " . $_SESSION['login']['id_user'];
//        $id_candidate = callsql($sql_select_id);
//        $id_candidate = $id_candidate[0];
//        $_SESSION['login']['id_candidate'] = $id_candidate['id_candidate'];
        return 1;
    }
}

function isAdmin()
{
    if (isset($_SESSION['login']['role']) && $_SESSION['login']['role']== 3) {
        return 1;
    }
}


?>