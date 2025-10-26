<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Toggle Button - Quiz Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="">Settings</h1><br>
        <form>
            <div class="mb-3">
                <label for="correct" class="form-label">Score Value for Correct option</label>
                <input type="number" class="form-control" id="correct" value="4" min="3" max="6">
            </div>
            <div class="form-check form-switch mb-3">
                <input id='check' class="form-check-input" type="checkbox" onchange="changed()" checked>
                <label class="form-check-label" for="check">Enable Negative marking</label>
            </div>
            <div class="mb-3">
                <label for="example" class="form-label">Negative Marking (in percentage)</label>
                <input type="number" class="form-control" id="example" value="25" min="20" max="40" step="5">
            </div>

            <!-- Toggle Switch -->
            

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changed()
        {
            if(check.checked==false)
            example.disabled=true;
            else
            example.disabled=false;
        } 
        
    </script>
</body>
</html>
