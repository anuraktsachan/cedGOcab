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
        <h3>Welcome <?php echo $_SESSION['name']; ?> : Completed Cab Rides Here</h3>
    </div>
    <div>
        <table id="customers">
            <tr>
                <th>Request ID</th>
                <th>Date</th>
                <th>Travelling Distance</th>
                <th>Luggage Weight</th>
                <th>Total Fare</th>
                <th>Status</th>
            </tr>
            <?php
            $sql = $userdata->completedRides();
            if ($sql > 0) {
                while ($row = mysqli_fetch_array($sql)) {

            ?>
                    <tr>
                        <td><?php echo $row['ride_id'] ?></td>
                        <td><?php echo $row['ride_date'] ?></td>
                        <td><?php echo $row['total_distance'] ?></td>
                        <td><?php echo $row['luggage'] ?></td>
                        <td><?php echo $row['total_fare'] ?></td>
                        <td><?php if($row['cab_status'] == 2){echo 'Completed';}?></td>
                    </tr>
            <?php
                }
            } else {
                // echo "0 results";
            }
            ?>
        </table>
    </div>

<?php
require_once 'footer.php';
?>