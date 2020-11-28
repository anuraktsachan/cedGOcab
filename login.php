<?php


session_start();
require_once 'config.php';
$errors = array();
$message = '';


$userdata = new DB_con();



// if (isset($_POST['submit'])) {
//     $username = isset($_POST['username']) ? $_POST['username'] : '';
//     $name = isset($_POST['name']) ? $_POST['name'] : '';
//     $mobileNum = isset($_POST['mobileNum']) ? $_POST['mobileNum'] : '';
//     $password = isset($_POST['password']) ? md5($_POST['password']) : '';
//     $repassword = isset($_POST['repassword']) ? md5($_POST['repassword']) : '';
//     $is_block = '0';
//     $is_approved = '0';
//     $user_type = 'customer';

//     if ($password != $repassword) {
//         $errors[] = array('input' => 'password', 'msg' => 'password does not match');
//     }


//     if (sizeof($errors) == 0) {
//         $sql = $userdata->registration($username, $name, $mobileNum, $is_block, $is_approved, $password, $user_type);
//         if ($sql) {
//             echo "<script>alert('Registered successfully.');</script>";
//             echo "<script>window.location.href='login.php'</script>";
//             //echo "New record created successfully";
//         } else {
//             echo "<script>alert('Something went wrong. Please try again');</script>";
//             echo "<script>window.location.href='login.php'</script>";
//             //echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     }
// }



if (isset($_POST['submit1'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';


    if (sizeof($errors) == 0) {
        $sql = $userdata->signin($username, $password);
        $num = mysqli_fetch_array($sql);

        if ($num > 0) {
            // output data of each row
            $_SESSION['user_id'] = $num['user_id'];
            $_SESSION['user_name'] = $num['user_name'];
            $_SESSION['name'] = $num['name'];
            $_SESSION['mobile_number'] = $num['mobile_number'];
            $_SESSION['user_type'] = $num['user_type'];
            if ($_SESSION['user_id'] == '3') {
                echo "<script>window.location.href='adminDashboard.php'</script>";
            } else {
                echo "<script>window.location.href='userDashboard.php'</script>";
            }
        } else {
            $errors[] = array('input' => 'form', 'msg' => 'Invalid login details');
            echo "<script>window.location.href='login.php'</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="styleCEDCAB.css">
</head>

<body>
    <ul>
        <li><a class="primary" href="#">ced<span>GO</span>cab</a></li>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="index.php">Book Cab Here</a></li>
    </ul>
    <div id="main">
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
        <div class="container">
            <div id="login">
                <h1>SIGN IN</h1>
                <form id="loginForm" action="login.php" method="POST">
                    <p><label for="username">USER NAME- </label><input type="text" name="username" required></p>
                    <p><label for="password">PASSWORD- </label><input type="password" name="password" required></p>
                    <p><input type="submit" name="submit1" value="SIGN IN" class="ryt"></p>
                </form><br>
                <div class="controls">
                    <h6>Not Registered yet? <a href="register.php">REGISTER</a> here.</h6>
                </div>

            </div>

            <!-- <div id="signup">
                <h1>REGISTER</h1>
                <form id="signupForm" action="" method="POST">
                    <p><label for="username">USER NAME*- <input type="text" name="username" required></label></p>
                    <p><label for="username">NAME- <input type="text" name="name" required></label></p>
                    <p><label for="password">MOBILE NUMBER- <input type="number" name="mobileNum" required></label></p>
                    <p><label for="password">PASSWORD- <input type="password" name="password" required></label></p>
                    <p><label for="repassword">RE-PASSWORD- <input type="password" name="repassword" required></label></p>
                    <p><input type="submit" name="submit" value="REGISTER" class="ryt"></p>
                </form>
            </div> -->

        </div>
    

    <?php
    require_once 'footer.php';
    ?>
