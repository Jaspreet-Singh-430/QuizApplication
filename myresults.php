<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container-fluid {
            padding:0px;
        }
        b {
            font-size:40px;
        }
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

    </style>
</head>
<body>
    <?php
    include("connection.php");
    session_start();
    ?>
  <div class="container-fluid">
    <nav class="p-3 fs-3 text-white" style="background:purple;"><img src="./images/result.jpeg" width=10% height=10% alt="" class="rounded-circle img-fluid">
    <img src="./images/test.webp" width=10% height=10% alt="" class="rounded-circle img-fluid mx-2"><b>&nbsp;&nbsp;My Results</b></nav>
    <br>
    <table class="table table-dark table-bordered my-2 border-light">
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
            $usermail = $_SESSION['em'];
            $sel = "select * from  results where Candidate_email='$usermail'";
            $data = mysqli_query($conn, $sel);
            while ($row = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    
                    <td class="p-1"><?php echo $row[2]; ?></td>
                    <td class="p-1"><?php echo $row[3]; ?></td>
                    <td class="p-1"><?php if ($row[4] == 1)
                        echo "Time Duration";
                    else if ($row[4] == 2)
                        echo "Time Slice";
                    else
                        echo "Survival Skill"; ?></td>
                    <td class="p-1"><?php echo $row[5]; ?></td>
                    <td class="p-1"><?php echo $row[7]; ?></td>
                    <td class="p-1"><?php echo $row[8]; ?></td>
                    <td class="p-1"><?php echo $row[6]; ?></td>
                    <td class="p-1"><?php echo $row[9]; ?></td>
                    <td class="p-1"><?php echo $row[10]; ?></td>
                    <td class="p-1" <?php
                    if ($row[11] == 'D') {
                        ?> style="background:red;" <?php
                    } else {
                        ?>
                    style="background:green;" <?php
                    }
                    ?>>
                        <?php echo $row[11]; ?>
                    </td>
                    <td class="p-1"><?php echo $row[12]; ?></td>
                    
                </tr>
            <?php
            }
            ?>
        </table>
  </div>  
</body>
</html>