<!DOCTYPE html>
<html>

<head>
	<title>Cashfree - PG Response Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<h1 align="center">PG Response</h1>

	<?php
	session_start();
	$secretkey = "cfsk_ma_test_7e0683e90fa243dd6b9e2b4834e54f7e_1770b4be";
	$orderId = $_POST["orderId"];
	$orderAmount = $_POST["orderAmount"];
	$referenceId = $_POST["referenceId"];
	$txStatus = $_POST["txStatus"];
	$paymentMode = $_POST["paymentMode"];
	$txMsg = $_POST["txMsg"];
	$txTime = $_POST["txTime"];
	$signature = $_POST["signature"];
	$data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
	$hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
	$computedSignature = base64_encode($hash_hmac);
	$_SESSION['orderId']=$orderId;
	if ($signature == $computedSignature) {
		?>
		<div class="container">
			<div class="panel panel-success">
				<div class="panel-heading">Signature Verification Successful</div>
				<div class="panel-body">
					<!-- <div class="container"> -->
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>Order ID</td>
								<td><?php echo $orderId; ?></td>
							</tr>
							<tr>
								<td>Order Amount</td>
								<td><?php echo $orderAmount; ?></td>
							</tr>
							<tr>
								<td>Reference ID</td>
								<td><?php echo $referenceId; ?></td>
							</tr>
							<tr>
								<td>Transaction Status</td>
								<td><?php echo $txStatus; ?></td>
							</tr>
							<tr>
								<td>Payment Mode </td>
								<td><?php echo $paymentMode; ?></td>
							</tr>
							<tr>
								<td>Message</td>
								<td><?php echo $txMsg; ?></td>
							</tr>
							<tr>
								<td>Transaction Time</td>
								<td><?php echo $txTime; ?></td>
							</tr>
						</tbody>
					</table>
					<!-- </div> -->

				</div>
			</div>
		</div>
		<?php
	} else {

		?>
		<div class="container">
			<div class="panel panel-danger">
				<div class="panel-heading">Signature Verification failed</div>
				<div class="panel-body">
					<!-- <div class="container"> -->
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>Order ID</td>
								<td><?php echo $orderId; ?></td>
							</tr>
							<tr>
								<td>Order Amount</td>
								<td><?php echo $orderAmount; ?></td>
							</tr>
							<tr>
								<td>Reference ID</td>
								<td><?php echo $referenceId; ?></td>
							</tr>
							<tr>
								<td>Transaction Status</td>
								<td><?php echo $txStatus; ?></td>
							</tr>
							<tr>
								<td>Payment Mode </td>
								<td><?php echo $paymentMode; ?></td>
							</tr>
							<tr>
								<td>Message</td>
								<td><?php echo $txMsg; ?></td>
							</tr>
							<tr>
								<td>Transaction Time</td>
								<td><?php echo $txTime; ?></td>
							</tr>
						</tbody>
					</table>
					<!-- </div> -->
				</div>
			</div>
		</div>

		<?php
	}
	?>
    <?php
	include("../connection.php");
	echo "<script>
	console.log(localStorage.getItem('fullname'))
	console.log(localStorage.getItem('usermail'))
	</script>";
	$ins="insert into transactions values('$orderId','$orderAmount','$referenceId','$txTime')";
	mysqli_query($conn, $ins);
	$upd = "update event set Status='Registered' where order_id='$orderId'";
$result = mysqli_query($conn, $upd);
	?>
	<a href="../usersideEvents.php?statCode=1">Back to Home</a>
</body>

</html>