<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="volunteer">
    <meta name="keywords" content="volunteer">
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan, Sherlyn Kok, Michael Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
      rel="icon"
      href="images/love-you-gesture-svgrepo-com.svg"
      type="images/svg"
    >
    <link rel="stylesheet" href="styles/style.css" >
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    >
  <style>
    .user-body{
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 100px;
      background: var(--clr-primary);
    }
    .user-container {
      border: 2px solid var(--clr-accent);
      margin: 3% 0;
      padding: 35px 45px;
      max-width: 700px;
      background: var(--clr-primary);
      border-radius: 5px;
      animation: fadeInUp 1s ease-out;
      min-width:500px;
    }
    .user-container h1 {
      text-align: center;
    }
    .user-form .button {
      padding-top:2em;
    }
    .user-form .button input {
      height: 100%;
      width: 100%;
      outline: none;
      color: var(--clr-secondary);
      border: none;
      font-size: 14px;
      border-radius: 5px;
      letter-spacing: 1px;
      background: var(--clr-primary);
      border: 1px solid var(--clr-accent);
      transition: all 0.3s ease;
    }
    .user-form .button input:hover {
      cursor: pointer;
      color: var(--clr-primary);
      background: var(--clr-secondary);
    }
    .user_error{
      background: #F2DEDE;
      color: #A94442;
      padding-left:8px;
      width:90%;
      margin-bottom:1.1em;
    }
    #have_account{
      font-size:12px;
    }
  </style>
  </head>

  <body>
    <?php include "connection.php" ?>
    <header>
      <?php include "header.php" ?>
    </header>

    <?php if (!isset($_SESSION['login_user'])) { ?>
      <section class="user-body">
        <div class="user-container">
          <h1>REGISTER</h1>
          <?php
            if (isset($_GET['error']) && !empty($_GET['error'])) {
                echo "<p class='user_error'>".$_GET['error']."</p>";
            }
          ?>
          <form class="user-form" method="post" action="signup_process.php">
            <p><label for="userid">User ID</label></p>
            <p><input type="text" name="userID" maxlength="20" id="userid"></p>
            <p><label for="email_signup">Email</label></p>
            <p><input type="text" name="email" placeholder="abc@gmail.com"  id="email_signup"></p>
            <p><label for="password">Password</label></p>
            <p><input type="password" name="password"  id="password"></p>
            <p><label for="confirmpassword">Confirm Password</label></p>
            <p><input type="password" name="confirmpassword"  id="password_confirmation"></p>
            <p id="have_account">Already have an account? Click <a href="login.php">here</a> to login.</p>
            <div class="button">
              <input type="submit" value="Sign Up">
            </div>
          </form>
        </div>
      </section>
    <?php } else{ ?>
      <section class="user-body">
        <div class="user-container">
          <h1>You had already signed up</h1>
          <p>Press <a href="index.php">here</a> to go homepage.</p>
        </div>
      </section>
    <?php } ?>

    <footer>
      <?php include "footer.php"; ?>
    </footer>
  </body>
</html>
