<?php
define('DB_SERVER', 'localhost'); // Your hostname
define('DB_USER', 'root'); // Databse username
define('DB_PASS', ''); // Database Password
define('DB_NAME', 'BookCab'); // Database name
class DB_con
{
    function __construct()
    {
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbh = $con;
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // Function for table user
    public function registration($username, $name, $mobileNum, $is_block, $is_approved, $password, $user_type)
    {
        $ret = mysqli_query($this->dbh, "insert into tbl_user(`user_name`, `name`, `mobile_number`, `is_block`, `is_approved`, `password`, `user_type`) values('$username', '$name', '$mobileNum', '$is_block', '$is_approved', '$password', '$user_type')");
        return $ret;
    }
    public function signin($username, $password)
    {
        $result = mysqli_query($this->dbh, "select * from tbl_user where `user_name`='$username' and `password`='$password' and `is_approved`='1' and `is_block`='0'");
        return $result;
    }
    public function accountRequest()
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_user where `is_approved`='0' and `user_name`!='admin'");
        return $result1;
    }
    public function approvedAccount()
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_user where `is_approved`='1' and `user_name`!='admin'");
        return $result1;
    }
    public function allUsers($order)
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_user where `user_id`!='3' order by $order");
        return $result1;
    }
    public function approveAccount($user_id)
    {
        $result2 = mysqli_query($this->dbh, "update tbl_user set is_approved='1' where user_id='$user_id'");
        return $result2;
    }
    // Function for block/unblock Account
    public function blockAccount($user_id)
    {
        $result2 = mysqli_query($this->dbh, "update tbl_user set is_block='1' where user_id='$user_id'");
        return $result2;
    }
    public function unblockAccount($user_id)
    {
        $result2 = mysqli_query($this->dbh, "update tbl_user set is_block='0' where user_id='$user_id'");
        return $result2;
    }
    // Function for delete Account
    public function deleteAccount($user_id)
    {
        $result2 = mysqli_query($this->dbh, "delete from tbl_user where user_id='$user_id'");
        return $result2;
    }
    // Function for count
    public function countPendingAcc()
    {
        $result2 = mysqli_query($this->dbh, "select * from tbl_user where `is_approved`='0' and `user_name`!='admin'");
        return $result2->num_rows;
        
    }
    // Function for count
    public function countApprovedAcc()
    {
        $result2 = mysqli_query($this->dbh, "select * from tbl_user where `is_approved`='1' and `user_name`!='admin'");
        return $result2->num_rows;
        
    }
    // Function for adminPassword
    public function adminPassword($user_id, $newPassword)
    {
        $result2 = mysqli_query($this->dbh, "update tbl_user set `password`='$newPassword' where `user_id`='$user_id'");
        return $result2;
    }
    public function updateUser($user_id, $name, $number)
    {
        $result2 = mysqli_query($this->dbh, "update tbl_user set `name`='$name', `mobile_number`='$number' where `user_id`='$user_id'");
        return $result2;
    }
    public function displayUser($user_id)
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_user where `user_id`='$user_id'");
        return $result1;
    }













    // Function for table location
    public function addLocations($locname, $locdistance, $available)
    {
        $ret1 = mysqli_query($this->dbh, "insert into tbl_location(`locationName`, `locDistance`, `is_available`) values('$locname', '$locdistance', '$available')");
        return $ret1;
    }
    public function updateLocations($location_id, $locname, $locdistance, $available)
    {
        $result2 = mysqli_query($this->dbh, "update tbl_location set `locationName` = '$locname', `locDistance` = '$locdistance', `is_available` = '$available' where location_id='$location_id'");
        return $result2;
    }

    public function availableLocations()
    {
        $result3 = mysqli_query($this->dbh, "select * from tbl_location where `is_available`='1'");
        return $result3;
    }
    public function allLocations()
    {
        $result3 = mysqli_query($this->dbh, "select * from tbl_location");
        return $result3;
    }
    // Function for delete Location
    public function deleteLocation($location_id)
    {
        $result2 = mysqli_query($this->dbh, "delete from tbl_location where location_id='$location_id'");
        return $result2;
    }
    // Function for count
    public function countAvailableLoc()
    {
        $result2 = mysqli_query($this->dbh, "select * from tbl_location");
        return $result2->num_rows;
        
    }






    




    // Function for book Cab
    public function bookCab($pickupL, $dropL, $distance, $luggage, $fare, $cabStatus, $custUserid)
    {
        $ret1 = mysqli_query($this->dbh, "insert into tbl_ride(`pickUp`, `dropPoint`, `total_distance`, `luggage`, `total_fare`, `cab_status`, `custUser_id`) values('$pickupL', '$dropL', '$distance', '$luggage', '$fare', '$cabStatus', '$custUserid')");
        return $ret1;
    }
    // Function for Ride requests
    public function cabRequest()
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_ride where `cab_status`='1'");
        return $result1;
    }
    // Function for user Ride requests
    public function userPendingR($user_id)
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_ride where `cab_status`='1' and `custUser_id`=$user_id");
        return $result1;
    }
    public function userCompletedR($user_id)
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_ride where `cab_status`='2' and `custUser_id`=$user_id");
        return $result1;
    }
    public function userAllR($user_id, $order)
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_ride where `custUser_id`=$user_id  order by $order");
        return $result1;
    }

    public function completedRides()
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_ride where `cab_status`='2'");
        return $result1;
    }
    public function cancelledRides()
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_ride where `cab_status`='0'");
        return $result1;
    }
    public function allRides($order)
    {
        $result1 = mysqli_query($this->dbh, "select * from tbl_ride order by $order");
        return $result1;
    }

    // 
    public function approveCab($ride_id)
    {
        $result2 = mysqli_query($this->dbh, "update tbl_ride set cab_status='2' where ride_id='$ride_id'");
        return $result2;
    }
    // Function for delete Cab
    public function deleteCab($ride_id)
    {
        $result2 = mysqli_query($this->dbh, "update tbl_ride set cab_status='0' where ride_id='$ride_id'");
        return $result2;
    }
    // Function for count
    public function countRideReq()
    {
        $result2 = mysqli_query($this->dbh, "select * from tbl_ride where `cab_status`='1'");
        return $result2->num_rows;
        
    }
    // Function for revenue
    public function totalRevenue()
    {
        $result2 = mysqli_query($this->dbh, "select total_fare from tbl_ride where `cab_status`='2'");
        return $result2;
        
    }
    public function userSpent($user_id)
    {
        $result2 = mysqli_query($this->dbh, "select total_fare from tbl_ride where `cab_status`='2' and `custUser_id`='$user_id'");
        return $result2;
        
    }
    // Function for user count pending
    public function userPendingReq($user_id)
    {
        $result2 = mysqli_query($this->dbh, "select * from tbl_ride where `cab_status`='1' and `custUser_id`='$user_id'");
        return $result2->num_rows;
        
    }






    
}
