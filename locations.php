<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();


if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == '3') {
    $style0 = "style='display:none;'";
} else {
    header('location:logout.php');
}



require_once 'config.php';
require_once 'header.php';
$errors = array();
$message = '';
$userdata = new DB_con();

if (isset($_POST['submit'])) {
    $locname = isset($_POST['locname']) ? $_POST['locname'] : '';
    $locdistance = isset($_POST['locdistance']) ? $_POST['locdistance'] : '';
    $available = isset($_POST['available']) ? $_POST['available'] : '';
    $sql = $userdata->addLocations($locname, $locdistance, $available);
    if ($sql) {
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='locations.php'</script>";
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



if (isset($_POST['update'])) {
    $location_id = isset($_POST['location_id']) ? $_POST['location_id'] : '';
    $locname = isset($_POST['locname']) ? $_POST['locname'] : '';
    $locdistance = isset($_POST['locdistance']) ? $_POST['locdistance'] : '';
    $available = isset($_POST['available']) ? $_POST['available'] : '';
    $sql = $userdata->updateLocations($location_id, $locname, $locdistance, $available);
    if ($sql) {
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='locations.php'</script>";
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (isset($_GET['delete_id'])) {
    $location_id = $_GET['delete_id'];
    $sql = $userdata->deleteLocation($location_id);
    if ($sql) {
        //echo "New record created successfully";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='locations.php'</script>";
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
        <h3>Welcome <?php echo $_SESSION['name']; ?> :</h3>
    </div>
    <div id="newlocation">
        <h1>ADD LOCATION</h1>
        <form id="locationForm" action="" method="POST">
            <p><label for="locationname">LOCATION NAME <input type="text" name="locname" required></label></p>
            <p><label for="distance">DISTANCE(from CHARBAGH) <input type="number" name="locdistance" required></label></p>
            <label for="">AVAILABLE</label>
            <select name="available">
                <option value="1" selected="Available">AVAILABLE</option>
                <option value="0">NOT AVAILABLE</option>
            </select>
            <p><input type="submit" name="submit" value="ADD" class="ryt"></p>
        </form>
    </div>
    <div>
        <table id="locations">
            <tr>
                <th>Location ID</th>
                <th>Location Name</th>
                <th>Distance(From Charbagh)</th>
                <th>Available</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = $userdata->allLocations();
            if ($sql > 0) {
                while ($row = mysqli_fetch_array($sql)) {

            ?>
                    <form action="" method="POST">
                        <tr>
                            <td><input type="hidden" name="location_id" value="<?php echo $row['location_id'] ?>"><?php echo $row['location_id'] ?></td>
                            <td><input type="text" name="locname" value="<?php echo $row['locationName'] ?>" required></td>
                            <td><input type="number" name="locdistance" value="<?php echo $row['locDistance'] ?>" required></td>
                            <td>
                                <select name="available">
                                    <option value="<?php if ($row['is_available'] == '1') {
                                                        echo '1';
                                                    } else {
                                                        echo '0';
                                                    } ?>" selected="<?php if ($row['is_available'] == '1') {
                                                                        echo 'Available';
                                                                    } else {
                                                                        echo 'Not Available';
                                                                    } ?>"><?php if ($row['is_available'] == '1') {
                                                                            echo 'Available';
                                                                        } else {
                                                                            echo 'Not Available';
                                                                        } ?></option>
                                    <option value="<?php if ($row['is_available'] == '1') {
                                                        echo '0';
                                                    } else {
                                                        echo '1';
                                                    } ?>"><?php if ($row['is_available'] == '1') {
                                                                echo 'Not Available';
                                                            } else {
                                                                echo 'Available';
                                                            } ?></option>
                                </select></td>
                            <td>
                                <p><input type="submit" name="update" value="Update" class="ryt"></p> <a href="locations.php?delete_id=<?php echo $row['location_id'] ?>">Delete<p hidden>A $_GET</p></a>
                            </td>
                        </tr>
                    </form>
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