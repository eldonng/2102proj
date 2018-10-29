<!DOCTYPE html>
<head>
  <title>CrowdFund | Forgot Password</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!DOCTYPE html>
<head>
  <title>CrowdFund | Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <!-- <link rel="stylesheet" href="style.css"> -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="formstyle.css">
  
</head>
<body>
</head>
<body>
<header>
    <nav>
    <ul>
      <li><a href="index.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
      <li><a href="register.php"><i class="fas fa-plus"></i> Sign Up</a></li>
    </ul>
  </nav>
  </header>
  <form class = "form-container" name="reset" action="forgotpass.php" method="POST" >
      <div class ="form-title"><h2> Reset Password</h2></div>
      <div class="form-title">Email: </div>
      <input class="form-field" type="text" name="email" />
      <div class="form-title">Enter New Password: </div>
      <input class="form-field" type="password") name="psw" />
      <div class="submit-container">
      <input class ="submit-button" type="submit" name="resetpw" value="Reset Password" />
      </div>
    </form>

  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=projectdemo user=postgres password=eldon");
    if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }

    if (isset($_POST['resetpw'])) {
      if($_POST[psw] == null || $_POST[email] == null) {
        echo '<script language="javascript">';
        echo 'alert("Please do not leave any fields empty")';
        echo '</script>';
      } else {
        $result = pg_query($db, "SELECT * FROM users WHERE email = '$_POST[email]'");		// Query template
        $row    = pg_fetch_assoc($result);		// To store the result row
		    if(!$row) {
          echo '<script language="javascript">';
          echo 'alert("The email does not exist in database")';
          echo '</script>';
	    	} else {
          $hashpw = hash('sha256', hash('sha256', $_POST[email]).$_POST[psw]);
          $reset = pg_query($db, "UPDATE users SET password = '$hashpw' WHERE email = '$_POST[email]'");
          echo '<script language="javascript">';
          echo 'alert("Password Reset Successfully")';
          echo '</script>';
        }
      }
  }
    ?>


</body>
</html>
