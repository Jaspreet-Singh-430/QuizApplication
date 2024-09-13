<?php
include("connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <style>
        table {
            caption-side: top;
            text-align: center;
        }

        td {
            vertical-align: middle;
        }

        caption {
            text-align: center;
            font-weight: bold;
        }

        .inv {
            display: none;
        }

        input {
            height: 55px;
        }
    </style>
</head>

<body>
    <form action="delete.php" method="post" id="updation"></form>
    <div class="container">
        <table class="table  table-dark table-bordered my-2 border-light">
            <caption>
                <p class="display-4">Result History</p>
            </caption>
            <tr>
                <th class="text-bg-warning">Category</th>
                <th class="text-bg-warning">Quiz Name</th>
                <th class="text-bg-warning">Quiz Type</th>
                <th class="text-bg-warning">Difficulty</th>
                <th class="text-bg-warning">Correct Answers</th>
                <th class="text-bg-warning">Wrong Answers</th>
                <th class="text-bg-warning">Marks</th>
                <th class="text-bg-warning">Total Marks</th>
                <th class="text-bg-warning">Percentage</th>
                <th class="text-bg-warning">Grade</th>
                <th class="text-bg-warning">Date and Time</th>
            </tr>
            <?php
            $user = $_SESSION['user'];
            $sel = "select * from results where Candidate_name='$user'";
            $data = mysqli_query($conn, $sel);
            while ($row = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td class="p-1"><?php echo $row[1]; ?></td>
                    <td class="p-1"><?php echo $row[2]; ?></td>
                    <td class="p-1"><?php if ($row[3] == 1)
                        echo "Time Duration";
                    else if ($row[3] == 2)
                        echo "Time Slice";
                    else
                        echo "Survival Skill"; ?></td>
                    <td class="p-1"><?php echo $row[4]; ?></td>
                    <td class="p-1"><?php echo $row[5]; ?></td>
                    <td class="p-1"><?php echo $row[6]; ?></td>
                    <td class="p-1"><?php echo $row[7]; ?></td>
                    <td class="p-1"><?php echo $row[8]; ?></td>
                    <td class="p-1"><?php echo $row[9]; ?></td>
                    <td class="p-1" <?php
                    if ($row[10] == 'D') {
                        ?> style="background:red;" <?php
                    } else {
                        ?>
                    style="background:green;" <?php
                    }
                    ?>>
                        <?php echo $row[10]; ?>
                    </td>
                    <td class="p-1"><?php echo $row[11]; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <script>
        function show(elem) {
            par = elem.parentNode.parentNode;
            for ($i = 0; $i <= 5; $i++) {
                for ($j = 0; $j <= 1; $j++) {
                    console.log(par.children[$i].children[$j])
                    par.children[$i].children[$j].classList.toggle('inv')
                }
            }
        }
    </script>
</body>

</html>