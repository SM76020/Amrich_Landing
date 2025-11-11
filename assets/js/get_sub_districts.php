<?php
require_once("../config/db.php");

if (isset($_GET['district_id'])) {
    $district_id = $_GET['district_id'];

    // Using DISTINCT to prevent duplicates
    $stmt = $pdo->prepare("SELECT DISTINCT name, MIN(id) as id FROM sub_districts WHERE district_id = ? GROUP BY name ORDER BY name");
    $stmt->execute([$district_id]);
    $sub_districts = $stmt->fetchAll();

    echo "<option value=''>Select Sub-district</option>";
    foreach ($sub_districts as $sd) {
        echo "<option value='" . htmlspecialchars($sd['id']) . "'>" . htmlspecialchars($sd['name']) . "</option>";
    }
}
?>
