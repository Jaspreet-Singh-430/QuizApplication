<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Instructions</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="p-3 fs-3 text-white" style="background:purple;"><i class="fa-solid fa-person-chalkboard"></i><b>&nbsp;&nbsp;Instruction Guide</b></nav>
    <div class="container" style="padding:3%;">

        <header>
            <h1 class="text-primary">Quiz Instructions</h1><br>
        </header>
        
        <section class="instructions"  >
            <h2 class="text-bg-warning p-2">Before You Begin</h2>
            <p>Welcome to the quiz! Please read the following instructions carefully before starting the quiz:</p>
            <ul>
                <li>Each question is multiple choice.</li>
                <li>You have <strong>fixed time limit</strong> to complete the quiz in Time Duration Mode.</li>
                <li>You have <strong>limited number of lives</strong> to complete the quiz in Survival Challenge Mode.</li>
                <li>Make sure to answer the questions correctly. Unanswered questions will be result in no credit. Wrong answers deduct your score by 25% of the score value.</li>
                <li>You cannot go back to previous questions in Time Attack mode, so answer carefully.</li>
                <li>Once you submit your answers, you will receive your score immediately.</li>
            </ul>
        </section>

        <section class="rules">
            <h2 class="text-bg-danger p-2">Rules</h2>
            <ul>
                <li>No cheating. Please do not use any external resources.</li>
                <li>Do not refresh the page during the quiz as this may result in losing your progress.</li>
                <li>Ensure your internet connection is stable to avoid disruptions.</li>
            </ul>
        </section>
        <br>
        <section class="text-center">
            <a href="dashboard.php" class="btn btn-primary">Back to dashboard</a>
        </section>
    </div>

    <script>
        function startQuiz() {
            // Redirect to the quiz page
            window.location.href = "quiz.html";
        }
    </script>
</body>
</html>
