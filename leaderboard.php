<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    <style>
        .custom-select {
            position: relative;
            width: 200px;
        }
        table {
            text-align: center;
            vertical-align: middle;
        }

        /* Style the select dropdown */
        select {
            width: 100%;
            padding: 10px;
            border: 2px solid #007bff;
            border-radius: 4px;
            background-color: #f8f9fa;
            color: #333;
            font-size: 16px;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        /* Adding an arrow to indicate dropdown */
        .custom-select::after {
            content: "▼";
            position: absolute;
            top: 14px;
            right: 10px;
            pointer-events: none;
            color: #007bff;
            font-size: 14px;
        }

        /* Hover and focus effects */
        select:hover,
        select:focus {
            border-color: #0056b3;
            outline: none;
        }

        body {
            background: rgb(133, 133, 133);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-2" style="color:white;">Event Leaderboard</h1><br>
        <div class="custom-select my-5">Filter By Event Name
            <form action="leaderboard.php" id="form1" method="GET"></form>
            <select name="selCat" form="form1">
                <option value="" disabled selected>Select a category</option>
                <?php
                $select = "select DISTINCT Event from leaderboard";
                $resultCat = mysqli_query($conn, $select);
                while ($row = mysqli_fetch_array($resultCat)) {
                    ?>
                    <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                <?php
                }
                ?>
            </select>
            <button type="submit" name='filter' form="form1" class="btn btn-warning my-2">Filter</button>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <table class="table table-hover table-bordered ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Participant Name</th>
                            <th scope="col">Participant Email</th>
                            <th scope="col">Event</th>
                            <th scope="col">Score</th>
                            <th scope="col">Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Leaderboard Data -->
                        <?php
                        if((isset($_GET['filter'])))
                        {
                            $rank=1;
                            $cat=$_GET['selCat'];
                            $sel = "select * from leaderboard where Event='$cat' ORDER BY score DESC";
                        $data = mysqli_query($conn, $sel);
                        while ($rec = mysqli_fetch_array($data)) {
                            ?>
                            <tr>
                                <td scope="row"><?php echo $rec[0]; ?></td>
                                <td><?php echo $rec[1]; ?></td>
                                <td><?php echo $rec[2]; ?></td>
                                <td><?php echo $rec[3]; ?></td>
                                <td><?php if($rank==1)
                                echo $rank.'st'; 
                            else if($rank==2)
                            echo $rank.'nd';
                            else if($rank==3)
                            echo $rank.'rd';
                        else
                        echo $rank.'th';?>
                            </td>
                            <td>
                                <?php if($rank==1)
                                {?>
                                <img src="./images/screenshots/first.png" width='50px' height='50px' alt="">
                                <?php
                                }
                                 else if($rank==2)
                                {?>
                                <img src="./images/screenshots/second.png" alt="" width='50px' height='50px'>
                                <?php
                                }
                                 else if($rank==3)
                                {?>
                                <img src="./images/screenshots/third.png" alt="" width='50px' height='50px'>
                                <?php
                                }?>
                            </td>
                              </tr>
                            <?php
                            $rank=$rank+1;
                            }
                        }
                        else
                        {
                            $sel = "select * from leaderboard GROUP BY Event ORDER BY score DESC";
                            $data = mysqli_query($conn, $sel);
                            while ($rec = mysqli_fetch_array($data)) {
                                ?>  
                        
                        <tr>
                                <td scope="row"><?php echo $rec[0]; ?></td>
                                <td><?php echo $rec[1]; ?></td>
                                <td><?php echo $rec[2]; ?></td>
                                <td><?php echo $rec[3]; ?></td>
                            </tr> 
                            <?php
                        }
                    }
                        ?>
                        <!-- Add more rows dynamically -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>