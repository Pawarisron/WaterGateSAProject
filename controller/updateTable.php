<?php

    //session_start();
    // require_once '../db.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function updateGateStatus($conn) {
        
        $sql = "
SELECT
    w.watergate_ID,
    w.criterion,
    w.gate_status,  -- Added a comma here
    dr.upstream,
    lt.latest_timestamp
FROM
    watergate AS w
LEFT JOIN (
    SELECT
        dr.watergate_report_ID,
        MAX(drt.report_date) AS latest_timestamp
    FROM
        daily_report AS dr
    INNER JOIN
        daily_report_time AS drt
    ON
        dr.report_ID = drt.report_time_ID
    GROUP BY
        dr.watergate_report_ID
) AS lt
ON
    w.watergate_ID = lt.watergate_report_ID
LEFT JOIN
    daily_report AS dr
ON
    lt.watergate_report_ID = dr.watergate_report_ID
    AND lt.latest_timestamp = (SELECT MAX(report_date) FROM daily_report_time WHERE report_time_ID = dr.report_ID);    
";

    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $watergate_ID = $row['watergate_ID'];
            $gate_status = $row['gate_status'];
            $criterion = $row['criterion'];
            $latest_upstream = $row['upstream'];
            
            $update_query = '';

            if ($latest_upstream !== null) {
                if ($latest_upstream >= $criterion && $gate_status == 0) {
                    $update_query = "UPDATE watergate SET gate_status = 1 WHERE watergate_ID = :watergate_ID";
                } elseif ($latest_upstream < $criterion && $gate_status == 1) {
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