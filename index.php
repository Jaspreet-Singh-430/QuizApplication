<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0px;
        }

        .spin_holder {
            padding-block: 6.8%;
        }

        @keyframes logo {
            0% {
                height: 0px;
            }

            100% {
                height: 200px;
            }
        }

        #quiz {
            animation-name: logo;
            animation-duration: 1s;
            animation-fill-mode: forwards;
        }

        body {
            background-image: url('./images/back.webp');
            background-blend-mode: difference;
        }

        .carousel {
            margin-top: 2%;
        }

        ul {
            list-style-type: none;
        }
    </style>
</head>

<body>
    <div class="spin_holder text-center text-white">
        <img src="./images/quiz.webp" id="quiz" alt="" height=0px width=200px class="rounded-circle">
        <p class="display-6"><b>Loading</b> <span class="spinner-grow spinner-grow-sm text-danger"></span> <span
                class="spinner-grow spinner-grow-sm text-warning"></span> <span
                class="spinner-grow spinner-grow-sm text-success"></span></p>
        <span class="spinner-border mt-2" style="height:4rem;width:4rem;" id='spin'></span>
        <p class="mt-3 "><b>Your application is being loaded.Please wait for a few seconds</b></p>
    </div>
    <script>
        count = 0
        const arr = ['text-primary', 'text-danger', 'text-warning', 'text-success'];
        window.onload = function () {
            timer = setInterval(() => {
                spin = document.getElementById("spin");
                if (spin.classList.length > 2) {
                    console.log(spin.classList.length)
                    rem = spin.classList.item(2);
                    console.log(rem)
                    spin.classList.remove(rem)
                }
                spin.classList.add(arr[count % 4]);
                count++;
            }, 500);
        }
        setTimeout(() => {
            clearInterval(timer)
            location.href = 'signup.php'
        }, 7000);
    </script>

</body>

</html>