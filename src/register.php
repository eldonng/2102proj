<!DOCTYPE html>
<head>
  <title>CrowdFund | Create New Account</title>
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
<form method = "POST" action = "register.php">
      <div class='rg-container'>
        <table class='rg-table' summary='CrowdFund'>
          <caption class='rg-header'>
            <span class='rg-hed'>
              <a class='title' href="home.php">CrowdFund</a>
          </caption>
          </span>
          <thead>
            <tr>
              <th id = "reset"> Create New Account <i class="fas fa-plus"></i></th>
            </tr>
          </thead>
            <tbody>
            <tr id = "projectForm">
                <td> First Name: </td>
                <td><input class = "form-field" type = "text" name = "firstname"> </td>
              </tr>
              <tr id = "projectForm">
                <td> Last Name: </td>
                <td><input class = "form-field" type = "text" name = "lastname"> </td>
              </tr>
              <tr id = "projectForm">
                <td> Email Address: </td>
                <td><input class = "form-field" type = "text" name = "email"> </td>
              </tr>
              <tr id = "projectForm">
                <td> Password: </td>
                <td><input class = "form-field" type = "password" name = "password"> </td>
              </tr>
              <tr id = "projectForm">
                <td></td>
              <td><input class = "submit-button" type = "submit" name = "create" value="Create Account"></td>
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
    if (isset($_POST['create'])) {
      if($_POST[email] == null || $_POST[password] == null || $_POST[firstname] == null || $_POST[lastname] == null) {
        echo '<script language="javascript">';
        echo 'alert("Please do not leave any fields empty")';
        echo '</script>';
      } else {
        $hashpw = hash('sha256', hash('sha256', $_POST[email]).$_POST[password]);
		    $query = "INSERT INTO users VALUES('$_POST[email]', '$hashpw', '$_POST[firstname]', '$_POST[lastname]')";
		    $result    = pg_query($db, $query);		// To store the result row
		    if($result) {
          echo '<script language="javascript">';
          echo 'alert("Account Created Successfully")';
          echo '</script>';
          echo '<a href="index.php"><u> Back to Login Page </u></a>';
		    } else {
          echo '<script language="javascript">';
          echo 'alert("Unable to add user into database, or user already exists")';
          echo '</script>';
          echo 'Existing user? <a href="forgotpass.php"><u> Reset your password here </u></a>';
        }
      }
    }
	?>
</body>
</html>
