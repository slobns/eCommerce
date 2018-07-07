<?php

$db = mysqli_connect('', '', '', ''); // insert your data here
if(mysqli_connect_errno()) {
    echo 'Konekcija sa bazom nije uspela. Greska je : '.mysqli_connect_error();
    die;
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerc/config.php';
require_once BASEURL.'helpers/helpers.php';

if(isset($_SESSION['SBUser'])){
    $user_id = $_SESSION['SBUser'];
    $query = $db->query("SELECT * FROM users WHERE id='$user_id'");
    $user_data = mysqli_fetch_assoc($query);
    $fn = explode(' ',$user_data['full_name']);
    $user_data['first'] = $fn[0];
    $user_data['last'] = $fn[1];
}
if(isset($_SESSION['success_flash'])){
    echo '<div class="bg-success"><p class="text-center text-success">'.$_SESSION['success_flash'].'</p></div>';
    unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
    echo '<div class="bg-danger"><p class="text-center text-danger">'.$_SESSION['error_flash'].'</p></div>';
    unset($_SESSION['error_flash']);
}
