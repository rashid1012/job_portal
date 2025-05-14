<?php
require_once 'session/session.php';
require_once 'define/define.php';
require_once 'classes/Job.php';

$jobObj = new Job();

$id = $_GET['id'];
// print_r($id); die;

$query = $jobObj->jobDelete($id);
if ($query) {
    $_SESSION['status'] = "Job Deleted Successfully.";
    header("location: " . ADMIN_URL . "jobList.php");
} else {
    echo "<p class='text-center bg-danger text-white p-2'>Smething wen't wrong!</p>";
}