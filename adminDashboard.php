<?php

include("connection.php");
$sel = "select*from participants";
$sel2 = "select*from loggedin_users";
$data = mysqli_query($conn, $sel);
$num = mysqli_num_rows($data);
$data2 = mysqli_query($conn, $sel2);
$num2 = mysqli_num_rows($data2);
?>
<?php
if (isset($_GET['a']) && isset($_GET['b'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quiz Admin Dashboard</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
        <style>
            .accordion-item {
                border: none !important;

            }

            button {
                margin-bottom: 10px;
            }

            .inv {
                display: none;
            }

            .accordion-button {
                color: #0d6efd;
            }

            .accordion-button:focus {
                box-shadow: none;
            }

            .navbar .nav-link {
                color: white;

            }

            .navbar .nav-link:hover,
            .navbar .active {
                background: red;
                border-radius: 5px;
            }

            #sidebar .nav-link:hover {
                background: blue;
                color: white;
            }

            #dash:hover {
                background: transparent !important;
                color: blue !important;
            }
        </style>
    </head>


    <body>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-2">
            <a class="navbar-brand" href="#">Quiz Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-1">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="transactions.php">Transactions</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar and Content -->
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active fs-4" href="#" id="dash">
                                    <span data-feather="home"></span>
                                    Dashboard
                                </a>
                            </li>
                            <li class="accordion" id="accordionExample">
                                <div class="accordion-item nav-item">
                                    <a class="accordion-header nav-link p-0" id="headingOne">
                                        <button class="accordion-button collapsed px-3  bg-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <span data-feather="file"></span>Quizzes
                                        </button>
                                    </a>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body bg-light">
                                            <a class="nav-link" href="createQuizes.php"> Create Quizzes</a>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion" id="accordionExample2">
                                <div class="accordion-item nav-item">
                                    <a class="accordion-header nav-link p-0" id="headingTwo">
                                        <button class="accordion-button collapsed px-3  bg-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                            aria-controls="collapseTwo">
                                            <span data-feather="file"></span>Events
                                        </button>
                                    </a>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                        data-bs-parent="#accordionExample2">
                                        <div class="accordion-body bg-light">
                                            <a class="nav-link" href="createEvents.php">Organize Events</a>
                                            <a class="nav-link" href="manageEvents.php"> Manage Events</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="users.php">
                                    <span data-feather="users"></span>
                                    Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="toggle.php">
                                    <span data-feather="settings"></span>
                                    Settings
                                </a>
                            </li>
                            <li class="accordion" id="accordionExample3">
                                <div class="accordion-item nav-item">
                                    <a class="accordion-header nav-link p-0" id="header">
                                        <button class="accordion-button collapsed px-3  bg-light" type="button"
                                            data-bs-toggle="collapse" onclick="fun()" data-bs-target="#collapsing"
                                            aria-expanded="true" aria-controls="collapsing">
                                            <span data-feather="file"></span>User Reviews
                                        </button>
                                    </a>
                                    <div id="collapsing" class="accordion-collapse collapse" aria-labelledby="collapsing"
                                        data-bs-parent="#accordionExample3">
                                        <div class="accordion-body bg-light" id="messages">
                                            <?php
                                            include("connection.php");
                                            $sel = "select * from feedback";
                                            $data = mysqli_query($conn, $sel);
                                            while ($rec = mysqli_fetch_array($data)) {
                                                ?>
                                                <a class="nav-link btn btn-white" type='button' data-bs-toggle="modal"
                                                    data-bs-target="<?php echo '#modalId' . $rec[0]; ?>"><?php echo $rec[1]; ?></a>
                                                <!-- Modal trigger button -->



                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->

                                                <?php
                                            }
                                            ?>


                                        </div>
                                    </div>

                                    <span class='text-center text-danger d-block bg-light' style='font-size:12px;'
                                        id='review'></span>
                                    <?php
                                    echo "<script>
                                console.log(document.querySelector('#messages').children.length)
                                if(localStorage.getItem('counting')!=document.querySelector('#messages').children.length)
                                {
                                    review.innerHTML=`NEW REVIEW &nbsp;&nbsp;<i class='fa-solid fa-bell fa-lg'
                                    style='color: #ee4811;'></i></span>`
                                    len=document.querySelector('#messages').children.length
                                    localStorage.setItem('counting',len)
                                } </script>"
                                        ?>


                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard</h1>
                    </div>
                    <?php
                    $sel2 = "select * from feedback";
                    $data2 = mysqli_query($conn, $sel2);
                    while ($rec2 = mysqli_fetch_array($data2)) {
                        ?>
                        <div class="modal fade" id="<?php echo 'modalId' . $rec2[0]; ?>" role="dialog"
                            aria-labelledby="modalTitleId">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">
                                            <?php echo "Review from " . $rec2[1]; ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body"><b>From:
                                        </b><?php echo $rec2[2]; ?><br>
                                        <b>Quality: </b><?php echo $rec2[3]; ?><br>
                                        <b>Rating: </b><?php echo $rec2[4]; ?><br>
                                        <p><b>Description: </b><?php echo $rec2[5]; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <a href="deleteReview.php?em=<?php echo $rec2[2]; ?>" type="button"
                                            class="btn btn-primary">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- Cards Section -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Active Users</h5>
                                    <p class="card-text"><?php echo $num2; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text"><?php echo $num; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Active Quizzes</h5>
                                    <?php
                                    $selQuiz = "select* from quiz";
                                    $dataQ = mysqli_query($conn, $selQuiz);
                                    $noQuiz = mysqli_num_rows($dataQ);
                                    ?>
                                    <p class="card-text"><?php echo $noQuiz; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Active Events</h5>
                                    <?php
                                    $selEvt = "select* from event";
                                    $dataE = mysqli_query($conn, $selEvt);
                                    $noEvt = mysqli_num_rows($dataE);
                                    ?>
                                    <p class="card-text"><?php echo $noEvt; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-white mb-3 bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title">Total Reviews</h5>
                                    <?php
                                    $selRev = "select* from feedback";
                                    $dataR = mysqli_query($conn, $selRev);
                                    $noRev = mysqli_num_rows($dataR);
                                    ?>

                                    <p class="card-text"><?php echo $noRev; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quizzes Table -->
                    <h2>Available Quizzes</h2>
                    <form action="delete.php" method="post" id="upd"></form>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>No of Questions</th>
                                    <th>Difficulty</th>
                                    <th>Category</th>
                                    <th>Date Created/Modified</th>
                                    <th>Time</th>
                                    <th>Time Slice</th>
                                    <th>Lives</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sel1 = "select * from quiz order by Date_Created DESC";
                                $data = mysqli_query($conn, $sel1);
                                while ($row = mysqli_fetch_array($data)) {
                                    ?>
                                    <tr>
                                        <td><span><?php echo $row[0]; ?></span><input type="text" form='upd' name='qname'
                                                class='inv' value="<?php echo $row[0]; ?>"></td>
                                        <td><span><?php echo $row[1]; ?></span><input type="text" form='upd' name='noq'
                                                class='inv' value="<?php echo $row[1]; ?>"></td>
                                        <td><span><?php echo $row[2]; ?></span><input type="text" form='upd' readonly name='dif'
                                                class='inv' value="<?php echo $row[2]; ?>"></td>
                                        <td><span><?php echo $row[3]; ?></span><input type="text" form='upd' readonly name='cat'
                                                class='inv' value="<?php echo $row[3]; ?>"></td>
                                        <td><span><?php echo $row[7]; ?></span><input type="text" form='upd' name='date'
                                                class='inv' value="<?php echo $row[7]; ?>"></td>
                                        <td><span><?php echo $row[4]; ?></span><input type="text" form='upd' name='time'
                                                class='inv' value="<?php echo $row[4]; ?>"></td>
                                        <td><span><?php echo $row[5]; ?></span><input type="text" form='upd' name='slice'
                                                class='inv' value="<?php echo $row[5]; ?>"></td>
                                        <td><span><?php echo $row[6]; ?></span><input type="text" form='upd' name='life'
                                                class='inv' value="<?php echo $row[6]; ?>"></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" onclick="show(this)">Edit</button>
                                            <button class="btn btn-sm btn-secondary" type="submit" form='upd'
                                                formaction="update.php">Update</button>
                                            <button class="btn btn-sm btn-danger" type="submit" form="upd">Delete</button>
                                            <input type="text" hidden name="hidName" value="<?php echo $row[0]; ?>" form="upd">
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and Feather Icons -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script>
            h = window.innerHeight
            document.querySelector('.sidebar').style.height = h + 'px'
            console.log(localStorage.getItem('counting'))
            function fun() {
                review.innerHTML = ''
            }
            function show(elem) {
                par = elem.parentNode.parentNode;
                for ($i = 0; $i <= 7; $i++) {
                    for ($j = 0; $j <= 1; $j++) {
                        console.log(par.children[$i].children[$j])
                        par.children[$i].children[$j].classList.toggle('inv')
                    }
                }
            }
        </script>
    </body>

    </html>
    <?php
} else
    echo "<p>Please login first</p>";
?>