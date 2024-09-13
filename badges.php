<?php
include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <nav class="bg-success p-3 fs-3 text-white"><i class="fa-solid fa-medal fa-lg me-3"
            style="color: #ffffff;"></i><b>Badge Gallery</b></nav>
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col text-center">
                <h2 class="d-block mx-auto" style="color:purple;"><i class="fa-solid fa-star"></i> Score Related Badges</h2><br>
            </div>
        </div>
        <div class="row">

            <?php
            $eml=$_SESSION['em'];
            $sel = "select DISTINCT badge_title,Badge_type,Description,Reference,badge_status from badge_winner where Badge_Type='Score Related' AND email='$eml'";
            $data3 = mysqli_query($conn, $sel);
            while ($rec3 = mysqli_fetch_array($data3))
                {
                    
                ?>
                <div class="col-md-3 mb-4">
                    <div class="card" style="height:400px;">
                        <img class="card-img-top" src=<?php echo "./images/screenshots/".$rec3[3];?> width="150px" height="150px" alt="Title" />
                        <div class="card-body text-bg-secondary">
                            <h4 class="card-title"><?php echo $rec3[0];?></h4>
                            <p class="card-text"><?php echo $rec3[2];?></p>
                            <hr>
                            <b style="font-size:20px;">Status: </b><span style="font-size:20px;"><?php echo $rec3[4];?>&nbsp;&nbsp;</span>
                            <?php
                            if($rec3[4]=='Pending')
                            {
                            ?>
                            <i style="font-size:20px;" class="fa-solid fa-spinner"></i>
                            <?php
                            }
                            else
                            {
                            ?>
                            <i style="font-size:20px;color:yellowgreen;" class="fa-solid fa-check bg-white p-1 rounded-circle"></i>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <br><br>
        <div class="row">
            <div class="col text-center">
                <h2 class="d-block mx-auto" style="color:purple;"><i class="fa-solid fa-bars-progress"></i> Challenge Related Badges</h2><br>
            </div>
        </div>
        <div class="row">

            <?php
            $sel = "select DISTINCT badge_title,Badge_type,Description,Reference,badge_status from badge_winner where Badge_Type='Challenge Related' AND email='$eml'";
            $data4 = mysqli_query($conn, $sel);
            while ($rec4 = mysqli_fetch_array($data4))
                {
                    
                ?>
                <div class="col-md-3 mb-4">
                    <div class="card" style="height:400px;">
                        <img class="card-img-top" src=<?php echo "./images/screenshots/".$rec4[3];?> width="150px" height="150px" alt="Title" />
                        <div class="card-body text-bg-primary">
                            <h4 class="card-title"><?php echo $rec4[0];?></h4>
                            <p class="card-text"><?php echo $rec4[2];?></p>
                            <hr>
                            <b style="font-size:20px;">Status: </b><span style="font-size:20px;"><?php echo $rec4[4];?>&nbsp;&nbsp;</span>
                            <?php
                            if($rec4[4]=='Pending')
                            {
                            ?>
                            <i style="font-size:20px;" class="fa-solid fa-spinner"></i>
                            <?php
                            }
                            else
                            {
                            ?>
                            <i style="font-size:20px;color:yellowgreen;" class="fa-solid fa-check bg-white p-1 rounded-circle"></i>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
</body>

</html>