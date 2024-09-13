<?php include("connection.php");
session_start(); 
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

        .wrongAns {}

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
                    <li class="nav-item me-5 fs-4"><?php echo strtoupper($_GET['cat']) . ' QUIZ'; ?></li>
                    <li class="nav-item me-5 fs-4">Level : <?php echo strtoupper($_GET['level']); ?></li>
                    <li class="nav-item me-5 fs-4">
                        <?php
                        if ($_GET['type'] != 'Time Duration')
                            echo "Score : <span id='scoreCard'>0</span>";
                        ?>
                    </li>
                    <?php if ($_GET['type'] == 'Time Duration') {
                        $sec = @$_GET['sec'];
                        $seca=substr($sec,0,2);
                        echo "<li class='nav-item me-5 fs-4'>Time : <span class='bg-danger py-1 px-3 rounded-2' id='time'>$seca : 00</span></li>";
                    }
                    ?>
                    <?php if ($_GET['type'] == 'No. of lives') {
                        ?>
                        <li class="nav-item me-3 fs-4 lives">Lives:
                            <?php for ($k = 0; $k < $_GET['sec']; $k++) {
                                ?>
                                <i class="fa-solid fa-heart" style="color:yellow;"></i>
                                <?php
                            }
                            ?>
                        </li>
                    <?php }
                    ; ?>
                    <?php if ($_GET['type'] != 'Time Slice') {
                        ?>
                        <li class="nav-item me-3 ms-auto"><button class="btn btn-warning" id="goTo" onclick="navigate()">Go
                                to</button></li>
                    <?php }
                    ; ?>

                    <?php if ($_GET['type'] == 'Time Slice') {
                        ?>
                        <li class="nav-item me-3 ms-auto"><button class="btn btn-warning rounded-4" id="half"
                                onclick="half()" <?php if (isset($isdisabled))
                                    echo @$isdisabled; ?>>50:50</button></li>
                    <?php }
                    ; ?>
                    <li class="nav-item"><button class="btn btn-success" type="submit" form="examform"
                            id="submit">Submit</button></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="menu-container col">
                <?php
                for ($i = 0; $i < $_GET['no_of_ques']; $i++) {
                    ?>
                    <a id="<?php echo 'Item' . $i + 1; ?>" class="navlink <?php if ($i == 0)
                               echo "active_link"; ?>" <?php if ($_GET['type'] != 'Time Slice') { ?> onclick="fun(this)"
                        <?php } ?>><?php echo $i + 1; ?></a>
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
                        <form action="result.php" method="post" id="examform">
                            <div id="carouselId" class="carousel slide">
                                <div class="carousel-inner " role="listbox">
                                    <?php for ($i = 0; $i < $_GET['no_of_ques']; $i++) {
                                        ?>
                                        <div class="carousel-item <?php if ($i == 0)
                                            echo "active"; ?>">
                                            <h1 id="<?php echo 'Item' . $i; ?>" class="my-3 py-4 question"><span
                                                    class='text-muted'><?php echo 'Question ' . $i + 1; ?></span> :
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
                            <input type="text" value="<?php echo $_GET['name'] ;?>" hidden name="quizname">
                            <input type="text" value="<?php echo $_GET['cat'] ;?>" hidden name="category">
                            <input type="text" value="<?php echo $_GET['level'] ;?>" hidden name="level">
                            <input type="text" value="<?php echo $_GET['type'] ;?>" hidden name="type">
                            
                            
                                <input type="text" name='islifeUsed' id='islifeUsed' hidden value="0">
                                <input type="text" name='islifeLost' id='islifeLost' hidden value="0">
                                <input type="text" name="timetaken" id="timetaken">
                            
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="text-center" id="stat"></p>
                        <button <?php if ($_GET['type'] == 'Time Slice') { ?>style="visibility:hidden;" <?php } ?>
                            class="btn btn-primary text-white" id='prev' onclick="prevQ()"
                            style="float:left;visibility:hidden;">&lt;&lt;Previous</button>
                        <button <?php if ($_GET['type'] == 'Time Slice') { ?>style="visibility:hidden;" <?php } ?>
                            class="btn btn-primary text-white" id='next' onclick="nextQ()"
                            style="float:right;">Next&gt;&gt;</button>
                    </div>
                </div>
            </div>
            <div class="col-6 timing">
                <?php if ($_GET['type'] == 'Time Slice')
                    include('stopwatch.php');
                ?>
                <?php
                for ($j = 0; $j < @$_GET['no_of_ques']; $j++) {
                    ?>
                    <input type="text" hidden name="<?php echo 'corr' . $j; ?>" class='corr' value="" form="examform"><br>
                    <input type="text" hidden name="<?php echo 'que' . $j; ?>" class='que' value="" form="examform"><br>
                    <?php
                }
                ?>
                <input type="text" form="examform" hidden name="no_of_ques" value="<?php echo @$_GET['no_of_ques']; ?>">
            </div>
        </div>
    </div>
    </div>
    <script>
        cnt=1
        <?php if ($_GET['type'] == 'No. of lives')
            $lives = $_GET['sec'];
        ?>
                var isTabActive;
                isTabActive=true;
        window.onfocus = function () { 
          isTabActive=true; 
        }; 

        window.onblur = function () { 
          isTabActive=false; 
        }; 

        cheat=setInterval(function () { 
          console.log(isTabActive ? 'active' : 'inactive')
          if(isTabActive==false)
          {
              window.alert("It is unfair to minimize or switch tabs while game play.")
              window.alert("You are not allowed to answer questions anymore. You are disqualified")
                clearInterval(cheat)
                submit.click(); 
           }
         }, 1000);
        ttaken=0
        setInterval(function() {
           timetaken.value=ttaken
           ttaken++ 
        },1000)
        function fun(elem) {
            checker();
            elem.classList.add('active_link');
            link_navigate(elem);
        }
        function link_navigate(elem) {
            a = elem.innerHTML
            <?php if ($_GET['type'] != 'Time Slice') {
                ?>
                if (a == 1) {
                    prev.style.visibility = 'hidden';
                    next.style.visibility = 'visible'
                }
                else if (a == <?php echo $_GET['no_of_ques']; ?>) {
                    prev.style.visibility = 'visible';
                    next.style.visibility = 'hidden'
                }
                else {
                    prev.style.visibility = 'visible';
                    next.style.visibility = 'visible';
                }
                <?php
            }
            ;
            ?>
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
        fetch("https://the-trivia-api.com/v2/questions?limit=<?php echo @$_GET['no_of_ques']; ?>&categories=<?php echo @$_GET['cat']; ?>&difficulties=<?php echo @$_GET['level']; ?>").
            then((response) => {
                if (!response.ok)
                    throw new Error("error occured")
                else
                    return response.json()
            })
            .then(function (record) {
                rightAnswers = 0
                console.log(record)
                for (i = 0; i < record.length; i++) {
                    corr[i].value = record[i].correctAnswer
                    ques[i].innerHTML += record[i].question.text
                    que[i].value = record[i].question.text

                    k = 0;
                    a = Math.floor((max - min + 1) * Math.random()) + min
                    options[4 * i + a].value = record[i].correctAnswer
                    options[4 * i + a].parentNode.parentNode.classList.add('right')
                    options[4 * i + a].nextElementSibling.onclick = function () {
                        <?php if($_GET['type']!='Time Duration') {?>
                        this.classList.add('correct');
                        stat.style.color = 'green'
                        stat.innerText = 'Correct'
                        rightAnswers++
                        console.log("right answers:" + rightAnswers)
                        if (rightAnswers == 5) {
                            half.disabled = false
                            rightAnswers = 0
                        }
                        scoreCard.innerText = Number(scoreCard.innerText) + 4
                        <?php } ?>
                        <?php if ($_GET['type'] == 'No. of lives') {
                            ?>
                            for (k = 1; k <= 4; k++) {
                                if (document.querySelector('.active').children[k].children[0].children[1].classList.contains('correct') == false)
                                    document.querySelector('.active').children[k].children[0].children[0].disabled = 'true'
                            }

                            // document.getElementsByName('options-outlined' + (i - 1))[k].disabled = 'true'
                            <?php
                        } ?>
                        <?php
                        if ($_GET['type'] == 'Time Slice') {
                            ?>
                            setTimeout(function () {
                                resetBtn.click();
                                startBtn.click();
                                nextQ();
                                stat.innerText = ''
                            }, 1000)
                        <?php } ?>
                    }
                    options[4 * i + a].nextElementSibling.innerText += options[4 * i + a].value
                    for (j = 0; j < 4; j++) {
                        if (j != a) {
                            options[4 * i + j].value = record[i].incorrectAnswers[k++]
                            options[4 * i + j].nextElementSibling.onclick = function () {
                                <?php if ($_GET['type'] == 'No. of lives') {
                                    ?>
                                    if (document.querySelector('.lives').children.length == 1) {

                                        alert("Quiz is over")
                                        submit.click();

                                    }
                                    <?php
                                }
                                ?>
                                <?php
                                if($_GET['type']!='Time Duration')
                                {
                                ?>
                                this.classList.add('wrong')
                                stat.style.color = 'red'
                                stat.innerText = 'Wrong'
                                scoreCard.innerText -= 1
                                <?php } ?>
                                <?php if ($_GET['type'] == 'No. of lives') { ?>
                                    document.querySelector('.lives').lastElementChild.remove(); 
                                    document.querySelector('#islifeLost').value=cnt
                                    cnt=cnt+1
                                    <?php } ?>
                                <?php if ($_GET['type'] == 'No. of lives') {
                                    ?>
                                    for (k = 1; k <= 4; k++) {
                                        if (document.querySelector('.active').children[k].children[0].children[1].classList.contains('wrong') == false)
                                            document.querySelector('.active').children[k].children[0].children[0].disabled = 'true'
                                    }
                                    <?php
                                } ?>
                                <?php
                                if ($_GET['type'] == 'Time Slice') {
                                    ?>
                                    setTimeout(function () {
                                        resetBtn.click();
                                        startBtn.click();
                                        nextQ();
                                        stat.innerText = ''
                                    }, 1000)
                                    <?php
                                }
                                ?>

                            }
                            options[4 * i + j].nextElementSibling.innerText += options[4 * i + j].value
                        }
                    }
                }
            })
        <?php if ($_GET['type'] == 'Time Slice') {
            ?>
            half.onclick = function () {
                let min = 1
                let max = 4
                islifeUsed.value=1
                console.log(document.querySelector('.active').children);
                l = 0
                for (x of document.querySelector('.active').children) {
                    if (x.classList.contains('right'))
                        break;
                    l++;
                }
                while (1) {
                    b = Math.floor((max - min + 1) * Math.random()) + min
                    c = Math.floor((max - min + 1) * Math.random()) + min
                    console.log("l=" + l)
                    console.log("b=" + b);
                    console.log("c=" + c)
                    if (b != l && c != l && b != c) {
                        document.querySelector('.active').children[b].style.visibility = 'hidden'
                        document.querySelector('.active').children[c].style.visibility = 'hidden'
                        break;
                    }
                }
                half.disabled = 'true';
            }

            <?php
        }
        ?>
        // .catch(error=>console.log("problem with fetch operation"))
        <?php if ($_GET['type'] == 'Time Duration') {
            ?>
            m = <?php echo substr($_GET['sec'],0,2);?>;
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
            <?php
        }
        ?>
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
                    <?php if ($_GET['type'] != 'Time Slice') { ?>
                        prev.style.visibility = 'visible'
                        <?php
                    }
                    ?>
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
                <?php if ($_GET['type'] == 'Time Slice') { ?>
                    submit.click();
                    <?php
                }
                ?>
            }

            // sib.classList.add("active_link")

        }
        link = document.querySelectorAll('.navlink')

        function navigate() {
            checker();
            document.querySelector('.menu-container').scrollTo(0, 0)
            queNo = prompt("Enter question number where you want to navigate.")
            if (queNo >= 1 && queNo <= <?php echo $_GET['no_of_ques'];?>) {
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