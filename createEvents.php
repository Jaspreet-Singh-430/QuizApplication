<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Dropdown Example</title>
    <style>
        td {
            text-align: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_GET['a'])) {
        $ser = $_GET['a'];
        $sel2 = "select Question from event inner join questions on Event_name=quiz_name AND event.category=questions.category where ser_no='$ser'";
        $quesdata = mysqli_query($conn, $sel2);

    }
    ?>
    <form action="events.php" method="post" id="quiz">
        </form>
        <input type="text" name="hid" hidden value="<?php echo @$_GET['a'];?>" form="quiz">
    <div class="container mt-5">
        <h1 class="text-center mb-4"><?php if (!isset($_GET['a']))
            echo "Create a New Event";
        else
            echo "Update contest"; ?></h1>
        <div class="mb-3">
            <label for="" class="form-label">Enter Contest name</label>
            <input type="text" class="form-control" form="quiz" name="qname" id="" <?php if(isset($_GET['a'])) echo "readonly";?> value="<?php echo @$_GET['b']; ?>"
                aria-describedby="helpId" placeholder="Quiz name" />

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Enter Date and Time</label>
            <input type="datetime-local" class="form-control" form="quiz" name="datetime" id=""
                aria-describedby="helpId" value="<?php echo @$_GET['c']; ?>"
                placeholder="Enter date and Time of contest" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Enter Time Limit</label>
            <input type="number" class="form-control" form="quiz" name="time" min="15" max="75" id="" step="15"
                aria-describedby="helpId" value="<?php echo @$_GET['d']; ?>" placeholder="Enter Time Duration" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Registration Fees</label>
            <input type="number" class="form-control" form="quiz" <?php if(isset($_GET['a'])) echo "readonly";?> name="fees" id="" 
                aria-describedby="helpId" value="<?php echo @$_GET['e']; ?>" placeholder="For e.g. 200" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Due Date</label>
            <input type="datetime-local" class="form-control" form="quiz" name="due" id="" 
                aria-describedby="helpId" value="<?php echo @$_GET['f']; ?>"  />
        </div>
        <table class="table table-responsive w-100">
    <?php if(!isset($_GET['a']))
            {
                ?>
            <tr>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Select Category
                        </button>
                        <select name='category' form='quiz' class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                            onchange="fun()">
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Music')
                                echo "selected"; ?>>Music
                            </option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Sports')
                                echo "selected"; ?>>Sports
                            </option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Film_and_TV')
                                echo "selected"; ?>>
                                Film_and_TV</option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Arts_and_Literature')
                                echo "selected"; ?>>Arts_and_Literature</option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'History')
                                echo "selected"; ?>>History
                            </option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Society_and_Culture')
                                echo "selected"; ?>>Society_and_Culture</option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Science')
                                echo "selected"; ?>>Science
                            </option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Geography')
                                echo "selected"; ?>>
                                Geography</option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Food_and_Drink')
                                echo "selected"; ?>>
                                Food_and_Drink</option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'General_Knowledge')
                                echo "selected"; ?>>
                                General_Knowledge</option>
                            <option class="dropdown-item" <?php if (@$_GET['e'] == 'Miscellaneous')
                                echo "selected"; ?>>
                                Miscellaneous</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Select Questions
                        </button>

                        <select name='questions[]' form='quiz' class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton" multiple>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Incorrect Options
                        </button>

                        <select name='options[]' form='quiz' class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton" multiple>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Correct Answers
                        </button>

                        <select name='correct[]' form='quiz' class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton" multiple>
                        </select>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
            <tr>
            <td colspan="4">
                <?php if(!isset($_GET['a']))
                {
                    ?>
                <button class="btn btn-primary" type='submit' form='quiz'>Create</button>
                <?php
                }
                ?>
                    <button class="btn btn-dark" type='submit' formaction='updateEvents.php' form='quiz'>Update</button>
                </td>
            </tr>
        </table>
        
        <?php
        if(@$_GET['succ']==1)
        echo "<script>alert('Contest has been created successfully.')</script>"
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function fun() {
            category = document.querySelectorAll(".dropdown-menu")[0].value
            res = fetch(`https://the-trivia-api.com/v2/questions?limit=50&categories=${category}`)
            res.then(response => {
                if (!response.ok)
                    throw new Error("error occured")
                else
                    return response.json()
            })
                .then(data => {
                    console.log(data)
                    document.querySelectorAll(".dropdown-menu")[1].innerHTML = ''
                    for (i = 0; i < 50; i++) {
                        opt = document.createElement('option')
                        opt.classList.add("dropdown-item")
                        if(i<9)
                        opt.textContent = "0"+(Number(i)+1)+'. '+data[i].question.text
                        else
                        opt.textContent = (Number(i)+1)+'. '+data[i].correctAnswer
                        document.querySelectorAll(".dropdown-menu")[1].append(opt)

                    }
                    document.querySelectorAll(".dropdown-menu")[2].innerHTML = ''
                    for (i = 0; i < 50; i++) {
                        opt = document.createElement('option')
                        opt.classList.add("dropdown-item")
                        if(i<9)
                        opt.textContent = "0"+(Number(i)+1)+'. '+data[i].incorrectAnswers
                        else
                        opt.textContent = (Number(i)+1)+'. '+data[i].correctAnswer
                        document.querySelectorAll(".dropdown-menu")[2].append(opt)

                    }
                    document.querySelectorAll(".dropdown-menu")[3].innerHTML = ''
                    for (i = 0; i < 50; i++) {
                        opt = document.createElement('option')
                        opt.classList.add("dropdown-item")
                        if(i<9)
                        opt.textContent = "0"+(Number(i)+1)+'. '+data[i].correctAnswer
                        else
                        opt.textContent = (Number(i)+1)+'. '+data[i].correctAnswer
                        document.querySelectorAll(".dropdown-menu")[3].append(opt)

                    }

                })
                .catch(error => console.log("problem with fetch operation"))
        }

    </script>
</body>

</html>