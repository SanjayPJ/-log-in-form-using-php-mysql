<?php 

session_start();

include '../functions.php';

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">

    <title>Profile - <?php echo $_SESSION['loggedUser']; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <style>
        body {
            font-family: 'Muli', sans-serif;
        }

        .form-container {
            margin-top: 100px;
            width: 40%;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid #EEE;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php 
        alertCreator("<b>Hello " . $_SESSION['loggedUser'] . "!</b><br> Your email id is " . $_SESSION['loggedEmail'] . '.');
        ?>
        <a class="btn btn-warning w-100" href="logOut.php">Log out</a>
    </div>

</body>

</html>