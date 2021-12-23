<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './db_connection.php';

if ($db_connection->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM orders LIMIT 10";
$result = $db_connection->query($sql);

/* For Row Insert */
//for ($i = 0; $i < 100000; $i++):
//    $insert = "INSERT INTO"
//            . " orders (customer_name, customer_address, order_amount, created_time, created_date)"
//            . "VALUES ('Mr Rahim', 'Magura, Bangladesh', '142.74', '04:04:04', '2022-12-25')";
//    $db_connection->query($insert);
//endfor;
//echo $i . ' Row Inserted';
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>CSV Bigly</title>
    </head>

    <body>
        <h1 class="text-center mt-5">CSV Bigly</h1>
        <div class="col-md-12">
            <table class="table table-bordered">
                <a href="csv_report.php" class="btn btn-dark mb-3">Download CSV</a>
                <thead>
                    <tr>
                        <th scope="col" class="text-right">ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Address</th>
                        <th scope="col" class="text-right">Amount</th>
                        <th scope="col" class="text-right">Time</th>
                        <th scope="col" class="text-right">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="text-right"><?php echo $row['order_id'] ?></td>
                            <td><?php echo $row['customer_name'] ?></td>
                            <td><?php echo $row['customer_address'] ?></td>
                            <td class="text-right"><?php echo $row['order_amount'] ?></td>
                            <td class="text-right"><?php echo $row['created_time'] ?></td>
                            <td class="text-right"><?php echo $row['created_date'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>