<?php

include 'db.php';


header("Content-Type: text/csv");
header("Content-Disposition: attachment;filename=demo.csv");


$out = fopen("php://output", "w");


fputcsv($out, array("user_id", "title", "descr", "image", "created_at"));

$res = $conn->query("SELECT user_id, title, descr, image, created_at FROM photos");
while ($row = $res->fetch_assoc()) {
    fputcsv($out, $row);
}

?>
