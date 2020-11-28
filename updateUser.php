<?php
require_once 'config.php';
require_once 'userHeader.php';
if (!isset($_SESSION['user_id'])) {
    header('location:logout.php');
}
$userdata = new DB_con();


if (isset($_POST['updateInfo'])) {
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $number = isset($_POST['number']) ? $_POST['number'] : '';

        $sql = $userdata->updateUser($user_id, $name, $number);
        if ($sql) {
            echo "<script>alert('Details Changed successfully.');</script>";
            echo "<script>window.location.href='updateUser.php'</script>";
            //echo "New record created successfully";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script>window.location.href='updateUser.php'</script>";
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

}


$user_id = $_SESSION['user_id'];
$sql = $userdata->displayUser($user_id);
$row = mysqli_fetch_array($sql);



?>

<div>
    <h3>Welcome <?php echo $_SESSION['name']; ?> : Update Account Information Here</h3>
</div>
<div id="userInfo1">
    <h2>Account Information:</h2>
    <h4>Account ID: <?php echo $row['user_id'] ?></h4>
    <h4>Username: <?php echo $row['user_name'] ?></h4>
    <h4>Name: <?php echo $row['name'] ?></h4>
    <h4>Mobile Number: <?php echo $row['mobile_number'] ?></h4>
    <h4>Account Type: <?php echo $row['user_type'] ?> Account</h4>
    <p><input type="button" id="requestUpdInf" value="Edit" class="ryt"></p>
</div>

<div id="userInfo2">
    <h1>Update Information</h1>
    <form id="changePassword" action="" method="POST">
        <p><label for="user_id">Account ID <input type="number" name="user_id" value="<?php echo $row['user_id'] ?>" readonly></label></p>
        <p><label for="username">Username <input type="text" name="username" value="<?php echo $row['user_name'] ?>" readonly></label></p>
        <p><label for="name">Name <input type="text" name="name" value="<?php echo $row['name'] ?>" required></label></p>
        <p><label for="mobile_number">Mobile Number <input type="number" name="number" value="<?php echo $row['mobile_number'] ?>" required></label></p>
        <p><label for="user_type">Account Type <input type="text" name="userType" value="<?php echo $row['user_type'] ?>" readonly></label></p>
        <p><input type="submit" id="sendUpdInf" name="updateInfo" value="Update" class="ryt"></p>
    </form>
</div>

<?php
require_once 'footer.php';
?>