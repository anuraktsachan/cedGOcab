<?php

require_once 'config.php';
require_once 'userHeader.php';
if (!isset($_SESSION['user_id'])) {
    header('location:logout.php');
}
$errors = array();
$message = '';
$userdata = new DB_con();




$sql2 = $userdata->countAvailableLoc();
if ($sql2) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
$user_id = $_SESSION['user_id'];
$sql3 = $userdata->userPendingReq($user_id);
if ($sql3) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql4 = $userdata->userSpent($user_id);
if ($sql4) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}





?>
    <div id="message">
        <?php echo $message; ?>
    </div>
    <div id="errors">
        <?php if (sizeof($errors) > 0) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error['msg']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div>
        <h3>Welcome <?php echo $_SESSION['name']; ?> : Dashboard</h3>
    </div>
    <div id="dashboard">
        <div><a href="index.php"><i class="fa fa-map-marker fa-3x"></i><p> Available Locations: <?php echo $sql2; ?>(Calculate Fare)</p></a></div>
        <div><a href="userPendingR.php"><i class="fa fa-cab fa-3x"></i><p> Pending Ride Requests: <?php echo $sql3; ?></p></a></div>
        <?php $sum = 0;
        foreach ($sql4 as $key) {
            $sum += $key['total_fare']; ?>
        <?php
        }
        ?>
        <div><a href="#"><i class="fa fa-rupee fa-3x"></i><p> Total Spent: <?php echo (int)$sum; ?></p></a></div>
    </div>

<?php
require_once 'footer.php';
?>