<!DOCTYPE html>
<head>
  <title>CrowdFund | Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<header>
<form method = "POST" action = "index.php">
      <div class='rg-container'>
        <table class='rg-table' summary='CrowdFund'>
          <caption class='rg-header'>
            <span class='rg-hed'>
              <a class='title' href="home.php">CrowdFund</a>
          </caption>
          <thead>
            <tr>
              <th id = "login"> Login <i class="fas fa-sign-in-alt"></i></th>
            </tr>
          </thead>
            <tbody>
              <tr id = "projectForm">
                <td> Email: </td>
                <td><input class = "form-field" type = "text" name = "email" </td>
              </tr>
              <tr id = "projectForm">
                <td> Password: </td>
                <td><input class = "form-field" type = "password" name = "psw" </td>
              </tr>
              <tr id = "projectForm">
                <td></td>
              <td><input class = "submit-button" type = "submit" name = "login" value="Login"></td>
              <tr id = "projectForm">
                <td></td>
              <td><a href="register.php">Sign Up |</a>
              <a href="forgotpass.php">Forgot Password?</a></td>
          </tr>
              </tbody>
        </table>
      </div>
    </form>
  <?php
    session_start();
    $_SESSION['dblogin'] = "host=localhost port=5432 dbname=postgres user=postgres password=password";
    if($_SESSION['email'] != null) {
      header("Location: home.php"); /* Redirect browser */
    }
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect($_SESSION['dblogin']);
      if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }
    if (isset($_POST['login'])) {
      $hashpw = hash('sha256', hash('sha256', $_POST[email]).$_POST[psw]);
      $result = pg_query($db, "SELECT email FROM users where password = '$hashpw' AND email = '$_POST[email]'");
	    $row = pg_fetch_assoc($result);
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
