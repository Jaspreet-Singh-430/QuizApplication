<?php
include("connection.php");
$a=@$_GET['a'];
$b=@$_GET['b'];
if($b!='finished')
$err='*You can not delete these contests as there may be registered participants who may have made payments for registration';
else
{
    $del="delete from event where ser_no=$a";
    mysqli_query($conn, $del);
    $err='';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Manage Existing Events</h2>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Scheduled Date</th>
                    <th scope="col">No of Questions</th>
                    <th scope="col">Category</th>
                    <th scope="col">Time Limit</th>
                    <th scope="col">Status</th>
                    <th scope="col">Registration Fees</th>
                    <th scope="col">Due Date</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sel="select * from event";
                $data=mysqli_query($conn, $sel);
                while($row=mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $row[1];?></th>
                    <td><?php echo $row[2];?></td>
                    <td><?php echo $row[3];?></td>
                    <td><?php echo $row[4];?></td>
                    <td><?php echo $row[5];?></td>
                    <td><?php echo $row[6];?></td>
                    <td><?php echo "Rs. ".$row[7];?></td>
                    <td><?php echo $row[8];?></td>
                    <td><a class='btn btn-success' href="createEvents.php?a=<?php echo $row[0];?>&b=<?php echo $row[1];?>&c=<?php echo $row[2];?>&d=<?php echo $row[5];?>&e=<?php echo $row[7];?>&f=<?php echo $row[8];?>">Change</a></td>
                    <td><a class='btn btn-danger' href="manageEvents.php?a=<?php echo $row[0];?>&b=<?php echo $row[6];?>" id="del">Delete</a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="adminDashboard.php?a=admin&b=123" class="btn btn-primary mx-auto">Back to dashboard</a><br><br>
        <span class="text-danger"><?php echo $err;?></span>
    </div>

    <!-- Bootstrap JS and dependencies (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        if(document.getElementsByTagName('tbody')[0].children.length==0)
        document.getElementsByTagName('table')[0].innerHTML="No event created";
    </script>
</body>
</html>

