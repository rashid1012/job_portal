<?php
require_once 'session/session.php';
require_once 'define/define.php';
require_once 'classes/JobCategories.php';

$jobCategoriesObj = new JobCategories();

$id = $_GET['id'];
// print_r($id); die;

$query = $jobCategoriesObj->jobCategoriesDisplayDelete($id);
if ($query) {
    $_SESSION['status'] = "Job Categories Deleted Successfully.";
    header("location: " . ADMIN_URL . "jobCategoriesList.php");
} else {
    echo "<p class='text-center bg-danger text-white p-2'>Smething wen't wrong!</p>";
}