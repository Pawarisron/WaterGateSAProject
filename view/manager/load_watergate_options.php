<?php
require_once '../../db.php';

if (isset($_GET['watergate_ID'])) {
    $watergate_ID = $_GET['watergate_ID'];

    $sql = "SELECT r.*, w.* FROM route as r JOIN watergate as w ON w.watergate_ID = r.to_ID_gate WHERE from_ID_gate = :watergate_ID;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
    $stmt->execute();

    $options = array();

    while ($row = $stmt->fetch()) {
        $option = array(
            "gate_name" => $row['gate_name'],
            "value" => $row['to_ID_gate']
        );

        $options[] = $option;
    }

    $json = json_encode($options, JSON_UNESCAPED_UNICODE);
    echo $json;
}
?>
