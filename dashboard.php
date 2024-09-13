<?php
session_start();
include("connection.php");
$create="insert into badge_winner select * from loggedin_users inner join badges";
mysqli_query($conn,$create); 
?>
<?php
if (isset($_SESSION["user"]) && isset($_COOKIE['usermail'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            @media screen and (min-width:768px) {
                .row {
                    margin-top: 2.5%;
                }
            }

            @media screen and (max-width:768px) {
                .col-md-4 {
                    margin-bottom: 2.5%;
                }
            }

            .col-md-4 {
                height: 100px;
            }

            .col-md-4>div {
                height: inherit;
                color: white;
                text-align: center;
                line-height: 100px;
                font-weight: bold;
                font-size: 100%;
            }

            .container-fluid {
                padding: 0px;
                z-index: 6;
            }

            .bar {
                aspect-ratio: 1;
            }

            .bar a {
                display: block;
                text-align: center;
            }

            .bar i {
                display: block;
                margin: auto;
            }

            .bar:hover {
                background: greenyellow;
                border-radius: 50%;

            }

            .me-3 {
                margin-right: 0px !important;
            }

            .bar:hover i {
                color: black;
            }

            .nav-link:not(#footer .nav-link) {
                color: white;
            }

            .nav-link:not(#footer .nav-link):hover {
                color: greenyellow;
            }

            ul:nth-child(2) {
                position: relative;
            }

            #quizbox {
                display: flex;
                justify-content: space-evenly;
                background-color: rgb(194, 194, 194);
                overflow: hidden;
            }

            .indicate {
                background-color: red;
                position: absolute;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                text-align: center;
                font-size: 11px;
                border: 1px solid white;
                top: 11px;
            }

            #quizbox a {
                text-decoration: none;
                color: black;
                margin-bottom: 1%;
                display: block;
            }

            #quizbox a:hover {
                text-decoration: underline;
                color: brown;
            }

            input[type='search'] {
                width: 100%;
                margin-top: 8px;
            }

            #search {
                border-radius: 5px;
                position: absolute;
                right: 10px;
                top: 100%;
                background: grey;
                padding: 15px;
                color: orange;
                width: 25%;
                visibility: hidden;
            }

            #X {
                cursor: pointer;
            }

            #autolist {
                background: white;
                padding: 0px;
            }

            #autolist li {
                padding: 3px;
            }

            #autolist li:hover {
                background: blueviolet;
                color: white;
            }
            #uppernav a:hover {
                color:black;
            }
            #uppernav a {
                color:white;
            }
        </style>

    </head>

    <body>
        <div class="container-fluid">
            <ul class="nav bg-warning p-3 d-flex" id="uppernav">
                <li class="nav-item me-4"><i class="fa-solid fa-house-chimney me-2" style="color:white;"></i><a href="dashboard.php"
                        class="text-decoration-none"><b>Home</b></a></li>
                <li class="nav-item me-4"><i class="fa-solid fa-question me-2" style="color: #ffffff;"></i><a href="high_score.php"
                        class="text-decoration-none"><b>High Score</b></a></li>
                <li class="nav-item me-4"><b>|</b></li>
                <li class="nav-item me-4"><i class="fa-solid fa-calendar-days me-2" style="color: #ffffff;"></i><a
                        href="./usersideEvents.php" class="text-decoration-none"><b>Events</b></a></li>
                <li class="nav-item me-4"><i class="fa-solid fa-ranking-star me-2" style="color: #ffffff;"></i><a href="leaderboard.php"
                        class=" text-decoration-none"><b>Leaderboard</b></a></li>
                <li class="nav-item me-4"><i class="fa-solid fa-person-chalkboard me-2" style="color: #ffffff;"></i></i><a href="instructions.php"
                        class="text-decoration-none"><b>Instructions</b></a></li>
                <li class="nav-item ms-auto me-4"><i class="fa-solid fa-gear me-2" style="color: #ffffff;"></i><a href="profile.php"
                        class="text-decoration-none"><b>Profile Settings</b></a></li>
                <li class="nav-item"><i class="fa-solid fa-arrow-right-from-bracket me-2" style="color: #ffffff;"></i><a
                        href="logout.php" class="text-white text-decoration-none" id="logout"><b>Logout</b></a></li>
                <!-- <li class="nav-item"><i class="fa-solid fa-magnifying-glass fa-lg" style="color: #9ca1ab;background:white;"></i><input type='search' placeholder="Search something here"></input></li> -->
            </ul>
            <ul class="nav bg-dark p-2 d-flex align-content-center">
                <li class="nav-item me-3 bar d-flex"><a class="nav-link align-self-center"><i
                            class="fa-solid fa-bars me-3 fa-lg"></i></a></li>
                <li class="nav-item me-3 d-flex">
                <img src="./images/quiz.webp" id="quiz" alt="" height=60px width=60px class="rounded-circle ms-4">
                <a href="" class="nav-link align-self-center"
                        style="font-size:28px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;color:rgb(251, 255, 0)">Quiz
                        World</a>
                    </li>
                <li class="nav-item me-3 d-flex"></i><a href="myTransaction.php" class="nav-link align-self-center"><i
                            class="fa-solid fa-money-bill me-2" style="color: #ffffff;"></i>MY TRANSACTIONS</a></li>
                <li class="nav-item me-3 d-flex"><a href="feedback.php" class="nav-link align-self-center"><i
                            class="fa-regular fa-comment me-2" style="color: #ffffff;"></i>FEEDBACK</a></li>
                <li class="nav-item me-3 d-flex" style="position:relative;"><a href="badges.php"
                        class="nav-link align-self-center">BADGES<span class="indicate"><?php echo @$_SESSION['badge'];?></span></a></li>
                <li class="nav-item d-flex ms-auto"><a class="nav-link align-self-center" id="show"><i
                            class="fa-solid fa-magnifying-glass me-2" style="color: #c7c9cc;"></i>SEARCH</a></li>
                <div id="search">
                    <span style="float:left;">Search something Here</span><span id='X' style="float:right;">X</span><br>
                    <input type="search" placeholder="search something" id="searchBox">
                    <ul id="autolist" style="list-style-type:none;">
                    </ul>
                    <a href="" id='go' class="btn btn-sm btn-warning mt-1">Search</a>
                </div>

            </ul>
            <div id="quizbox" class="">
                <div>
                    <p style="font-size:22px;"><b>Quiz Categories</b></p>
                    <a href="./quizplay.php?cat=music">Music</a>
                    <a href="./quizplay.php?cat=sport_and_leisure">Sports</a>
                    <a href="./quizplay.php?cat=film_and_tv">Film and TV</a>
                    <a href="./quizplay.php?cat=arts_and_literature">Arts and Literature</a>
                </div>
                <div class="mt-2">
                    <p><br></p>
                    <a href="./quizplay.php?cat=history">History</a>
                    <a href="./quizplay.php?cat=society_and_culture">Society and Culture</a>
                    <a href="./quizplay.php?cat=science">Science</a>
                    <a href="./quizplay.php?cat=geography">Geography</a>
                </div>
                <div class="mt-2">
                    <p><br></p>
                    <a href="./quizplay.php?cat=food_and_drink">Food and Drink</a>
                    <a href="./quizplay.php?cat=general_knowledge">General Knowledge</a>
                    <a href="./quizplay.php?cat=">Miscellaneous</a>
                </div>
            </div>
            <div class="text-bg-secondary text-center p-3"><b>Welcome dear <?php echo $_SESSION['user']; ?> to Quiz World. Play many
                    types of quizes. Join a live event.There is no cost at all</b></div>
            <div class="row px-5 justify-content-between">
                <div class="col-md-6">
                    <h2 class=" text-center text-primary my-4">Boost your Knowledge</h2>
                    <p>Knowledge is deemed as the most powerful tool a human possesses. It is the cornerstone of power in
                        our modern society. The universally acknowledged phrase ‘Knowledge is power’ highlights the profound
                        impact knowledge has on individuals and society, and both.
                        The first thing to know about knowledge is that it is the key to personal development and
                        empowerment. When a person acquires knowledge, they open doors to personal growth and development.
                        Depending on the person’s expertise and field, this empowerment can come in various forms. I person
                        with the right knowledge often finds himself confident, adaptable, and capable of overcoming
                        obstacles in life.
                        Moreover, knowledge equips you to make informed decisions. We are living in a world which is driven
                        by information. A person who is well-equipped with knowledge about his or her specific field can
                        critically assess a situation, evaluate the options and make choices that best suit their individual
                        needs and values. This not only enhances their personal lives but also fosters a sense of agency and
                        self-determination.</p>
                    <a class="btn btn-primary" href="learnmore.html">Learn more</a>
                </div>
                <div class="col-md-5">
                    <img src="./images/dash_img2.jpg" alt="" class="img-fluid" height=60%;>
                </div>
            </div>
            <div class="row px-5 justify-content-between">
                <h2 class="text-center mt-2 mb-4">Some More Items ..</h2>
                <div class="card text-white bg-secondary col-md-3 px-0">
                    <img class="card-img-top" src="./images/card1.jpg" height="250px" alt="Title" />
                    <div class="card-body">
                        <h4 class="card-title text-center ">Read Interesting Topics</h4>
                        <p class="card-text">Browse the categories or list of articles and basic general knowledge subjects
                            like country facts,First in space etc.</p>
                        <a href="topics.php" class="stretched-link"></a>
                    </div>
                </div>
                <div class="card text-white bg-danger col-md-3 px-0">
                    <img class="card-img-top" src="./images/resreview.jpeg" height="250px" alt="Title" />
                    <div class="card-body">
                        <h4 class="card-title text-center">Results Review</h4>
                        <p class="card-text">Click this section to go through your attempted tests. Study the Analytical
                            reports of your performance in statistical ways.</p>
                        <a href="myresults.php" class="stretched-link"></a>
                    </div>
                </div>
                <div class="card card-link bg-primary text-white col-md-3 px-0">
                    <img class="card-img-top" src="./images/success.webp" alt="Title" height="250px"/>
                    <div class="card-body bg-success">
                        <h4 class="card-title text-center">Achievements</h4>
                        <p class="card-text">Here you can view your awards and badges earned through efforts for skill
                            development,memory enhancement and on the basis of accomplishment of quiz challenges. </p>
                        <a href="mybadges.php" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="row px-5 border-top border-bottom border-secondary py-4 border-2 bg-light" id="footer">
                <div class="col-3 border-end px-3"><span
                        style="font-size:28px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;;">Quiz
                        World</span>
                    <p style="font-size:12px">________est. 2024_________<br><br>
                        mentally stimulating diversions</p>
                </div>
                <div class="col-3 border-end px-3">
                    <nav class="nav-stacked">
                        <b style="font-family:'Times New Roman', Times, serif; font-size:18px;">Resources</b><br><br>
                        <a href="" class="nav-link">Documentation</a></li>
                        <a href="" class="nav-link">FAQ</a></li>
                </div>
                <div class="col-3 border-end px-3">
                    <b style="font-family:'Times New Roman', Times, serif; font-size:18px;">Contact details</b><br><br>
                    <span class="d-block">123, Sarojini Colony Part-1 Yamunanagar, Haryana<br>135001</span>
                    <span class="d-block">+91-951-863-6525</span>
                </div>
                <div class="col-3">
                    <nav class="nav-stacked px-3">
                        <b style="font-family:'Times New Roman', Times, serif; font-size:18px;">Popular Quizes</b><br><br>
                        <a href="" class="nav-link">ABC</a>
                        <a href="" class="nav-link">XYZ</a>
                    </nav>
                </div>
            </div>
            <div class="row  text-bg-dark my-0">
                <div class="col-6 text-sm py-3 px-3">Copyright 2024 Quiz World app.</div>
                <div class="col-6 text-end py-3 px-3">Follow us : &nbsp;&nbsp;<a style="color:white;" href="https://www.facebook.com/jaspreet.singh2808"><i class="fa fa-facebook me-4"></i></a>
                    <a style="color:white;" href="https://www.instagram.com/jas_preet1234singh?igsh=YzljYTk1ODg3Zg=="><i class="fa fa-instagram me-4"></i></a>
                    <a href="https://www.linkedin.com/in/jaspreetsingh2882000?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" style="color:white;"><i class="fa fa-linkedin me-4"></i></a>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.bar').click(function () {
                    $('#quizbox').slideToggle()
                })
            })
        </script>
        <script>
        const items = ["music", "sport_and_leisure", "film_and_tv", "arts_and_literature", "history", "society_and_culture", "science", "geography", "food_and_drink", "general_knowledge", "miscellaneous"];
            bar = document.getElementsByClassName('bar')[0];
            quizbox = document.getElementById("quizbox")
            // bar.onclick=function()
            // {

            //     if(quizbox.style.display=='none')
            //     {
            //         quizbox.style.display='flex';
            //         bar.children[0].children[0].setAttribute('class',"fa-solid fa-xmark fa-xl")
            //     }
            //     else
            //     {
            //     quizbox.style.display='none';
            //     bar.children[0].children[0].setAttribute('class',"fa-solid fa-bars fa-lg")
            //     }
            // }
            X.onclick = function () {
                searchBox.value = ""
                autolist.innerHTML = "";
                search.style.visibility = 'hidden'
            }
            show.onclick = function () {
                search.style.visibility = 'visible'
            }
            count = 1;
            res = [];
            searchBox.oninput = function () {
                autolist.innerHTML = '';
                val = searchBox.value
                if (count == 1) {
                    for (let x in items) {
                        res[x] = document.createElement("li")
                        res[x].textContent = items[x]
                        res[x].onclick = function () {
                            searchBox.value = res[x].textContent
                            autolist.innerHTML = ''
                            go.href="quizplay.php?cat="+res[x].textContent
                        }
                    }
                }
                for (let y in items) {
                    if (items[y].startsWith(val))
                        autolist.append(res[y])
                }
                count++
            }
        </script>

    </body>

    </html>
    <?php
} 
else if(!isset($_SESSION['user'])) {
    echo "<p>You have'nt logged into your account user.Hence You are not allowed to visit this page</p><br>";
    echo "<a href='userLogin.php'>Click Here to log in yourself</a>";
}
else
{
    echo "<p>You are not an authenticated user.Hence You are not allowed to visit this page</p><br>";
echo "<a href='signup.php'>Click Here to register yourself</a>";
}
    ?>