<?php
require_once '../../db.php';

if (isset($_GET['watergate_ID'])) {
    $watergate_ID = $_GET['watergate_ID'];

    $sql = "SELECT w.watergate_ID, wn.gate_name, w.criterion, dr.upstream, drt.report_date
    FROM (
      SELECT watergate_ID, MAX(drt.report_date) AS max_report_date
      FROM watergate_name wn
      INNER JOIN watergate w ON wn.watergate_name_ID = w.watergate_ID
      JOIN daily_report dr ON dr.watergate_report_ID = w.watergate_ID
      JOIN daily_report_time drt ON drt.report_time_ID = dr.report_ID
      GROUP BY w.watergate_ID
    ) latest_reports
    INNER JOIN watergate w ON latest_reports.watergate_ID = w.watergate_ID
    INNER JOIN watergate_name wn ON w.watergate_ID = wn.watergate_name_ID
    INNER JOIN daily_report dr ON dr.watergate_report_ID = w.watergate_ID
    INNER JOIN daily_report_time drt ON drt.report_time_ID = dr.report_ID
    WHERE drt.report_date = latest_reports.max_report_date
    AND w.watergate_ID = :watergate_ID";


    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
    $stmt->execute();

    
    
    if($row = $stmt->fetch()){
        $option = array(
            "watergate_ID" => $row['watergate_ID'],
            "gate_name" => $row['gate_name'],
            "criterion" => $row['criterion'],
            "upstream" => $row['upstream']
        );
    }

    

    
    $json = json_encode($option, JSON_UNESCAPED_UNICODE);
    echo $json;
}


    
?>
