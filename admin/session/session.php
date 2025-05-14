<?php
session_start();
require_once 'define/define.php';
if(!isset($_SESSION['ID'])) {
    header("location: " .ADMIN_URL. "login.php");
}