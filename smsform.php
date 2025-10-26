<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <div class="container mt-3">
    <h2>Stacked form</h2>
    <form action="sendsms.php" method="post">
      <div class="mb-3 mt-3">
        <label for="email">Sender:</label>
        <input type="text" class="form-control" id="email" placeholder="Enter username" name="email">
      </div>
      <div class="mb-3">
        <label for="hash">Hash key:</label>
        <input type='text' class="form-control" id="hash" placeholder="Enter hash key" name="hash">
      </div>

      <div class="mb-3">
        <label for="recipient">To:</label>
        <input type='text' class="form-control" id="recipient" placeholder="Enter recipient " name="recipient">
      </div>
      <div class="mb-3">
        <label for="phn">Phone:</label>
        <input type='number' class="form-control" id="phn" placeholder="Enter number " name="phn">
      </div>
      <div class="mb-3">
        <label for="mess">Message:</label>
        <textarea type='text' class="form-control" id="mess" name="mess"></textarea>
      </div>
      <button name='sub' type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>

</html>