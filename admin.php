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
    $user_id = $_GET['approve_id'];
    $sql = $userdata->approveAccount($user_id);
    if ($sql) {
        echo "<script>alert('Approved successfully.');</script>";
        echo "<script>window.location.href='admin.php'</script>";
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='admin.php'</script>";
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['reject_id'])) {
    $user_id = $_GET['reject_id'];
    $sql = $userdata->deleteAccount($user_id);
    if ($sql) {
        echo "<script>alert('Rejected successfully.');</script>";
        echo "<script>window.location.href='admin.php'</script>";
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='admin.php'</script>";
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
        <h3>Welcome <?php echo $_SESSION['name']; ?> : Manage Account Requests Here</h3>
    </div>
    <div>
        <table id="customers">
            <tr>
                <th>Account ID</th>
                <th>User Name</th>
                <th>Customer Name</th>
                <th>Mobile Number</th>
                <th>User Type</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = $userdata->accountRequest();
            if ($sql > 0) {
                while ($row = mysqli_fetch_array($sql)) {

            ?>
                    <tr>
                        <td><?php echo $row['user_id'] ?></td>
                        <td><?php echo $row['user_name'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['mobile_number'] ?></td>
                        <td><?php echo $row['user_type'] ?></td>
                        <td><a href="admin.php?approve_id=<?php echo $row['user_id'] ?>">Approve<p hidden>A $_GET</p></a> <a href="admin.php?reject_id=<?php echo $row['user_id'] ?>">Reject<p hidden>A $_GET</p></a></td>
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