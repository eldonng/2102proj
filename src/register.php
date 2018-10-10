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
    <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <style media="screen">
    
     nav{
      background-color: black;
    }

    nav ul{
      margin:0;
      list-style-type: none;
      text-align: center;
      text-color: white;
    }

    nav ul li{
      display: inline-block;
      text-align: center;
      padding: 20px;
      height: 2%;
      text-color: white;
    }

    nav ul li a{
      text-decoration: none;
      color: white;
      padding: 20px;
    }
    nav ul li a:hover, nav ul li a:active{
      border-bottom: 2px solid #ccc;
      padding-bottom: 8px;
      border: 1px solid #447314;
      text-shadow: #31540c 0 1px 0;
      background: #6aa436;
      background-image: -ms-linear-gradient(top, #8dc059 0%, #6aa436 100%);
      color: #fff;
    }
    .form-container {
    background: white;
    text-decoration: none;
    text-align: center;


     }
  .form-field {
     border: 2px solid #c9b7a2;
     background: white;
     color: black  ;
     padding:8px;
     width:280px;
     }
  .form-fieldLong {
    border: 2px solid #c9b7a2;
    background: white;
    color: black;
    padding:8px;
    width:280px;
    height: 70px;
    }

  .form-field:focus {
     background: #fff;
     border-color: #6CBEEC;
     color: black;
     }
  .form-fieldLong:focus {
    background: #fff;
    border-color: #6CBEEC;
    color: black;
    }
  .form-container h2 {
     font-size:18px;
     font-weight:bold;
     text-align:center;
      }
  .form-title {
     margin-bottom:10px;
     color: black ;
     }
  .submit-container {
     }
  .submit-button {
     border: 1px solid white;
     background: black;
     color: white;
     padding: 8.5px 18px;
     font-size: 14px;
     text-decoration: none;
     vertical-align: middle;
     width: 300px;
     }
  .submit-button:hover {
     border: 1px solid #447314;
     text-shadow: #31540c 0 1px 0;
     background: #6aa436;
     background-image: -ms-linear-gradient(top, #8dc059 0%, #6aa436 100%);
     color: #fff;
     }
  .submit-button:active {
     text-shadow: #31540c 0 1px 0;
     border: 1px solid #447314;
     background: #8dc059;
     background-image: -ms-linear-gradient(top, #6aa436 0%, #8dc059 100%);
     color: #fff;
     }

  </style>
</head>
<body>
<header>
    <nav>
    <ul>
      <li><a href="index.php"><i class="fas fa-home"></i> Login</a></li>
      <li><a href="forgotpass.php"><i class="fas forgot-pass"></i> Forgot Password</a></li>
    </ul>
  </nav>
  </header>
	<form class = "form-container" name="signup" action="register.php" method="POST" >
      <div class ="form-title"><h2> Create an Account</h2></div>
      <div class="form-title">First Name: </div>
      <input class="form-field" type="text" name="firstname" />
      <div class="form-title">Last Name: </div>
      <input class="form-field" type="text" name="lastname" />
      <div class="form-title">Email Address: </div>
      <input class="form-field" type="text" name="email" />
      <div class="form-title">Password: </div>
      <input class="form-field" type="password)" name="password" />
      <div class="submit-container">
      <input class ="submit-button" type="submit" name="create" value="Create Account" />
      </div>
    </form>
  
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=projectdemo user=postgres password=eldon");
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
		    $query = "INSERT INTO users VALUES('$_POST[email]', '$_POST[password]', '$_POST[firstname]', '$_POST[lastname]')";
		    $result    = pg_query($db, $query);		// To store the result row
		    if($result) {
          echo '<script language="javascript">';
          echo 'alert("Account Created Successfully")';
          echo '</script>';
		    } else {
          echo '<script language="javascript">';
          echo 'alert("Unable to add user into database, or user already exists")';
          echo '</script>';
        }
      }
    }
	?>  
</body>
</html>