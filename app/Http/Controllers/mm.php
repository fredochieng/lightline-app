<?php require_once('Connections/monitoring.php');
//Function for validating if user is exsting on DB

function validateCrd($ldapuser, $cat)
{

    $loginFormAction = $_SERVER['PHP_SELF'];

    if (isset($_GET['accesscheck'])) {

        $_SESSION['PrevUrl'] = $_GET['accesscheck'];
    }

    include 'Connections/monitoring.php';

    mysql_select_db($database_monitoring, $monitoring);

    $MM_fldUserAuthorization = "level";

    if ($cat == 'WCL') {
        $MM_redirectLoginSuccess = "pages/home.php";
    } else {
        $MM_redirectLoginSuccess = "dth/home.php";
    }

    if ($cat == 'WCL') {
        $LoginRS__query = "SELECT username,level FROM zuku_users WHERE username like '%" . $ldapuser . "%' ";
    } else {
        $LoginRS__query = "SELECT username,level FROM dth_users WHERE username like '%" . $ldapuser . "%' ";
    }


    $MM_redirectLoginFailed = "index.php";

    $MM_redirecttoReferrer = false;


    $LoginRS = mysql_query($LoginRS__query, $monitoring) or die(mysql_error());

    $loginFoundUser = mysql_num_rows($LoginRS);

    //echo $loginFoundUser;

    if ($loginFoundUser == 1) {

        // mysql_select_db($database_zukuportal, $zukuportal); 
        //$timestamp=date("Y-m-d H:i:s");			 
        //$log="insert into login_log(name,time) VALUES ('".$ldapuser."','".$timestamp."')";
        // $sucess=mysql_query($log,$zukuportal);	 

        $loginStrGroup  = mysql_result($LoginRS, 0, 'level');

        if (PHP_VERSION >= 5.1) {
            session_regenerate_id(true);
        } else {
            session_regenerate_id();
        }

        //declare two session variables and assign them

        $_SESSION['MM_Username'] = $ldapuser;

        $_SESSION['MM_UserGroup'] = $loginStrGroup;


        if (isset($_SESSION['PrevUrl']) && false) {

            $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
        }

        header("Location: " . $MM_redirectLoginSuccess);
    } else {

        header("Location: " . $MM_redirectLoginFailed);
    }
}


if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
    session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['CAT']) && isset($_POST['username']) && isset($_POST['password'])) {
    $cat = $_POST['CAT'];
    $loginUsername = $_POST['username'];
    $password = $_POST['password'];

    if ($cat == 'WCL') {

        //CABLE USER


        $staffGroup = "Domain Users";
        function getRealIpAddr()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }

        // *** Validate request to login to this site.			

        if (isset($_POST['username']) && isset($_POST['password'])) {

            include 'adLDAP.php';
            $adldap = new adLDAP();
            $username = $_POST["username"];
            $password = $_POST["password"];
            $ipaddress = getRealIpAddr();
            $authUser = $adldap->authenticate($username, $password);
            #$authStaffGroup = $adldap->user_ingroup($username,$staffGroup,$recursive=NULL);

            if (($authUser == true)) {
                $ldapuser = $username;
                validateCrd($ldapuser, $cat);
            } else {
                echo '<p style="color:#000;align="center"><B>Invalid User Name or Password, Use your Domain Credentials</B></p>';
            }
        }

        //end of login



        //CANLE USER

    } else if ($cat == 'WSL') {


        //LOCAL DB
        $staffGroup = "Domain Users";
        function getRealIpAddr()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }

        // *** Validate request to login to this site.		

        if (isset($_POST['username']) && isset($_POST['password'])) {


            /** This is the implementation of the internal and vendor AD
             * Done on 04/03/2023 by Fredrick Ochieng
             */
            if ($_POST['domain'] == 1) {
                include 'adLDAP.php';
                $adldap = new adLDAP();
                echo "Internal";
            } else {
                include 'adLDAPVendor.php';
                $adldap = new adLDAPVendor();
                echo "Vendor";
            }

            //echo "Outside";
            $username = $_POST["username"];
            $password = $_POST["password"];
            $ipaddress = getRealIpAddr();
            $authUser = $adldap->authenticate($username, $password);


            if (($authUser == true)) {
                $ldapuser = $username;
                //echo "Login successful";
                validateCrd($ldapuser, $cat);
            } else {
                //echo "Login not successful";
                echo '<p style="color:#000;align="center"><B>Invalid User Name or Password, Use your Domain Credentials</B></p>';
            }
        }
    } else {
        echo '<p style=" color:#0000; margin:auto;">Enter username, password and Select an Operational Entity,Wrong Username and password</p>';
    }
}
