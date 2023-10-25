<?php

    session_start();
    require_once '../db.php';

    if(isset($_POST['signin'])){
        
        $employee_ID = $_POST['employee_ID'];
        $password = $_POST['password'];
            try{
                $check_data = $conn->prepare("SELECT * FROM users WHERE employee_ID = :employee_ID");
                $check_data->bindParam(":employee_ID", $employee_ID);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);
                
                if($check_data->rowCount() > 0){
                    if($employee_ID == $row['employee_ID']){
                        if($password == $row['password']){
                            if ($row['role'] == 'Manager'){
                                $_SESSION['manager_login'] = $row['employee_ID'];
                                header("location: ../view/manager/manager-home.php");
                                
                            }
                            else if ($row['role'] == 'Employee'){
                                $_SESSION['employee_login'] = $row['employee_ID'];
                                header("location: ../view/employee/employee-home.php");

                            }
                            
                        } 
                        else {
                            // $_SESSION['error'] = 'รหัสผ่านผิด';
                            header('location: ../login.php');
                            
                        }
                    } else {
                        
                        // $_SESSION['error'] = 'อีเมล์ผิด';
                        header('location: ../login.php');
                    }
                }
                else{
                    // $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: ../login.php");
                }

            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    

?>