<?php

    //session_start();
    // require_once '../db.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function updateGateStatus($conn) {
        
        $sql = "
        SELECT w.*, r.*
        FROM watergate w
        INNER JOIN (
            SELECT watergate_ID, MAX(report_time) AS max_report_time
            FROM daily_report
            GROUP BY watergate_ID
        ) latest_reports
        ON w.watergate_ID = latest_reports.watergate_ID
        JOIN daily_report r
        ON latest_reports.watergate_ID = r.watergate_ID AND latest_reports.max_report_time = r.report_time;";

    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $watergate_ID = $row['watergate_ID'];
            $gate_status = $row['gate_status'];
            $criterion = $row['criterion'];
            $latest_upstream = $row['upstream'];
            
            $update_query = '';

            if ($latest_upstream !== null) {
                if ($latest_upstream > $criterion && $gate_status == 0) {
                    $update_query = "UPDATE watergate SET gate_status = 1 WHERE watergate_ID = :watergate_ID";
                } elseif ($latest_upstream <= $criterion && $gate_status == 1) {
                    $update_query = "UPDATE watergate SET gate_status = 0 WHERE watergate_ID = :watergate_ID";
                }
            }

            if (!empty($update_query)) {
                $stmt2 = $conn->prepare($update_query);
                $stmt2->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
                $stmt2->execute();
}
            
            
        }
        
       
    }
    


    
    
    

?>