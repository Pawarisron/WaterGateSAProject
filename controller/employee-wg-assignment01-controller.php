<?php
    
    session_start();
    require_once '../db.php';

    
    if(isset($_POST['submitAssignment'])){

        $open_time = $_POST['openTimestamp'];
        $close_time = $_POST['closeTimestamp'];
        $command_ID = $_POST['command_ID'];

        $watergate_ID = $_POST['watergate_ID'];

        try{
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

                $message = "UPDATE commands_log
                            SET open_time = :open_time, close_time = :close_time
                            WHERE command_ID = :command_ID; AND watergate_ID = :watergate_ID;";

            $data = $conn->prepare($message);
            $data->bindParam(':command_ID', $command_ID);
            $data->bindParam(':watergate_ID', $watergate_ID);
            $data->bindParam(':close_time', $close_time);
            $data->bindParam(':open_time', $open_time);
            $data->execute();

            header("location: ../view/employee/employee-wg-assignment01.php?command_ID=$command_ID&watergate_ID=$watergate_ID");
                
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>