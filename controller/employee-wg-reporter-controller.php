<?php

    session_start();
    require_once '../db.php';

    if(isset($_POST['submitReport'])){
        
        $employee_ID = $_POST['employee_ID'];
        $employee_name = $_POST['employee_name'];
        $password = $_POST['password'];
        $role = $_POST['role'];

            try{

                

                $message = "INSERT INTO users (employee_ID, employee_name, password, role) 
                VALUES (:employee_ID, :employee_name, :password, :role)";
                $check_data = $conn->prepare($message);

                $check_data->bindParam(':employee_ID', $employee_ID, PDO::PARAM_STR);
                $check_data->bindParam(':employee_name', $employee_name, PDO::PARAM_STR);
                $check_data->bindParam(':password', $password, PDO::PARAM_STR);
                $check_data->bindParam(':role', $role, PDO::PARAM_STR);

                $check_data->execute();
                header("location: ../view/employee/employee-home.php");

                

            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    

?>