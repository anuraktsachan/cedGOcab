
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="scriptCED.js"></script>
    <link rel="stylesheet" href="styleCEDCAB.css">
</head>

<body>
    <ul>
        <li><a class="primary" href="#">ced<span>GO</span>cab</a></li>
        <li><a href="adminDashboard.php">HOME</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">RIDES</a>
            <div class="dropdown-content">
                <a href="cabRequests.php">PENDING RIDES</a>
                <a href="completedRides.php">COMPLETED RIDES</a>
                <a href="cancelledRides.php">CANCELLED RIDES</a>
                <a href="allRides.php">ALL RIDES</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">USERS</a>
            <div class="dropdown-content">
                <a href="admin.php">PENDING USERS</a>
                <a href="customers.php">APPROVED USERS</a>
                <a href="allUsers.php">ALL USERS</a>
            </div>
        </li>
        <li><a href="locations.php">MANAGE LOCATIONS</a></li>
        <li><a href="adminPassword.php">CHANGE PASSWORD</a></li>
        <li><a href="logout.php" name="logout">LOGOUT</a></li>
    </ul>
<div id="main">