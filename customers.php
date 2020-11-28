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


if (isset($_GET['block_id'])) {
    $user_id = $_GET['block_id'];
    $sql = $userdata->blockAccount($user_id);
    if ($sql) {
        echo "<script>window.location.href='customers.php'</script>";
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='customers.php'</script>";
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (isset($_GET['unblock_id'])) {
    $user_id = $_GET['unblock_id'];
    $sql = $userdata->unblockAccount($user_id);
    if ($sql) {
        echo "<script>window.location.href='customers.php'</script>";
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='customers.php'</script>";
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
        <h3>Welcome <?php echo $_SESSION['name']; ?> : Manage All Accounts Here</h3>
    </div>
    <div>
        <table id="customers">
            <tr>
                <th>Account ID</th>
                <th>User Name</th>
                <th>Customer Name</th>
                <th>Mobile Number</th>
                <th>Account Status</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = $userdata->approvedAccount();
            if ($sql > 0) {
                while ($row = mysqli_fetch_array($sql)) {

            ?>
                    <tr>
                        <td><?php echo $row['user_id'] ?></td>
                        <td><?php echo $row['user_name'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['mobile_number'] ?></td>
                        <td><?php if ($row['is_block'] == '0') {
                                echo 'Unblocked';
                            } else {
                                echo 'Blocked';
                            } ?></td>
                        <td><a href="customers.php?<?php if ($row['is_block'] == '0') {
                                                        echo 'block';
                                                    } else {
                                                        echo 'unblock';
                                                    } ?>_id=<?php echo $row['user_id'] ?>"><?php if ($row['is_block'] == '0') {
                                                                                                echo 'Block';
                                                                                            } else {
                                                                                                echo 'Unblock';
                                                                                            } ?><p hidden>A $_GET</p></a></td>
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