<?php
    if (key_exists('btn-reg', $_POST))
    {
            require_once 'my_sql_connect.php';
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = filter_var(trim($_POST['password']), FILTER_UNSAFE_RAW);
            function valid_pass($password)
            {
                $pattern = '/[A-Za-z0-9]{8,}/';
                if (preg_match($pattern, $password))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }

            if ($email && valid_pass($password))
            {
                 $sql = 'INSERT INTO users(email, password) VALUES (?, ?)';
                 $query = $pdo -> prepare($sql);
                 $query -> execute([$email, md5($password)]);
                 $_SESSION['btn-reg'] = 1;
                 header('Location: index.php');
            }
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="img/php_icon.ico">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="form-signin w-100 m-auto h-100">
      <form method="post">
          <?php

          if (key_exists('btn-reg', $_POST))
          {
              if (!($email and valid_pass($password))) {
                  echo "<div class='alert alert-danger'>Try again</div>";
              }
              else
              {
                  echo "<div class='alert alert-danger'>Incorrect password</div></div>";
              }
          }
          else
          {
              echo "<div class='alert invisible'>Incorrect password</div></div>";
          }

          ?>
    <!--    <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
        <h1 class="h3 mb-3 fw-normal ">Please register</h1>

        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
          <label for="floatingInpuневерный парольt">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">Password</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit" name="btn-reg" value=1>Register</button>

      </form>
</main>
</body>
</html>
