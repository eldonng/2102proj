<!DOCTYPE html>  
<head>
  <title>CrowdFund | Dashboard</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
<h1>CrowdFund</h1>
<?php 
    session_start();
    $user = $_SESSION['email'];
    $db     = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=eldon");	
    $result = pg_query($db, "SELECT name FROM users where email = '$user'");
	$row    = pg_fetch_assoc($result);
    echo "<ul><h2> Welcome Back, $row[name]</h2><ul> "; 
?>
</body>
</html>