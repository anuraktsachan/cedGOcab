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



$user_id = $_SESSION['invoice_id'];
$sql4 = $userdata->userSpent($user_id);
if ($sql4) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql11 = $userdata->displayUser($user_id);
$row = mysqli_fetch_array($sql11);




?>
<div>
    <h3>WELCOME <?php echo $_SESSION['name']; ?> : Customer Invoice</h3>
</div>
<div id="invoice">
    <a id="invoicelogo" class="primary">ced<span>GO</span>cab</a>
    
        <p><i class="fa fa-arrow-down"></i></p>
    
    <div>
        <h2>CUSTOMER INFORMATION: </h2>
        <h4>ACCOUNT ID: <?php echo $row['user_id'] ?></h4>
        <h4>NAME: <?php echo $row['name'] ?></h4>
        <h4>MOBILE NUMBER: <?php echo $row['mobile_number'] ?></h4>
    </div>
    <table id="customers">
        <tr>
            <th>DATE</th>
            <th>TRAVELLING DISTANCE</th>
            <th>LUGGAGE WEIGHT</th>
            <th>TOTAL FARE</th>
        </tr>
        <?php
        $sql = $userdata->userCompletedR($user_id);
        if ($sql > 0) {
            while ($row = mysqli_fetch_array($sql)) {

        ?>
                <tr>
                    <td><?php echo $row['ride_date'] ?></td>
                    <td><?php echo $row['total_distance'] ?></td>
                    <td><?php echo $row['luggage'] ?></td>
                    <td><?php echo $row['total_fare'] ?></td>
                </tr>
        <?php
            }
        } else {
            // echo "0 results";
        }
        ?>
    </table>
    <?php $sum = 0;
    foreach ($sql4 as $key) {
        $sum += $key['total_fare']; ?>
    <?php
    }
    ?>
    <div>
        <h4>TOTAL BILL: <i class="fa fa-rupee"></i><?php echo (int)$sum; ?></h4>
    </div>
    <button onclick="window.print()" class="ryt">PRINT</button>
</div>

<?php
require_once 'footer.php';
?>