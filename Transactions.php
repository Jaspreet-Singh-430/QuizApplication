<?php
include("connection.php");
$upd = "select * from payers inner join transactions on orderid=order_id";
$result = mysqli_query($conn, $upd);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <img src="./images/transaction3.jpg" width='100%' height=300px alt=""><br><br>
        <h2 class="text-center mb-4">Transaction Record</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Payer Name</th>
                        <th scope="col">Payer Email</th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Contest Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Reference Id</th>
                        <th scope="col">Transaction Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while( $row = mysqli_fetch_array($result) )
                    {
                    ?>
                    <tr>
                        <td><?php echo $row[0];?></td>
                        <td><?php echo $row[1];?></td>
                        <td><?php echo $row[2];?></td>
                        <td><?php echo $row[3];?></td>
                        <td><?php echo $row[5];?></td>
                        <td><?php echo $row[6];?></td>
                        <td><?php echo $row[7];?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

