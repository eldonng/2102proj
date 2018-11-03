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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>
<body>
</head>
<body>
<form method = "POST" action = "forgotpass.php">
      <div class='rg-container'>
        <table class='rg-table' summary='CrowdFund'>
          <caption class='rg-header'>
            <span class='rg-hed'>
              <a class='title' href="home.php">CrowdFund</a>
          </caption>
          </span>
          <thead>
            <tr>
              <th id = "reset"> Reset Password </th>
            </tr>
          </thead>
            <tbody>
              <tr id = "projectForm">
                <td> Email: </td>
                <td><input class = "form-field" type = "text" name = "email"> </td>
              </tr>
              <tr id = "projectForm">
                <td> Enter New Password: </td>
                <td><input class = "form-field" type = "password" name = "psw"> </td>
              </tr>
              <tr id = "projectForm">
                <td></td>
              <td><input class = "submit-button" type = "submit" name = "resetpw" value="Reset Password"></td>
              <tr id = "projectForm">
                <td></td>
          </tr>
              </tbody>
        </table>
      </div>
    </form>

  <?php
    session_start();
    if($_SESSION['email'] != null) {
      header("Location: home.php"); /* Redirect browser */
    }
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect($_SESSION['dblogin']);
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
          echo '<a href="register.php"><u>Click here to Sign Up </u></a>';
	    	} else {
          $hashpw = hash('sha256', hash('sha256', $_POST[email]).$_POST[psw]);
          $reset = pg_query($db, "UPDATE users SET password = '$hashpw' WHERE email = '$_POST[email]'");
          echo '<script language="javascript">';
          echo 'alert("Password Reset Successfully")';
          echo '</script>';
          echo '<a href="index.php"><u>Back to Login Page</u></a>';
        }
      }
  }
    ?>


</body>
</html>
