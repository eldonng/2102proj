<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - Records</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
    session_start();
    // Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect($_SESSION['dblogin']);
        if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }

    $query = "SELECT title, amountfund FROM project_advertised GROUP BY title, amountfund HAVING amountfund >= ALL (SELECT amountfund
            FROM project_advertised)";
    $result = pg_query($db, $query);
    $row = pg_fetch_assoc($result);
    if (!$result) {
      echo "most successful project query failed";
    }

    $query1 = "SELECT u.firstname, u.lastname, COUNT(*) as numproj FROM users u, fund f WHERE u.email = f.uemail GROUP BY u.firstname, u.lastname HAVING COUNT(*)
            >= ALL (SELECT COUNT(*) as numproj FROM users u, fund f WHERE u.email = f.uemail GROUP BY u.firstname, u.lastname);";
    $result1 = pg_query($db, $query1);
    $row1 = pg_fetch_assoc($result1);
    if (!$result1) {
      echo "Most projects contributed Query failed";
    }

    $query2 = "SELECT u.firstname, u.lastname, f.amountfunded FROM users u, fund f WHERE u.email = f.uemail GROUP BY u.firstname, u.lastname, f.amountfunded
    HAVING f.amountfunded >= ALL (SELECT f.amountfunded FROM fund f)";
    $result2 = pg_query($db, $query2);
    $row2 = pg_fetch_assoc($result2);
    if (!$result2) {
      echo "Highest Contributor Query failed";
    }

    $query3 = "SELECT SUM(amountfund) as amount FROM project_advertised";
    $result3 = pg_query($db, $query3);
    $row3 = pg_fetch_assoc($result3);
    if (!$result3) {
      echo "Total funds Query failed";
    }

    $query4 = "SELECT COUNT(*) as projects FROM project_advertised";
    $result4 = pg_query($db, $query4);
    $row4 = pg_fetch_assoc($result4);
    if (!$result4) {
      echo "Num Projects Query failed";
    }
?>
<div class='rg-container'>
    <table class='rg-table' summary='CrowdFund'>
        <caption class='rg-header'>
        <span class='rg-hed'>
            <a class='title' href="home.php">CrowdFund</a>
        </span>
        </caption>
        <thead>
        <tr>
            <th id = "records"> <h2>Records on CrowdFund</h2> </th>
        </tr>
        </thead>
        <tbody>
            <tr id = "projectForm">
            <td> Most Successful Project:
            <?php
                echo "<tr><td class='form-field'><strong>".$row['title']."</strong>, with a total funding of <strong>$".$row['amountfund']."</strong></td></tr>";
                ?></td>
            </tr>
            <tr id = "projectForm">
            <td> Most Projects Contributed:
            <?php
                    echo "<tr><td class='form-field'><strong> ".$row1['firstname']." ".$row1['lastname']."</strong>, contributing to <strong>".$row1['numproj']."</strong> projects</td></tr>";
            ?> </td>
            </tr>
            <tr id = "projectForm">
            <td> Highest Contributed Amount:
            <?php
                echo "<tr><td class='form-field'><strong> ".$row2['firstname']." ".$row2['lastname']."</strong>, contributed <strong>$".$row2['amountfunded']."</strong> </td></tr>";
            ?> </td>
            </tr>
            <tr id = "projectForm">
            <td>
            <?php
                echo "Total funds contributed on CrowdFund: <strong>$".$row3['amount']."</td></tr>";
            ?> </td>
            </tr>
            <tr id = "projectForm">
            <td>
            <?php
                echo "Number of Projects on CrowdFund: <strong>".$row4['projects']."</strong></td></tr>";
            ?> </td>
            </tr>
            </tbody>
    </table>
</div>
</body>
</html>
