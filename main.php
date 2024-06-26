<?php
    require_once 'my_sql_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>main</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="img/php_icon.ico">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <?php

        $api_address = "https://catfact.ninja/fact";
        $json_border = file_get_contents($api_address);
        if ($json_border != NULL)
        {
            $border_obj = json_decode($json_border,true);
        }
        else
        {
            $border_obj = array("FATAL", "API is not responding");
        }

        $border_obj = json_decode($json_border,true);
        echo '<h4>' . $border_obj['fact'] . '<h4>';

    ?>
    <form method="post">
        <button class="btn btn-danger m-5" name="btn-exit" type="submi">
            log out
        </button>
    </form >
    <?php
        if(key_exists('btn-exit', $_POST))
        {
                setcookie('email', $email, time() - 3600 * 24 * 30);
                setcookie('password', $password, time() - 3600 * 24 * 30);

            header('Location: index.php');
        }

    ?> ?php>
</main>
</body>
</html>
