<?php
    
    session_start();
    require_once '../db.php';

    
    if(isset($_POST['submitAssignment'])){

        $openning_time = $_POST['openTimestamp'];
        $closing_time = $_POST['closeTimestamp'];
        $command_ID = $_POST['command_ID'];

        try{
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            $message = "INSERT INTO closing_time_commands 
            (close_command_ID, closing_time) 
            VALUES (:close_command_ID, :closing_time)
            ON DUPLICATE KEY UPDATE closing_time = :closing_time";

            $data = $conn->prepare($message);
            $data->bindParam(':close_command_ID', $command_ID);
            $data->bindParam(':closing_time', $closing_time);
            $data->execute();

            try{
                $message2 = "INSERT INTO openning_time_commands 
                (open_command_ID, openning_time) 
                VALUES (:open_command_ID, :openning_time)
                ON DUPLICATE KEY UPDATE openning_time = :openning_time";

                $data2 = $conn->prepare($message2);
                $data2->bindParam(':open_command_ID', $command_ID);
                $data2->bindParam(':openning_time', $openning_time);
                $data2->execute();
                
                header("location: ../view/employee/employee-wg-assignment01.php?command_ID=$command_ID");
                

            }
            catch(PDOException $e){
                echo $e->getMessage();

            }

        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>