<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CrowdFund | My Projects</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();
if($_SESSION['email'] != null) {
  $user = $_SESSION['email'];
}  else {
  header("Location: index.php"); /* Redirect browser */
}
$db = pg_connect($_SESSION['dblogin']);
   if (!$db) {
    echo "An error occured when connecting to DB.\n";
    exit;
  }
  $user = $_SESSION['email'];
  $queryAdmin = "SELECT email, firstname FROM users where admin = false AND email = '$user';";
  $result = pg_query($db, $queryAdmin);
  $query = pg_query($db, "SELECT title, (amountfund*100/targetamount) as pctamount, targetamount, projectid, enddate FROM project_advertised");
?>

<body>
  <div class='rg-container'>
    <table class='rg-table' summary='CrowdFund'>
      <caption class='rg-header'>
        <span class='rg-hed'>
          <a class='title' href="home.php">CrowdFund</a>
          <?php
            echo ("<div class='userProfile'>Logged in as: ".$user."</div>")
          ?>
        </span>
        <span class='rg-dek'>
        <div class='user-bar'>
          <a href="profile.php">Profile |</a>
          <a href="logout.php">Logout</a>
        </div>
      </span>
      <thead>
        <tr>
          <th class='text '>Project Title</th>
          <th class=' '>% Funded</th>
          <th class=' '>Target</th>
          <th class=' '>End Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while ($row = pg_fetch_array($query)) {
            $projectid = $row['projectid'];
            echo "<tr>";
            echo "<td class='text ' data-title='Project Title'><a href=\"viewproject.php?projectid=".$row['projectid']."\">".$row['title']."</a></td>";
            if ($row['pctamount'] >= 100){
              echo "<td class='text' data-title='% Funded'><progress class=\"progress is-funded show-value\" value=\"".$row['pctamount']."\" max=\"100\"></progress>
              </td>";
            } else if ($row['pctamount'] >= 65){
              echo "<td class='text' data-title='% Funded'><progress class=\"progress is-approaching show-value\" value=\"".$row['pctamount']."\" max=\"100\"></progress>
              </td>";
            } else {
              echo "<td class='text' data-title='% Funded'><progress class=\"progress is-starting show-value\" value=\"".$row['pctamount']."\" max=\"100\">90%</progress>
              </td>";
            }
              echo "<td class='text' data-title='Target'>$".$row['targetamount']."</td>";
              echo "<td class='text' data-title='End Date'>".$row['enddate']."</td>";
              echo "<td class='text project.action' data-title='Project Title'><a href=\"editproject.php?projectid=".$row['projectid']."\">
                <button type='button' class='modifyButton'>Modify</button></a>
                </td>";
              echo "</tr>";
          }

          ?>

      </tbody>
    </table>
  </div>
</body>

</html>
