<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == '3') {
    $style1 = "style='display:none;'";
} else {
    header('location:logout.php');
}

require_once 'config.php';
require_once 'header.php';
$errors = array();
$message = '';
$userdata = new DB_con();


$sql = $userdata->countPendingAcc();
if ($sql) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql1 = $userdata->countApprovedAcc();
if ($sql1) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = $userdata->countAvailableLoc();
if ($sql2) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql3 = $userdata->countRideReq();
if ($sql3) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql4 = $userdata->totalRevenue();
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
        <div><a href="admin.php"><i class="fa fa-user-times fa-3x"></i><p> Pending Account Requests: <?php echo $sql; ?></p></a></div>
        <div><a href="customers.php"><i class="fa fa-users fa-3x"></i><p> Total Approved Accounts: <?php echo $sql1; ?></p></a></div>
        <div><a href="locations.php"><i class="fa fa-map-marker fa-3x"></i><p> Available Locations: <?php echo $sql2; ?></p></a></div>
        <div><a href="cabRequests.php"><i class="fa fa-cab fa-3x"></i><p> Pending Ride Requests: <?php echo $sql3; ?></p></a></div>
        <?php $sum = 0;
        foreach ($sql4 as $key) {
            $sum += $key['total_fare']; ?>
        <?php
        }
        ?>
        <div><a href="#"><i class="fa fa-rupee fa-3x"></i><p> Total Earnings: <?php echo (int)$sum; ?></p></a></div> 
    </div>

<?php
require_once 'footer.php';
?>