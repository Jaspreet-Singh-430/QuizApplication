<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .btn:hover {
            background-color: green;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 text-center">
                <img src="./images/start.png" class='img-fluid' alt="">
                <p class="fs-5">Get started with Quiz world to tackle hundreds of quiz games.</p>
                <p class="fs-4 text-primary">All the Best.</p>
                <a href="mainplay.php?cat=<?php echo @$_GET['cat']; ?>&name=<?php echo $_GET['name'];?>&level=<?php echo $_GET['level'];?>&type=<?php echo $_GET['type'];?>&no_of_ques=<?php echo $_GET['no_of_ques'];?>&sec=<?php echo $_GET['sec'];?>";
                            class="btn btn-primary rounded-pill btn-lg px-5">Play</a>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <h1 class="text-primary">Instructions</h1>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-6">
                        <i class="fa-solid fa-question mx-3" style="color: #74C0FC;font-size:70px;float:left;"></i>
                        <span style="font-weight:bold;font-size:24px;"><?php echo $_GET['no_of_ques'];?></span><br>
                        <span><b>Questions</b></span>
                    </div>
                    <div class="col-6">
                        <?php
                        if($_GET['type']=='Time Duration')
                        {
                        ?>
                        <i class="fa-regular fa-clock mx-3" style="color: #74C0FC;font-size:70px;float:left;"></i>
                        <?php
                        }
                        else if($_GET['type']=='Time Slice')
                        {
                        ?>
                        <i class="fa-solid fa-hourglass-start mx-3" style="color: #74C0FC;font-size:70px;float:left;"></i>
                        <?php
                        }
                        else
                        {
                        ?>
                        <i class="fa-solid fa-heart mx-3" style="color: #74C0FC;font-size:70px;float:left;"></i>
                        <?php
                        }
                        ?>
                        <span style="font-weight:bold;font-size:24px;"><?php echo substr($_GET['sec'],0,2);?></span><br>
                        <span><b><?php if($_GET['type']=='Time Duration')
                        echo "Minutes";
                        else if($_GET['type']=='Time Slice')
                        echo "seconds per Question";
                        else
                        echo "lives";
                    ?></b></span>
                    </div>
                </div>
                <div class="row fs-4">
                    <div class="col">
                        <ul class="list-group list-unstyled">
                            <li class="list-group-item"><i class="fa-solid fa-star"></i> 4.0 mark is awarded for correct
                                attempts and -1.0 marks for incorrect attempts</li>
                            <li class="list-group-item"><i class="fa-solid fa-check"></i> Tap on options to select the
                                correct answer</li>
                            <li class="list-group-item"><i class="fa-solid fa-location-arrow"></i> 
                            <?php if($_GET['type']=='Time Duration')
                            echo "Click goto button to
                                jump directly to a specific question corresponding to the question number entered in
                                prompt dialog box.";
                                else if($_GET['type']=='Time Slice')
                                {
                                    $mess=$_GET['sec'];
                                echo "$mess will be given to answer each question.The screen automatically scrolls or swipes to the next question either in case of success attempt or failed attempt when time slice runs out.";
                                }
                                else
                                {
                                    $mess=$_GET['sec'];
                                    echo "You have got $mess at the beginning. One life will be lost for selecting incorrect answer of each question";
                                }
                                ?>
                                </li>
                                
                                <li class="list-group-item"><i class="fa-solid fa-check"></i> <?php
                                if($_GET['type']=='No. of lives')
                                echo "The Quiz will over if you run out of all your lives.";
                                else if($_GET["type"]== "Time Slice")
                                echo "You can use one lifeline '50:50' for your convinience that remove two wrong answers.It can be used it only once.This lifeline if already used, can be revived for every 5 correct answers ";
                                else
                                echo "The Quiz test will automatically be submitted on time up event. Keep an eye on clock provided in the navigation menu at the top of window to track the duration of run out.";?>
                                </li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-8">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>