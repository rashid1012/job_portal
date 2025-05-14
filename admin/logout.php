<?php
session_start();
require_once 'define/define.php';

if (!isset($_GET['do']) || $_GET['do'] !== 'logout') {
    // Deny access if not properly requested
    header("location: " . ADMIN_URL . "dashboard.php");
    exit;
}

unset($_SESSION['ID']);
unset($_SESSION['ROLE']);
unset($_SESSION['USERNAME']);
unset($_SESSION['NAME']);

header("location: " .ADMIN_URL. "login.php");
?>