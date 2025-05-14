<?php
require_once 'session/session.php';
require_once 'define/define.php';
require_once 'classes/Companies.php';

$companiesObj = new Companies();

$id = $_GET['id'];
// print_r($id); die;

$query = $companiesObj->companiesDelete($id);
if ($query) {
    $_SESSION['status'] = "Companies Deleted Successfully.";
    header("location: " . ADMIN_URL . "companiesList.php");
} else {
    echo "<p class='text-center bg-danger text-white p-2'>Smething wen't wrong!</p>";
}