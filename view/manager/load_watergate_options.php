<?php
require_once '../../db.php';

if (isset($_GET['watergate_ID'])) {
    $watergate_ID = $_GET['watergate_ID'];

    $sql = "SELECT to_ID_gate FROM route WHERE from_ID_gate = :watergate_ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':watergate_ID', $watergate_ID, PDO::PARAM_STR);
    $stmt->execute();

    $options = array();

    while ($row = $stmt->fetch()) {
        $option = array(
            "value" => $row['to_ID_gate'],
            "text" => $row['to_ID_gate']
        );

        $options[] = $option;
    }

    echo json_encode($options);
}
?>
