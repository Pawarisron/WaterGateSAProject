<?php
    session_start();
    unset($_SESSION['manager_login']);
    unset($_SESSION['employee_login']);
    header('location: login.php');
?>