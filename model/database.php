<?php
    //local development server connection
    //$dsn = 'mysql:host=zy4wtsaw3sjejnud.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=d8rpc0dlpq3dbh60';
    // $username = 'rw7h2x7l315420tj';
    //   $password = 'lpvp38jrofs9or11';

    // Heroku connection
    
    $dsn = 'mysql:host=zy4wtsaw3sjejnud.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=d8rpc0dlpq3dbh60';
    $username = 'rw7h2x7l315420tj';
    $password = 'lpvp38jrofs9or11';

    try {
        //local development server connection
        //if using a $password, add it as 3rd parameter
        //$db = new PDO($dsn, $username);

        // Heroku connection
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>
