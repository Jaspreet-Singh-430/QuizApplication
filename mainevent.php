<?php include("connection.php");
session_start();
$cname = $_POST['cname'];
$cmail = $_POST['cmail'];
$event = $_POST['event_name'];
$limit = $_POST['limit'];
$select1 = "select Question from questions where Event_name='$event'";
$data1 = mysqli_query($conn, $select1);
$numQues = mysqli_num_rows($data1);
$questions = mysqli_fetch_array($data1);
$select2 = "select Correct_Answer from questions where Event_name='$event'";
$data2 = mysqli_query($conn, $select2);
$correctAns = mysqli_fetch_array($data2);
$select3 = "select Incorrect_Answers from questions where Event_name='$event'";
$data3 = mysqli_query($conn, $select3);
$incorrectAns = mysqli_fetch_array($data3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="C:/Users/Jassi Yamunanagar/Downloads/fontawesome-free-6.5.2-web/css/all.min.css"> -->
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        /* Container for the Navigation Menu */
        .menu-container {
            overflow-x: auto;
            white-space: nowrap;
            padding: 0.1rem 0.1rem;
            background-color: teal;
            /* Light background */
            box-shadow: 0 5px 6px rgba(0, 0, 0, 0.3);
            /* Optional shadow */
        }

        .btn-outline-secondary {
            --bs-btn-hover-bg: orange !important;
        }

        .correct {
            --bs-btn-active-bg: green;
        }

        .wrong {
            --bs-btn-active-bg: red;
        }

        .imp {
            --bs-btn-bg: green;
            --bs-btn-color: white;
        }

        /* Navigation Links */
        .menu-container a {
            display: inline-block;
            text-decoration: none;
            margin: 1rem 2.5rem;
            font-weight: bold;
            font-size: 1rem;
            color: bisque;
            padding: 10px 10px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        /* Hover Effect */
        .menu-container a:hover,
        .active_link {
            background-color: #e2e6ea;
        }

        .menu-container a:hover {
            color: red;
        }

        .active_link {
            color: black !important;
        }

        .menu-container::-webkit-scrollbar {
            height: 8px;
        }

        .menu-container::-webkit-scrollbar-thumb {
            background-color: white;
            border-radius: 10px;
        }

        .menu-container::-webkit-scrollbar-thumb:hover {
            background-color: black;
        }

        .main {
            margin-top: 173.19px;
        }

        .option:hover {
            background-color: orange !important;
            color: black !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 fixed-top">
        <div class="row">
            <div class="col">

                <ul class="nav text-bg-primary p-4">
                    <li class="nav-item me-5 fs-4"><?php echo strtoupper($event) . ' Event'; ?></li>
                    <?php
                    $seca = substr($limit, 0, 2);
                    echo "<li class='nav-item me-5 fs-4'>Time : <span class='bg-danger py-1 px-3 rounded-2' id='time'>$seca : 00</span></li>";
                    ?>

                    <li class="nav-item me-3 ms-auto"><button class="btn btn-warning" id="goTo" onclick="navigate()">Go
                            to</button></li>
                    <li class="nav-item"><button class="btn btn-success" type="submit" form="examform"
                            id="submit">Submit</button></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="menu-container col">
                <?php
                for ($i = 0; $i < $numQues; $i++) {
                    ?>
                    <a id="<?php echo 'Item' . $i + 1; ?>" class="navlink <?php if ($i == 0)
                               echo "active_link"; ?>" onclick="fun(this)"><?php echo $i + 1; ?></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class='container-fluid main'>
        <div class="row mt-3">
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <form action="thanks.php" method="post" id="examform">
                            <input type="text" name="no_of_ques" hidden value="<?php echo $numQues; ?>">
                            <input type="text" name="cname" hidden value="<?php echo $cname; ?>">
                            <input type="text" name="cmail" hidden value="<?php echo $cmail; ?>">
                            <div id="carouselId" class="carousel slide">
                                <div class="carousel-inner " role="listbox">
                                    <?php for ($i = 0; $i < $numQues; $i++) {
                                        ?>
                                        <div class="carousel-item <?php if ($i == 0)
                                            echo "active"; ?>">
                                            <h1 id="<?php echo 'Item' . $i; ?>" class="my-3 py-4 question"><span
                                                    class='text-muted'><?php echo 'Question ' . $i + 1; ?></span>
                                                :
                                            </h1>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="radio" name="<?php echo 'options-outlined' . $i ?>"
                                                        class="btn-check option"
                                                        id="<?php echo 'btn-check-outlined' . $i; ?>" autocomplete="off">
                                                    <label class="btn btn-outline-secondary d-block"
                                                        for="<?php echo 'btn-check-outlined' . $i; ?>"><span
                                                            class='me-4 text-dark'>A.&nbsp;&nbsp;&nbsp;&nbsp;</span></label><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="radio" class="btn-check option"
                                                        name="<?php echo 'options-outlined' . $i ?>"
                                                        id="<?php echo 'btn-check-2-outlined' . $i; ?>" autocomplete="off">
                                                    <label class="btn btn-outline-secondary d-block"
                                                        for="<?php echo 'btn-check-2-outlined' . $i; ?>"><span
                                                            class='me-4 text-dark'>B.&nbsp;&nbsp;&nbsp;&nbsp;</span></label><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="radio" class="btn-check option"
                                                        name="<?php echo 'options-outlined' . $i ?>"
                                                        id="<?php echo 'secondary-outlined' . $i; ?>" autocomplete="off">
                                                    <label class="btn btn-outline-secondary d-block"
                                                        for="<?php echo 'secondary-outlined' . $i; ?>"><span
                                                            class='me-4 text-dark'>C.&nbsp;&nbsp;&nbsp;&nbsp;</span></label><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="radio" class="btn-check option"
                                                        name="<?php echo 'options-outlined' . $i ?>"
                                                        id="<?php echo 'sec-outlined' . $i; ?>" autocomplete="off">
                                                    <label class="btn btn-outline-secondary d-block"
                                                        for="<?php echo 'sec-outlined' . $i; ?>"><span
                                                            class='me-4 text-dark'>D.&nbsp;&nbsp;&nbsp;&nbsp;</span></label><br>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <input type="text" value="<?php echo $event; ?>" hidden name="evname">

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="text-center" id="stat"></p>
                        <button class="btn btn-primary text-white" id='prev' onclick="prevQ()"
                            style="float:left;visibility:hidden;">&lt;&lt;Previous</button>
                        <button class="btn btn-primary text-white" id='next' onclick="nextQ()"
                            style="float:right;">Next&gt;&gt;</button>
                    </div>
                </div>
            </div>
            <div class="col-6 timing">

                <?php
                for ($j = 0; $j < $numQues; $j++) {
                    ?>
                    <input type="text" hidden name="<?php echo 'corr' . $j; ?>" class='corr' value="" form="examform"><br>
                    <input type="text" hidden name="<?php echo 'que' . $j; ?>" class='que' value="" form="examform"><br>
                    <?php
                }
                ?>
                <input type="text" form="examform" hidden name="no_of_ques" value="<?php echo $numQues; ?>">
            </div>
        </div>
    </div>
    </div>
    <script>

        function fun(elem) {
            checker();
            elem.classList.add('active_link');
            link_navigate(elem);
        }
        function link_navigate(elem) {
            a = elem.innerHTML
            if (a == 1) {
                prev.style.visibility = 'hidden';
                next.style.visibility = 'visible'
            }
            else if (a == <?php echo $numQues; ?>) {
                prev.style.visibility = 'visible';
                next.style.visibility = 'hidden'
            }
            else {
                prev.style.visibility = 'visible';
                next.style.visibility = 'visible';
            }
            item = document.getElementsByClassName("carousel-item")[a - 1]
            document.getElementsByClassName('active')[0].classList.remove('active')
            item.classList.add('active')
            link[a - 1].classList.add('active_link')
        }
        carIn = document.getElementsByClassName('carousel-inner')
        ques = document.getElementsByClassName("question")
        options = document.getElementsByClassName('option')
        corr = document.getElementsByClassName('corr')
        que = document.getElementsByClassName('que')
        min = 0
        max = 3
        rightAnswers = 0;
        <?php $j = -1; ?>
        numQues = <?php echo $numQues; ?>;
        for (i = 0; i < numQues; i++) {
            <?php $j = $j + 1; ?>;
            corr[i].value = "<?php echo $correctAns[$j]; ?>";
            ques[i].innerHTML += "<?php echo $questions[$j]; ?>";
            que[i].value = "<?php echo $questions[$j]; ?>";
            a = Math.floor((max - min + 1) * Math.random()) + min;
            options[4 * i + a].value = "<?php echo $correctAns[$j]; ?>";
            options[4 * i + a].parentNode.parentNode.classList.add('right')
            options[4 * i + a].nextElementSibling.innerText += options[4 * i + a].value
            j = 0
            <?php for ($l = 0; $l<3; ) {
                ?>
                if (j <= 3) {
                    if (j != a) {
                        options[4 * i + j].value = "<?php echo explode(",", $incorrectAns[$j])[$l]; ?>";
                        options[4 * i + j].nextElementSibling.innerText += options[4 * i + j].value;
                        <?php $l = $l + 1; ?>;
                        j = j + 1;
                    }
                    else {
                        j = j + 1;

                    }

                }
                <?php
            }
            ?>
        }

        m = <?php echo $limit; ?>;
        s = '0' + 0
        check = setInterval(function () {
            if (s == 0 && m == 0) {
                clearInterval(check)
                alert("Time is over.Quiz Test has ended")
                submit.click()
            }

            if (s == 0) {
                s = 59;
                m = m - 1;
                if (m < 10)
                    m = '0' + m
            }
            else
                s = s - 1
            if (s < 10)
                s = '0' + s
            time.innerHTML = m + " : " + s
        }, 1000)

        prev = document.getElementById('prev')
        next = document.getElementById('next')
        function prevQ() {
            stat.innerText = ''
            active = document.getElementsByClassName("active")[0]
            sib = active.previousElementSibling
            if (sib) {
                if (!sib.previousElementSibling)
                    prev.style.visibility = 'hidden'
                else
                    next.style.visibility = 'visible'
                active.classList.remove("active")
                sib.classList.add("active")
                b = document.querySelector('.active_link')
                b.classList.remove('active_link')
                b.previousElementSibling.classList.add('active_link')
                document.querySelector('.menu-container').scrollBy(-50, 0)
                // location.href='#'+b.previousElementSibling.getAttribute('id')
            }
            else
                prev.style.visibility = 'hidden'
        }

        function nextQ() {
            stat.innerText = ''
            active = document.getElementsByClassName("active")[0]
            sib = active.nextElementSibling
            if (sib) {
                if (!sib.nextElementSibling)
                    next.style.visibility = 'hidden'
                else {

                    prev.style.visibility = 'visible'

                }
                active.classList.remove("active")
                sib.classList.add("active")
                b = document.querySelector('.active_link')
                b.classList.remove('active_link')
                b.nextElementSibling.classList.add('active_link')
                // location.href='#'+b.nextElementSibling.getAttribute('id')
                document.querySelector('.menu-container').scrollBy(60, 0)
            }
            else {
                next.style.visibility = 'hidden'

            }

            // sib.classList.add("active_link")

        }
        link = document.querySelectorAll('.navlink')

        function navigate() {
            checker();
            document.querySelector('.menu-container').scrollTo(0, 0)
            queNo = prompt("Enter question number where you want to navigate.")
            if (queNo >= 1 && queNo <= (<?php echo $numQues; ?>)) {
                item = document.getElementsByClassName("carousel-item")[queNo - 1]
                document.getElementsByClassName('active')[0].classList.remove('active')
                item.classList.add('active')
                if (!item.previousElementSibling)
                    prev.style.visibility = 'hidden'
                else if (!item.nextElementSibling)
                    next.style.visibility = 'hidden'
                else {
                    prev.style.visibility = 'visible'
                    next.style.visibility = 'visible'
                }

                link[queNo - 1].classList.add('active_link')
                document.querySelector('.menu-container').scrollBy(60 * (queNo - 1), 0)
            }
            else
                alert("Please enter a valid question number")
        }
        function checker() {
            document.querySelector(".active_link").classList.remove('active_link')
        }

    </script>
</body>

</html>