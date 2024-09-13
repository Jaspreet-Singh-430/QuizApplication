<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        table {
            caption-side:top;
            text-align:center;
        }
        td {
            vertical-align: middle;
        }
        caption {
            text-align:center;
            font-weight:bold;
        }
        .inv {
            display:none;
        }
        input {
            height:55px;
        }
    </style>
</head>

<body>
    <form action="delete.php" method="post" id="updation"></form>
    <div class="container">
    <table class="table table-hover table-striped table-bordered my-2 border-dark">
        <caption><p class="display-4">Registered Users</p></caption>
        <tr>
            <th class="text-bg-success">Firstname</th>
            <th class="text-bg-success">Lastname</th>
            <th class="text-bg-success">Email</th>
            <th class="text-bg-success">Password</th>
            <th class="text-bg-success">contact</th>
            <th class="text-bg-success">userId</th>
            <th class="text-bg-success">Edit users</th>
            <th class="text-bg-success">Delete Users</th>
            <th class="text-bg-success">Update</th>
        </tr>
        <?php
        $sel = "select * from participants";
        $data=mysqli_query($conn, $sel);
        while($row=mysqli_fetch_array($data)) {
        ?>
            <tr>
            <td class="p-0"><span><?php echo $row[0];?></span>
        <input type="text" class="inv" name='fname' form='updation' value="<?php echo $row[0];?>"></td>
            <td class="p-0"><span><?php echo $row[1];?></span><input type="text" form='updation' name='lname' class='inv' value="<?php echo $row[1];?>"></td>
            <td class="p-0"><span><?php echo $row[2];?></span><input type="text" form='updation' name='eml' class='inv' value="<?php echo $row[2];?>"></td>
            <td class="p-0"><span><?php echo $row[3];?></span><input type="text" form='updation' name='pwd' class='inv' value="<?php echo $row[3];?>"></td>
            <td class="p-0"><span><?php echo $row[4];?></span><input type="text" form='updation' name='cont' class='inv' value="<?php echo $row[4];?>"></td>
            <td class="p-0"><span><?php echo $row[5];?></span><input type="text" form='updation' name='id' class='inv' value="<?php echo $row[5];?>"></td>
            <td ><button class="btn btn-primary" onclick="show(this)">Edit</button></td>
            <td><button class="btn btn-danger" type="submit" form='updation'>Delete</button></td>
            <td><button class="btn btn-secondary" type="submit" form="updation" formaction="update.php">Update</button></td>
            <input type="text" hidden name="hidName" value="<?php echo $row[5];?>" form="updation">
            </tr>
        <?php    
        }
        ?>
    </table>
    </div>
    <script>
    function show(elem)
    {
        par=elem.parentNode.parentNode;
        for($i=0;$i<=5;$i++)
    {
        for($j=0;$j<=1;$j++)
        {
            console.log(par.children[$i].children[$j])
        par.children[$i].children[$j].classList.toggle('inv')
        }
    }
    }
    
    </script>
</body>

</html>