<?php
require_once '../../db.php';

if (isset($_GET['watergate_ID'])) {
    $watergate_ID = $_GET['watergate_ID'];

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


    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
    $stmt->execute();

    $options = array();

    while ($row = $stmt->fetch()) {
        $option = array(
            "watergate_ID" => $row['watergate_ID'],
            "gate_name" => $row['gate_name'],
            "criterion" => $row['criterion'],
            "upstream" => $row['upstream']
        );

        $options[] = $option;
    }


    

    
    $json = json_encode($options, JSON_UNESCAPED_UNICODE);
    echo $json;
}


    
?>
