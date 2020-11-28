<?php
require_once 'config.php';
require_once 'userHeader.php';
if (!isset($_SESSION['user_id'])) {
    header('location:logout.php');
}
$userdata = new DB_con();



?>
    <div>
        <h3>Welcome <?php echo $_SESSION['name']; ?> : Your Pending Cab Requests</h3>
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
            $user_id = $_SESSION['user_id'];
            $sql = $userdata->userPendingR($user_id);
            if ($sql > 0) {
                while ($row = mysqli_fetch_array($sql)) {

            ?>
                    <tr>
                        <td><?php echo $row['ride_id'] ?></td>
                        <td><?php echo $row['ride_date'] ?></td>
                        <td><?php echo $row['total_distance'] ?></td>
                        <td><?php echo $row['luggage'] ?></td>
                        <td><?php echo $row['total_fare'] ?></td>
                        <td><?php echo 'Pending' ?></td>
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