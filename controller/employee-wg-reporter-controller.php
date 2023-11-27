<?php
session_start();
require_once '../db.php';

if (isset($_POST['submitReport'])) {
    $watergate_ID = $_POST['watergate_name'];
    $flow_rate = $_POST['flow_rate'];
    $upstream = $_POST['upstream'];
    $downstream = $_POST['downstream'];
    $report_time = $_POST['timestamp'];
    $employee_ID = $_SESSION['employee_login'];

    try {
        $check_existing_report_query = "SELECT * FROM daily_report WHERE watergate_ID = :watergate_ID AND report_time = :report_time";
        $check_existing_report_statement = $conn->prepare($check_existing_report_query);
        $check_existing_report_statement->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
        $check_existing_report_statement->bindParam(':report_time', $report_time, PDO::PARAM_STR);
        $check_existing_report_statement->execute();

        if ($check_existing_report_statement->rowCount() > 0) {
            echo '<script type="text/javascript">';
            echo 'alert("A report for the selected watergate and timestamp already exists.");';
            echo 'window.location.href = "../view/employee/employee-wg-reporter.php";';
            echo '</script>';
            exit; // Stop further execution
        } else {
            $message = "INSERT INTO daily_report(employee_ID, watergate_ID, upstream, downstream, flow_rate, report_time) 
                        VALUES (:employee_ID, :watergate_ID, :upstream, :downstream, :flow_rate, :report_time)";

            $check_data = $conn->prepare($message);

            $check_data->bindParam(':employee_ID', $employee_ID, PDO::PARAM_STR);
            $check_data->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
            $check_data->bindParam(':upstream', $upstream, PDO::PARAM_STR);
            $check_data->bindParam(':downstream', $downstream, PDO::PARAM_STR);
            $check_data->bindParam(':flow_rate', $flow_rate, PDO::PARAM_STR);
            $check_data->bindParam(':report_time', $report_time, PDO::PARAM_STR);

            $check_data->execute();
            
            // Add error handling
            if ($check_data->errorCode() != 0) {
                $errors = $check_data->errorInfo();
                throw new Exception("Database error: " . implode(", ", $errors));
            }

            $criterion_query = "SELECT criterion FROM watergate WHERE watergate_ID = :watergate_ID";
            $criterion_statement = $conn->prepare($criterion_query);
            $criterion_statement->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
            $criterion_statement->execute();

            $criterion_result = $criterion_statement->fetch(PDO::FETCH_ASSOC);

            $condition = "SELECT *
            FROM cmd_route
            JOIN commands_log ON cmd_route.cmd_ID = commands_log.cmd_ID AND cmd_route.cmd_order = commands_log.cmd_order
            WHERE cmd_route.from_ID_gate = :watergate_ID AND commands_log.cmd_status = 0;";

            $stmt = $conn->prepare($condition);
            $stmt->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
            $stmt->execute();            


            $condition = "SELECT COUNT(*) as count
            FROM cmd_route
            JOIN commands_log ON cmd_route.cmd_ID = commands_log.cmd_ID AND cmd_route.cmd_order = commands_log.cmd_order
            WHERE cmd_route.from_ID_gate = :watergate_ID AND commands_log.cmd_status = 0;";

            $stmt = $pdo->prepare($condition);
            $stmt->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result['count'] == 0) {
                $gate_status = ($upstream <= $criterion_result['criterion']) ? 0 : 1;
                $update_gate_status_query = "UPDATE watergate SET gate_status = :gate_status WHERE watergate_ID = :watergate_ID";
                $update_gate_status_statement = $conn->prepare($update_gate_status_query);
                $update_gate_status_statement->bindParam(':gate_status', $gate_status, PDO::PARAM_INT);
                $update_gate_status_statement->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
                $update_gate_status_statement->execute();
            }



            // Redirect after successful operations
            header('location: ../view/employee/employee-wg-reporter.php');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
