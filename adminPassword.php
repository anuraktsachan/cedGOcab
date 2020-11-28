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
            echo "<script>window.location.href='adminPassword.php'</script>";
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
    <h3>WELCOME <?php echo $_SESSION['name']; ?> : </h3>
</div>

<div id="login">
    
    <form id="changePassword" action="" method="POST">
        <p><label for="newPassword">NEW PASSWORD- <input type="password" name="newPassword" required></label></p>
        <p><label for="repassword">CONFIRM PASSWORD- <input type="password" name="repassword" required></label></p>
        <p><input type="submit" name="change" value="CHANGE PASSWORD" class="ryt"></p>
    </form>
</div>

<?php
require_once 'footer.php';
?>