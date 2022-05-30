<?php
session_start();


if(!isset($_POST['submit'])){
    header("location:../../signinsignup/forgotPwd.php?error=999");
    exit();
  }else{

    unset($_SESSION['verification_status']);
 
    $r_phone        =   isset($_POST['phone'])?    $_POST['phone']   :''; 
    $c_phone        =   preg_match("/^[0-9]*$/", $r_phone);
    $phone          =   filter_var($r_phone ,      FILTER_SANITIZE_NUMBER_INT);

    //--SANITIZING DATA
    // 100 - INVALID PHONE NUMBER
    // 101 - INCORRECT PHONE NUMBER
    // 102 - PHONE NUMBER DOES NOT EXISTS
    // 103 - ILLEGAL CHARACTERS IN PHONE
    // 104 - INCORRECT PASSWORD
    // 999 - FATA ERROR
    // 990 - UNAUTHORIZED ENTRY

    // CONNECTING TO MAIN DATABASE
    if(!$c_phone){
        header("location:../../signinsignup/forgotPwd.php?error=101");
        exit();
    }else{

    
        require('./../dbRelated/dbConnector.php');

        if(!$connect){
            header("location:../../signinsignup/forgotPwd.php?error=999");
            exit();
        }else{
            $select_data    = "SELECT * FROM signup_collector WHERE PHONE=?";

            $login          = mysqli_stmt_init($connect);

            $prepare        = mysqli_stmt_prepare($login, $select_data);

            if(!$prepare){
                header("location:../../signinsignup/forgotPwd.php?error=999");
                exit();   
            }else{


                mysqli_stmt_bind_param($login, "s", $phone);

                $run    = mysqli_stmt_execute($login);

                if(!$run){
                    header("location:../../signinsignup/forgotPwd.php?error=999");
                    exit();
                }else{
 
                    $row    = mysqli_stmt_num_rows($login);

                    $data   = mysqli_stmt_get_result($login);
                    
                    $result = mysqli_fetch_assoc($data);

                if(!$result){
                    header("location:../../signinsignup/forgotPwd.php?error=102");
                    exit();
                }else{

                    // START SESSION and send sms
                 $_SESSION['phone_number'] = $phone;
                 $_SESSION['forgot'] = true;

                 require('./../SMS/sendsms.php');

              }
            }
        }
       }
    }
}