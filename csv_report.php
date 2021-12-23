<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './db_connection.php';

if ($db_connection->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$count = "SELECT COUNT(order_id) AS total_data FROM orders";
$count_result = $db_connection->query($count);
$total_data = $count_result->fetch_assoc()['total_data'];
$each_file = 20000;
$downloadPart = ceil(($total_data / $each_file));

ini_set('max_execution_time', 600);

for ($i = 0; $i < $downloadPart; $i++) {
    $offset = $each_file * $i;
    $sql = "SELECT * FROM orders LIMIT $each_file OFFSET $offset";
    $result = $db_connection->query($sql);
    
    $headers = array('ID', 'Customer Name', 'Customer Address', 'Amount', 'Time', 'Date');

    $fh = fopen($i . '.csv', 'w');
    fputcsv($fh, $headers);

    foreach ($result as $data) {
        fputcsv($fh, $data);
    }

    fclose($fh);
}

function joinFiles(array $files, $result) {
    if (!is_array($files)) {
        throw new Exception('`$files` must be an array');
    }

    $wH = fopen($result, "w+");

    foreach ($files as $file) {
        $fh = fopen($file, "r");
        while (!feof($fh)) {
            fwrite($wH, fgets($fh));
        }
        fclose($fh);
        unset($fh);
        fwrite($wH, "\n"); //usually last line doesn't have a newline
    }
    fclose($wH);
    unset($wH);
}

for ($i = 0; $i < $downloadPart; $i++) {
    $xfiles[] = $i . '.csv';
}

joinFiles($xfiles, 'Total_Report_' . date('d-m-Y') . time() . '.csv');

for ($i = 0; $i < $downloadPart; $i++) {
    unlink($i . '.csv');
}
echo '<h1 style="color: lime; text-align: center; margin-top:50px;">Successfully Done</h1>';
exit();
