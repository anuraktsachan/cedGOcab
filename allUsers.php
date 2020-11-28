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


if (isset($_GET['invoice_id'])) {
    $_SESSION['invoice_id'] = $_GET['invoice_id'];
    header('location:adminInvoice.php');
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
    <h3>Welcome <?php echo $_SESSION['name']; ?> : All Users Here</h3>
</div>
<div>
    <table id="customers">
        <tr>
            <th>Account ID</th>
            <th>Customer Name</th>
            <th>Signup Date</th>
            <th>Mobile Number</th>
            <th>Approved</th>
            <th>Blocked</th>
            <th>Invoice</th>
        </tr>
        <?php
        if (isset($_GET['sort_by'])) {
            $order = $_GET['sort_by'];
        } else {
            $order = 'user_id';
        }

        $sql = $userdata->allUsers($order);
        if ($sql > 0) {
        ?>
            <ul>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Sort By</a>
                    <div class="dropdown-content">
                        <a href="allUsers.php?sort_by=name">Name<p hidden>A $_GET</p></a>
                        <a href="allUsers.php?sort_by=date_time">Signup Date<p hidden>A $_GET</p></a>
                        <a href="allUsers.php?sort_by=is_approved">Approved<p hidden>A $_GET</p></a>
                    </div>
                </li>
            </ul>
            <?php
            while ($row = mysqli_fetch_array($sql)) {

            ?>

                <tr>
                    <td><?php echo $row['user_id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['date_time'] ?></td>
                    <td><?php echo $row['mobile_number'] ?></td>
                    <td><?php if ($row['is_approved'] == '0') {
                            echo 'Pending';
                        } else {
                            echo 'Approved';
                        } ?></td>
                    <td><?php if ($row['is_block'] == '0') {
                            echo 'Unblocked';
                        } else {
                            echo 'Blocked';
                        } ?>
                    </td>
                    <td>
                        <a href="allUsers.php?invoice_id=<?php echo $row['user_id'] ?>" <?php if ($row['is_approved'] == '0') { ?> target="_blank" <?php
                                                                                                                                                } ?>>Generate<p hidden>A $_GET</p></a>
                    </td>
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