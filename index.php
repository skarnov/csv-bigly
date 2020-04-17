<?php
    $db_connection = new mysqli('server', 'obydullah', '123456', 'dev_nagad_agent_locator_v1');

    if ($db_connection->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $sql = "SELECT pk_data_id, shop_contact_number, shop_name, shop_type FROM survey_data LIMIT 5";
    $result = $db_connection->query($sql);
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
                        <th scope="col" class="text-right">Contact Number</th>
                        <th scope="col">Shop Name</th>
                        <th scope="col">Shop Type</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="text-right"><?php echo $row['pk_data_id'] ?></td>
                            <td class="text-right"><?php echo $row['shop_contact_number'] ?></td>
                            <td><?php echo $row['shop_name'] ?></td>
                            <td><?php echo $row['shop_type'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>