<?php
require_once 'config.php';
require_once 'userHeader.php';
if (!isset($_SESSION['user_id'])) {
    header('location:logout.php');
}
$errors = array();
$message = '';
$userdata = new DB_con();


if (isset($_POST['change'])) {
    $user_id = $_SESSION['user_id'];
    $newPassword = isset($_POST['newPassword']) ? md5($_POST['newPassword']) : '';
    $repassword = isset($_POST['repassword']) ? md5($_POST['repassword']) : '';

    if ($newPassword != $repassword) {
        $errors[] = array('input' => 'newPassword', 'msg' => 'password does not match');
    }


    if (sizeof($errors) == 0) {
        $sql = $userdata->adminPassword($user_id, $newPassword);
        if ($sql) {
            echo "<script>alert('Password Changed successfully.');</script>";
            echo "<script>window.location.href='logout.php'</script>";
            //echo "New record created successfully";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script>window.location.href='userPassword.php'</script>";
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
    <h3>Welcome <?php echo $_SESSION['name']; ?> : Change Password Here</h3>
</div>

<div id="signup">
    <h1>Change Password</h1>
    <form id="changePassword" action="" method="POST">
        <p><label for="newPassword">New Password <input type="password" name="newPassword" required></label></p>
        <p><label for="repassword">Confirm Password <input type="password" name="repassword" required></label></p>
        <p><input type="submit" name="change" value="Submit" class="ryt"></p>
    </form>
</div>

<?php
require_once 'footer.php';
?>