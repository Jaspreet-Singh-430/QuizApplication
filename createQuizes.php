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
    <form action="quizzes.php" method="post" id="quiz"></form>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create a Quiz</h1>
        <div class="mb-3">
            <label for="" class="form-label">Enter quiz name</label>
            <input type="text" class="form-control" form="quiz" name="qname" id="" aria-describedby="helpId"
                placeholder="Quiz name" />

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Enter Time Limit</label>
            <input type="number" class="form-control" form="quiz" name="time" min="15" max="60" id=""
                aria-describedby="helpId" placeholder="Enter Time Duration" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Enter Time Slice</label>
            <input type="number" class="form-control" form="quiz" min="10" max="60" name="time_slice" id=""
                aria-describedby="helpId" placeholder="Enter Time Slice" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Enter no of lives</label>
            <input type="number" class="form-control" form="quiz" name="lives" min="2" max="5" id=""
                aria-describedby="helpId" placeholder="Enter no. of Lives" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Enter no of questions</label>
            <input type="number" class="form-control" form="quiz" name="questions" min="10" max="50" id=""
                aria-describedby="helpId" placeholder="Enter no. of questions" />
        </div>
        <table class="table table-bordered table-responsive w-100">
            <tr>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Select Category
                        </button>
                        <select name='category' form='quiz' class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                            onchange="fun()">
                            <option class="dropdown-item">Music</option>
                            <option class="dropdown-item">Sports</option>
                            <option class="dropdown-item">Film_and_TV</option>
                            <option class="dropdown-item">Arts_and_Literature</option>
                            <option class="dropdown-item">History</option>
                            <option class="dropdown-item">Society_and_Culture</option>
                            <option class="dropdown-item">Science</option>
                            <option class="dropdown-item">Geography</option>
                            <option class="dropdown-item">Food_and_Drink</option>
                            <option class="dropdown-item">General_Knowledge</option>
                            <option class="dropdown-item">Miscellaneous</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Select Difficulty Level
                        </button>
                        <select name='level' form='quiz' class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                            onchange="fun()">
                            <option class='dropdown-item'>all</option>
                            <option class="dropdown-item">easy</option>
                            <option class="dropdown-item">medium</option>
                            <option class="dropdown-item">hard</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><button class="btn btn-primary" type='submit' form='quiz'>Create</button></td>
            </tr>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function fun() {
            category = document.querySelectorAll(".dropdown-menu")[0].value
            level = document.querySelectorAll(".dropdown-menu")[1].value
            console.log(level)
            if (level == 'all')
                res = fetch(`https://the-trivia-api.com/v2/questions?limit=50&categories=${category}`)
            else
                res = fetch(`https://the-trivia-api.com/v2/questions?limit=50&categories=${category}&difficulties=${level}`)
            res.then(response => {
                if (!response.ok)
                    throw new Error("error occured")
                else
                    return response.json()
            })
                .then(data => {
                    console.log(data)   
                })
                .catch(error => console.log("problem with fetch operation"))
        }

    </script>
</body>

</html>