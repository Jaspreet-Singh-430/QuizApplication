<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="C:/Users/Jassi Yamunanagar/Downloads/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="./jquery/dist/jquery.min.js"></script>
    <style>
        h1 {
            height: 250px;
        }

        .lev {
            font-size: 50px;
        }
        .imga {
            width:200px;
        }
        @media screen and (max-width:768px) {
            .imga {
                width: 80px;
                height: 120px;
            }

        }

        @media screen and (max-width:768px) {
            h1 {
                height:210px;
            }
            .lev {
                font-size: 35px;
            }

        }
    </style>
    <script>
        $(document).ready(function () {
            $(".level").on({
                'mouseover': function () {
                    $(this).css('border', '5px solid blue');
                },
                'mouseout': function () {
                    $(this).css("border", "none");
                }
            })
        })
    </script>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid px-0">
        <h1 class=" mb-3 bg-primary text-white p-3 rounded-4 row lev"><span style="font-weight:bolder;float:left;"
                class="my-1 col-4 lev">Choose Difficulty
                Level</span>
            <span class="col-8">
                <img src="./images/test2.png" alt="" style="float:right;"
                    class="imga rounded-circle img-fluid">
                <img src="./images/test3.png" alt="" style="float:right;"
                    class="rounded-circle me-4 img-fluid imga">
            </span>
        </h1>
        <img src="./images/difficulty.webp" alt="" style="width:300px;height:180px;display:block;margin:auto;"><br>
        <div class='row justify-content-evenly'>
            <div class="col-3">
                <a href="easy.php?cat=<?php echo @$_GET['cat']; ?>&level=easy" data-toggle="tooltip"
                    data-placement="bottom" title="abc"><img src="./images/easy.png" class="img-fluid level rounded-5"
                        alt=""></a>
            </div>
            <div class="col-3 ">
                <a href="easy.php?cat=<?php echo @$_GET['cat']; ?>&level=medium" data-toggle="tooltip"
                    data-placement="bottom" title="abc"><img src="./images/medium.png" class="img-fluid level rounded-5"
                        alt=""></a>
            </div>
            <div class="col-3 ">
                <a href="easy.php?cat=<?php echo @$_GET['cat']; ?>&level=hard" data-toggle="tooltip"
                    data-placement="bottom" title="abc"><img src="./images/hard.png" class="img-fluid level rounded-5"
                        alt=""></a>
            </div>
        </div>
    </div>
</body>

</html>