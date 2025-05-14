<?php
require_once 'session/session.php';
require_once 'define/define.php';
require_once 'classes/Candidates.php';

$candidatesObj = new Candidates();

$id = $_GET['id'];
// print_r($id); die;

$query = $candidatesObj->candidatesDelete($id);
if ($query) {
    $_SESSION['status'] = "Candidates Deleted Successfully.";
    header("location: " . ADMIN_URL . "candidatesList.php");
} else {
    echo "<p class='text-center bg-danger text-white p-2'>Smething wen't wrong!</p>";
}