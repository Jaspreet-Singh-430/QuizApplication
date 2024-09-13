<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="./jquery/dist/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        table {
            caption-side: top;

        }

        caption {
            font-size: 25px;
        }

        td {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <?php $modes = ['Test mode' => 'fa-sharp fa-solid fa-graduation-cap', 'Time Attack' => 'fa-solid fa-clock', 'Survival Challenge' => 'fa-solid fa-heart'];
    $type = ['Time Duration', 'Time Slice', 'No. of lives'];
    $color = ['table-success', 'table-warning', 'table-danger'];
    $i = 0;
    ?>
    <div class="container-fluid px-0">
        <h1 class="mb-5 text-bg-secondary p-4 rounded-4">
            
            <?php switch($_GET['cat']) 
            {
                case 'music':
            ?>
            <img src="./images/music.webp" class="rounded-circle" style="width:100px;" alt="">
            <?php
            break;
            case 'sport_and_leisure':
            ?>
            <img src="./images/sport.png" class="rounded-circle" style="width:100px;" alt="">
            <?php
            break;
            case 'film_and_tv':
            ?>
            <img src="./images/film.png" class="rounded-circle" style="width:100px;" alt="">
           <?php
           break;
           case 'arts_and_literature' :
           ?>
           <img src="./images/literature.jpeg" class="rounded-circle" style="width:100px;" alt="">
           <?php
           break;
           case 'history':
           ?>
           <img src="./images/history.png" class="rounded-circle" style="width:100px;" alt="">
           <?php
           break;
           case 'society_and_culture':
           ?>
            <img src="./images/society.png" class="rounded-circle" style="width:100px;" alt="">
            <?php
            break;
            case 'science':
            ?>
            <img src="./images/micro.jpeg" class="rounded-circle" style="width:100px;" alt="">
            <?php
            break;
            case 'geography':
            ?>    
            <img src="./images/geography.jpeg" class="rounded-circle" style="width:100px;" alt="">
             <?php
             break;
             case 'food_and_drink'
             ?>   
            <img src="./images/food.jpeg" class="rounded-circle" style="width:100px;" alt="">
              <?php
              break;
              case 'general_knowledge':
              ?>  
            <img src="./images/science.png" class="rounded-circle" style="width:100px;" alt="">
             <?php
             break;
             case '':
             ?>   
            <img src="./images/misc.webp" class="rounded-circle" style="width:100px;" alt="">
           <?php
           break;
        }
        ?>
       &nbsp;<?php if($_GET['cat']=='')
       echo "Miscellaneous";
        else
       echo strtoupper($_GET['cat']); ?>
        </h1>
        <?php
        foreach ($modes as $x => $y) {
            ?>
            <div class="table-responsive px-4">

                <table class="table table-white">
                    <caption><i class="<?php echo $y; ?>"></i> <?php echo $x; ?></caption>
                    <thead class="<?php echo $color[$i]; ?>">
                        <tr>
                            <th scope="col">Quiz Name</th>
                            <th scope="col">No of Questions</th>
                            <th scope="col"><?php echo $type[$i]; ?></th>
                            <th scope="col">Play</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cat = $_GET['cat'];
                        $level = $_GET['level'];
                        $sel = "select * from quiz where category='$cat' AND difficulty='$level'";
                        $data = mysqli_query($conn, $sel);
                        while ($row = mysqli_fetch_array($data)) {
                            ?>
                            <tr class="">
                                <td scope="row"><?php echo $row[0]; ?></td>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[$i + 4]; ?></td>
                                <td><a href="instruction.php?cat=<?php echo @$_GET['cat'];?>&type=<?php echo $type[$i];?>&no_of_ques=<?php echo $row[1];?>&sec=<?php echo $row[$i+4];?>&name=<?php echo $row[0];?>&level=<?php echo $_GET['level'];?>"
                                        class="text-decoration-none">Start <i
                                            class="fa-solid fa-arrow-right rounded-circle bg-primary p-1"
                                            style="color:white;"></i></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>
</body>

</html>