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


if (isset($_GET['approve_id'])) {
    $ride_id = $_GET['approve_id'];
    $sql = $userdata->approveCab($ride_id);
    if ($sql) {
        echo "<script>alert('Approved successfully.');</script>";
        echo "<script>window.location.href='cabRequests.php'</script>";
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='cabRequests.php'</script>";
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['reject_id'])) {
    $ride_id = $_GET['reject_id'];
    $sql = $userdata->deleteCab($ride_id);
    if ($sql) {
        echo "<script>alert('Rejected successfully.');</script>";
        echo "<script>window.location.href='cabRequests.php'</script>";
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='cabRequests.php'</script>";
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
        <h3>Welcome <?php echo $_SESSION['name']; ?> : Manage Cab Requests Here</h3>
    </div>
    <div>
        <table id="customers">
            <tr>
                <th>Request ID</th>
                <th>Date</th>
                <th>Travelling Distance</th>
                <th>Luggage Weight</th>
                <th>Total Fare</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = $userdata->cabRequest();
            if ($sql > 0) {
                while ($row = mysqli_fetch_array($sql)) {

            ?>
                    <tr>
                        <td><?php echo $row['ride_id'] ?></td>
                        <td><?php echo $row['ride_date'] ?></td>
                        <td><?php echo $row['total_distance'] ?></td>
                        <td><?php echo $row['luggage'] ?></td>
                        <td><?php echo $row['total_fare'] ?></td>
                        <td><a href="cabRequests.php?approve_id=<?php echo $row['ride_id'] ?>">Approve<p hidden>A $_GET</p></a> <a href="cabRequests.php?reject_id=<?php echo $row['ride_id'] ?>">Reject<p hidden>A $_GET</p></a></td>
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