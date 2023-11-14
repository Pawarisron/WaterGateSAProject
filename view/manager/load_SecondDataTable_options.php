<?php
require_once '../../db.php';

if (isset($_GET['watergate_ID'])) {
    $watergate_ID = $_GET['watergate_ID'];
    $additionalVariable = $_GET['additional_variable'];
    

    $sql = "SELECT w.*, r.*
    FROM watergate w
    INNER JOIN (
        SELECT watergate_ID, MAX(report_time) AS max_report_time
        FROM daily_report
        GROUP BY watergate_ID
    ) latest_reports
    ON w.watergate_ID = latest_reports.watergate_ID
    JOIN daily_report r
    ON latest_reports.watergate_ID = r.watergate_ID AND latest_reports.max_report_time = r.report_time
    WHERE w.watergate_ID IN (
        SELECT to_ID_gate
        FROM route
        WHERE from_ID_gate = :watergate_ID
    );";

    $sql2 = "SELECT w.*, r.*
    FROM watergate w
    INNER JOIN (
        SELECT watergate_ID, MAX(report_time) AS max_report_time
        FROM daily_report
        GROUP BY watergate_ID
    ) latest_reports
    ON w.watergate_ID = latest_reports.watergate_ID
    JOIN daily_report r
    ON latest_reports.watergate_ID = r.watergate_ID AND latest_reports.max_report_time = r.report_time
    WHERE w.watergate_ID = :additionalVariable;";



    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
    $stmt->execute();
    $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':additionalVariable', $additionalVariable, PDO::PARAM_STR);
    $stmt2->execute();
    $data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    
    $combinedData = array_merge($data2, $data1);
    $options = array();
    

    // while ($row = $stmt->fetch()) {
    //     $option = array(
    //         "watergate_ID" => $row['watergate_ID'],
    //         "gate_name" => $row['gate_name'],
    //         "criterion" => $row['criterion'],
    //         "upstream" => $row['upstream']
    //     );

    //     $options[] = $option;
    // }
    foreach ($combinedData as $row) {
        $option = array(
            "watergate_ID" => $row['watergate_ID'],
            "gate_name" => $row['gate_name'],
            "criterion" => $row['criterion'],
            "upstream" => $row['upstream']
        );

        $options[] = $option;
    }

    
    error_log($additionalVariable . " something");
    
    $json = json_encode($options, JSON_UNESCAPED_UNICODE);
    echo $json;
}


    
?>
