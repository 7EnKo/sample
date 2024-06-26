<?php
    if (key_exists('btn-signin', $_POST)) {
        require_once 'my_sql_connect.php';
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = filter_var(trim($_POST['password']), FILTER_UNSAFE_RAW);
        $password = md5($password);
        $sql = 'SELECT `password` FROM `users` WHERE `email` = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$email]);
        $users = $query->fetch(PDO::FETCH_OBJ);
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sign in</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="img/php_icon.ico">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="form-signin w-100 m-auto h-100">
      <form method="post">
          <?php
            if (key_exists('btn-reg', $_POST)){
                echo "<div class='alert alert-success'>success</div>";
            }
            if (key_exists('btn-signin', $_POST))
            {
                if ($users)
                {
                    if ($users->password == $password)
                    {
                        if (key_exists('check', $_POST)){
                            setcookie('email', $email, time() + 3600 * 24 * 30);
                            setcookie('password', $password, time() + 3600 * 24 * 30);
                        }
                        else
                        {
                            if ((key_exists('email', $_COOKIE)) && key_exists('password', $_COOKIE))
                            {
                                setcookie('email', $email, time() - 3600 * 24 * 30);
                                setcookie('password', $email, time() - 3600 * 24 * 30);
                            }
                        };
                        header('Location: main.php');
                        exit();
                    }
                    else
                    {
                        echo "<div class='alert alert-danger'>Incorrect password</div>";
                    }

                }
                else
                {
                    echo "<div class='alert alert-danger'>this email does not exist</div>";
                }

            }
            else
            {
                echo "<div class='alert invisible'>Incorrect password</div></div>";
            }
             ?>
    <!--    <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
        <h1 class="h3 mb-3 fw-normal ">Please sign in</h1>

        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value=
          <?php
          if (key_exists('email', $_COOKIE))
          {
              echo $_COOKIE['email'];
          }
          else
          {
              echo '';
          }
          ?>
          >
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">Password</label>
        </div>

        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" value=1 id="flexCheckDefault" name="check">
          <label class="form-check-label" for="flexCheckDefault">
            Remember me
          </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit" name="btn-signin" id="btn-signin">Sign in</button>

    <a class="btn btn-primary w-100 py-2 mt-1 " type="submit" href='reg.php'>Registration</a>
      </form>

</main>
</body>
</html>
