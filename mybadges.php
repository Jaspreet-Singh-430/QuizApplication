<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="p-3 fs-3" style="background:yellow;"><i class="fa-solid fa-trophy fa-lg me-3"
            style="color: #000;"></i><b>My Achievements</b>
        <i class="fa-solid fa-award fa-lg me-3" style="color: #000;"></i>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <img src="./images/winquiz.png" width=100% height=100%alt="">
            </div>
            <div class="col-md-7 text-center">
             <?php
             include("connection.php");
             session_start();
             $eml = $_SESSION['em'];
             $sel = "select badge_title from badge_winner where email='$eml' AND badge_status='won'";
             $data = mysqli_query($conn, $sel);
             if(mysqli_num_rows($data) == 0)
                        {
                            echo "<h4>You have not won any badge yet</h4>";
                            exit(1);
                        }
             ?>   
                <h2 class="mb-4">My badges</h2>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Ser No</th>
                            <th>Badge_Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row[0]; ?></td>
                                <td><i class="fa-solid fa-check" style="color:green;"></i></td>
                            </tr>
                            <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>