<?php
    if(isset($_SESSION['firstname'])){
        $firstname = $_SESSION['firstname'];
    }
?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zippy Used Autos</title>
    <link rel="stylesheet" type="text/css" href="view/css/main.css" />
</head>

<!-- the body section -->
<body>
    <header>
    <h1>Zippy Used Autos</h1>
    </header>
   
   <h1>Thank you for signing out, <?php echo $firstname; ?>!</h1>
   <p><a href=".">Click Here</a> to view our vehicle list</p>

   <?php include 'view/footer.php' ?>