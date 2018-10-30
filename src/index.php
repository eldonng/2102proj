<!DOCTYPE html>
<head>
  <title>CrowdFund | Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="formstyle.css">

</head>
<body>
<header>
    <nav>
    <ul>
      <li><a href="register.php"><i class="fas fa-plus"></i> Sign Up</a></li>
      <li><a href="forgotpass.php"><i class="fas fa-question"></i> Forgot Password</a></li>
    </ul>
  </nav>
  </header>
  <form class = "form-container" name="login" action="index.php" method="POST" >
      <div class ="form-title"><h2> Login to CrowdFund</h2></div>
      <div class="form-title">Email: </div>
      <input class="form-field" type="text" name="email" />
      <div class="form-title">Password: </div>
      <input class="form-field" type="password") name="psw" />
      <div class="submit-container">
      <input class ="submit-button" type="submit" name="login" value="Login"/>
      </div>
    </form>
  <?php
    session_start();
    if($_SESSION['email'] != null) {
      header("Location: home.php"); /* Redirect browser */
    }
    $hashpw = hash('sha256', hash('sha256', $_POST[email]).$_POST[psw]);
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=password");
        if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }
    $result = pg_query($db, "SELECT email FROM users where password = '$hashpw' AND email = '$_POST[email]'");
	$row    = pg_fetch_assoc($result);
     if (isset($_POST['login'])) {
		  if(!$row) {
        echo '<script language="javascript">';
        echo 'alert("Incorrect Email or Password")';
        echo '</script>';
      } else {
        $_SESSION['email'] = $row[email];
        header("Location: home.php"); /* Redirect browser */
        exit();
      }
	 }
    ?>
</body>
</html>
