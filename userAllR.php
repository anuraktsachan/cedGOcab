<?php
require_once 'config.php';
require_once 'userHeader.php';
if (!isset($_SESSION['user_id'])) {
    header('location:logout.php');
}
$userdata = new DB_con();



?>
<div>
    <h3>Welcome <?php echo $_SESSION['name']; ?> : All Cab Rides</h3>
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
        if (isset($_GET['sort_by'])) {
            $order = $_GET['sort_by'];
        } else {
            $order = 'ride_id';
        }
        $user_id = $_SESSION['user_id'];
        $sql = $userdata->userAllR($user_id, $order);
        if ($sql > 0) {
        ?>
            <ul>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Sort By</a>
                    <div class="dropdown-content">
                        <a href="userAllR.php?sort_by=luggage">Luggage Weight<p hidden>A $_GET</p></a>
                        <a href="userAllR.php?sort_by=total_distance">Distance<p hidden>A $_GET</p></a>
                        <a href="userAllR.php?sort_by=total_fare">Fare<p hidden>A $_GET</p></a>
                    </div>
                </li>
            </ul>
            <?php
            while ($row = mysqli_fetch_array($sql)) {

            ?>
                <tr>
                    <td><?php echo $row['ride_id'] ?></td>
                    <td><?php echo $row['ride_date'] ?></td>
                    <td><?php echo $row['total_distance'] ?></td>
                    <td><?php echo $row['luggage'] ?></td>
                    <td><?php echo $row['total_fare'] ?></td>
                    <td><?php if ($row['cab_status'] == 1) {
                            echo 'Pending';
                        } elseif ($row['cab_status'] == 2) {
                            echo 'Completed';
                        } else {
                            echo 'Cancelled';
                        } ?></td>
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