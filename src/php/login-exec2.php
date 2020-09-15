<?php
    //Start session
    session_start();
    
    //Include database connection details
    require_once('config.php');
   
    //Array to store validation errors
    $errmsg_arr = array();
    
    //Validation error flag
    $errflag = false;
    
    //Connect to mysql server
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if (!$link) {
        die('Failed to connect to server: ' . mysqli_error());
    }
    
    //Select database
    $db = mysqli_select_db($link, DB_DATABASE);
    if (!$db) {
        die("Unable to select database");
    }
    
    //Function to sanitize values received from the form. Prevents SQL injection
    // function clean($str) {
    // 	$str = @trim($str);
    // 	if(get_magic_quotes_gpc()) {
    // 		$str = stripslashes($str);
    // 	}
    // 	return mysqli_real_escape_string($str);
    // }
    
    //Sanitize the POST values
    $login = ($_POST['login']);
    $password = ($_POST['password']);
    
    //Input Validations
    if ($login == '') {
        $errmsg_arr[] = 'Login ID missing';
        $errflag = true;
    }
    if ($password == '') {
        $errmsg_arr[] = 'Password missing';
        $errflag = true;
    }
    
    //If there are input validations, redirect back to the login form
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("location: login-form.php");
        exit();
    }
    
    //Create query
    $qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
    //haetaan kentan admin arvo noilta salasanoilta ja kayttajilta
    $adminko="select admin FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";

    // normikayttajakysely
    $result=mysqli_query($link, $qry);

    //varsinainen adminkysely
    $adminresult=mysqli_query($link, $adminko);

    // tehaan keksin nimi
    $cookie_name = "id";
    $cookie_name1 = "firstname";
    $cookie_name2 = "lastname";
    $cookie_name3 = "admin";

    echo "<br>kysely listasta <br> ";
    echo $adminko . "<br>";
    echo "varsinainen kysely joka suoritetaan <br> ";
    echo  "<br>";
    
if ($result) {
    if (mysqli_num_rows($result) == 1) {
        //Login Successful
        session_regenerate_id();
        $member = mysqli_fetch_assoc($result);
        $_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
        $_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
        $_SESSION['SESS_LAST_NAME'] = $member['lastname'];
        $_SESSION['SESS_ADMIN'] = $member['admin'];
        setcookie($cookie_name, $member['member_id'], time() + (86400 * 30));
        setcookie($cookie_name1, $member['firstname'], time() + (86400 * 30));
        setcookie($cookie_name2, $member['lastname'], time() + (86400 * 30));
        setcookie($cookie_name3, $member['admin'], time() + (86400 * 30));
        session_write_close();
        header("location: member-index.php");
    } else {
        //vaarat tunnukset
        header("location: login-failed.php");
        exit();
    }
} else {
    die("Query failed");
}
    

    // Check whether the NORMIquery was successful or not
    // if ($result) {
    //     if (mysqli_num_rows($result) == 1) {
    //         //Login Successful
    //         session_regenerate_id();
    //         $member = mysqli_fetch_assoc($adminresult);
    //         $_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
    //         $_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
    //         $_SESSION['SESS_LAST_NAME'] = $member['lastname'];
    //         $_SESSION['SESS_ADMIN'] = $member['admin'];
    //         session_write_close();
    //         //annetaan keksin id arvo id numeroksi
    //         setcookie($cookie_name, $member['member_id'], time() + (86400 * 30));
    //         setcookie($cookie_name1, $member['firstname'], time() + (86400 * 30));
    //         setcookie($cookie_name2, $member['lastname'], time() + (86400 * 30));
    //         setcookie($cookie_name3, $member['admin'], time() + (86400 * 30));
    // 		$onadmin=$_SESSION['SESS_ADMIN'] = $member['admin'];
    // 		// echo $onadmin;
    // 		// onko kayttaja
    //         if ($onadmin==0) {
    //             header("location: member-index.php");
    // 		}
    // 		// vai onko admin
    // 		elseif ($onadmin==1)
            
    // 		{            echo $onadmin;

    //             header("location: admin-index.php");
    //             exit();
    //         } else {
    //             //vaarat tunnukset
    //             header("location: login-failed.php");
    //             exit();
    //         }
    //         } else {
            
    //         die("Query failed");
    //     }
    //     }
?>