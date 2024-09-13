<?php
include("connection.php");
$mail = $_COOKIE['usermail'];
$fname = $_COOKIE['fullname'];
$upd = "select * from payers inner join transactions on orderid=order_id where payer_name='$fname' AND payer_email='$mail' ";
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
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
</head>

<body>
<nav class="p-3 fs-3 text-white" style="background:purple;"><i class="fa-solid fa-indian-rupee-sign fa-lg me-3"
style="color: #ffffff;"></i><b>Transactions</b></nav>
    <div class="container mt-5">
        <img src="./images/transaction5.jpg" width='300px' height=300px alt="" class="d-block mx-auto"><br><br>
        <h2 class="text-center mb-4">Transaction History</h2>
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
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td><?php echo $row[5]; ?></td>
                            <td><?php echo $row[6]; ?></td>
                            <td><?php echo $row[7]; ?></td>
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