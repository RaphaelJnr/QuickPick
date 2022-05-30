
<?php 

    session_start();

    if(!isset($_POST['submit'])){
        header("location:../../signinsignup/signup.php?error=unauthorized entry");
        exit();
    }else{

        $r_fullname     =   isset($_POST['fullname'])?    $_POST['fullname']   :'';

        $r_password     =   isset($_POST['password'])?    $_POST['password']   :'';
      
        $r_confirm      =   isset($_POST['confirm_password'])?     $_POST['confirm_password']    :'';    
     
        $r_phone        =   isset($_POST['phone'])?       $_POST['phone']      :'';
    
        $r_email        =   isset($_POST['email'])?       $_POST['email']      :'';
    

//CHECKING UNEXPECTED ELEMENTS IN FORM INPUT
    $c_fullname     =   preg_match("/^[a-zA-Z_ -]*$/", $r_fullname);

    $c_password     =   preg_match("/^[a-zA-Z0-9]*$/", $r_password);
    
    $c_confirm      =   preg_match("/^[a-zA-Z0-9]*$/", $r_confirm);
    
    $c_phone        =   preg_match("/^[0-9_+]*$/",       $r_phone);

    $c_email        =   preg_match("/^[a-zA-Z0-9\@\.]*$/", $r_email);

    
// FILTERING, SANITIZING AND VALIDATE ALL FORM INPUTS    
    
    $fullname       =   strtolower(filter_var($r_fullname,  FILTER_SANITIZE_STRING    ));  
    
    $password       =   filter_var($r_password,    FILTER_SANITIZE_STRING    );
      
    $phone          =   filter_var($r_phone ,      FILTER_SANITIZE_NUMBER_INT);

    $email          =   filter_var($r_email,       FILTER_VALIDATE_EMAIL     );

   
//SETTING SESSIONS TO BE USED IN THE SUBSEQUENT FILES
    $_SESSION['fullname']   = $fullname;
    
    $_SESSION['phone']      = $phone;
    
    $_SESSION['email']      = $email;   
   
    //--SANITIZING DATA
    // 10 - INVALID USERNAME
    // 101 - USERNAME LESS THAN 6
    // 111 - INVALID PASSWORD 
    // 11 - PASSWORDS DO NOT MATCH
    // 12 - PASSWORD TOO SHORT
    // 122 - WEAK PASSWORD
    // 13 - PHONE NUMBER MUST BE 10
    // 144 - INVALID PHONE NUMBER
    // 15 - INVALID EMAIL


    if(!$c_fullname){
        header("location:../../signinsignup/signup.php?error=10");
    }elseif(strlen($fullname)<6){
        header("location:../../signinsignup/signup.php?error=101");
    }elseif(!$c_password){
        header("location:../../signinsignup/signup.php?error=111");
    }elseif(strlen($password)<6){
        header("location:../../signinsignup/signup.php?error=12");
    }elseif(!$c_confirm || $password!=$r_confirm){
        header("location:../../signinsignup/signup.php?error=11");
    }elseif(!$c_phone){
        header("location:../../signinsignup/signup.php?error=13");
    }elseif(strlen($phone) <10 || strlen($phone) >10 ){
        header("location:../../signinsignup/signup.php?error=144");
    }elseif(!$c_email){
        header("location:../../signinsignup/signup.php?error=15");
    }else{
                    
    // CONNECTING TO DATABASE
    require('./../dbRelated/dbConnector.php');


        if ($connect){

            //============ERROR MESSAGES ===========
            //30 = PHONE NUMBER ALREADY EXISTS
            //31 = EMAIL ALREADY EXISTS
            //1000 = UNKNOWN ERROR 
            //============================


            $EMAIL_data_select     = "SELECT EMAIL FROM  signup_collector WHERE EMAIL='$email' ";
            $EMAIL_select          = mysqli_query($connect, $EMAIL_data_select);
            $EMAIL_result          = mysqli_num_rows($EMAIL_select);


            $PHONE_data_select     = "SELECT PHONE FROM  signup_collector WHERE PHONE='$phone' ";
            $PHONE_select          = mysqli_query($connect, $PHONE_data_select);
            $PHONE_result          = mysqli_num_rows($PHONE_select);

            
            if($EMAIL_result>0){
                header("location:../../signinsignup/signup.php?error=30");
            }else if($PHONE_result>0){
                header("location:../../signinsignup/signup.php?error=31");
            }else{
                $data_insert = "INSERT INTO signup_collector(FULLNAME, EMAIL, TYPE, PHONE, PASSWORD, SIGNUP_DATE, VERIFIED)
                VALUES(?, ?, ?, ?, ?, ?, ?)";

                $insert      = mysqli_stmt_init($connect);

                if(mysqli_stmt_prepare($insert, $data_insert)){

                    
                $hashedPwd   = password_hash($password, PASSWORD_DEFAULT);

                $driver = false;
                $verified = false;

                $date = date('y-m-d H:i:s');

                mysqli_stmt_bind_param($insert, "ssiisss", $fullname,$email, $driver,$phone,$hashedPwd,$date,$verified);


                $run = mysqli_stmt_execute($insert);

                if($run){
                
                    // SENDING SMS FOR VERIFICATION
                    mysqli_close($connect);

                    
                    $_SESSION['phone_number'] = $phone;
                    $_SESSION['name'] = $fullname;
                    unset($_SESSION['verification_status']);

                    require('./../SMS/sendsms.php');

                }else{  
                    header("location:../../signinsignup/signup.php?error=1000");
                }

                }else{
                    header("location:../../signinsignup/signup.php?error=1000");
                }
            }

            return;
            }
        }
    }
?>
