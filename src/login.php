<!DOCTYPE html>  
<head>
  <title>CrowdFund | Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
  <h2>Login to CrowdFund</h2>
  <ul>
    <form name="display" action="login.php" method="POST">
      <li>Email:</li>
      <li><input type="text" name="email" /></li>
	  <li>Password:</li>
	  <li><input type="password" name="psw"></li>
      <li><input type="submit" name="login" value="Login" /></li>
	</form>
  </ul>
  
  <ul>
    <form name="display" action="register.php" method="POST">
	  <li><input type="submit" name="register" value="Register Account" /> </li>
	  <li> <a href="forgotpass.php">Forgot Password?</a> </li>
    </form>
  </ul>
  <?php
    session_start();
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=eldon");	
    $result = pg_query($db, "SELECT * FROM users where passWord = '$_POST[psw]' AND email = '$_POST[email]'");
	$row    = pg_fetch_assoc($result);
     if (isset($_POST['login'])) {
		 if(!$row) {
            echo "Login failed. Invalid username or password";
        } else {
            $_SESSION['email'] = $row[email];
            header("Location: index.php"); /* Redirect browser */
            exit();
        }
	 }
    ?>  
</body>
</html>
