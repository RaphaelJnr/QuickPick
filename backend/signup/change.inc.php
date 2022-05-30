
<?php 

session_start();

if(!isset($_POST['submit'])){
    header("location:../../signinsignup/ChangePwd.php?error=unauthorized entry");
    exit();
}else{

    $r_password     =   isset($_POST['password'])?    $_POST['password']   :'';
  
    $r_confirm      =   isset($_POST['cpassword'])?   $_POST['cpassword']  :'';    
    
    
    $phone = 0;
    if(isset($_SESSION['phone_number'])){
        $phone = $_SESSION['phone_number'];
    }else{
        header("location:../../signinsignup/login.php?error=999");
    }


//CHECKING UNEXPECTED ELEMENTS IN FORM INPUT
$c_password     =   preg_match("/^[a-zA-Z0-9]*$/", $r_password);
$c_confirm      =   preg_match("/^[a-zA-Z0-9]*$/", $r_confirm);


// FILTERING, SANITIZING AND VALIDATE ALL FORM INPUTS    

$password       =   filter_var($r_password,    FILTER_SANITIZE_STRING    ); 

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


if(!$c_password){
    header("location:../../signinsignup/ChangePwd.php?error=111");
}elseif(strlen($password)<6){
    header("location:../../signinsignup/ChangePwd.php?error=12");
}elseif(!$c_confirm || $password!=$r_confirm){
    header("location:../../signinsignup/ChangePwd.php?error=11");
}else{
                
// CONNECTING TO DATABASE
require('./../dbRelated/dbConnector.php');


    if ($connect){

          $hashedPwd   = password_hash($password, PASSWORD_DEFAULT);

           $data_insert = "UPDATE signup_collector SET PASSWORD = ? WHERE PHONE='$phone'";

           $insert      = mysqli_stmt_init($connect);

           if(mysqli_stmt_prepare($insert, $data_insert)){

           mysqli_stmt_bind_param($insert, "s", $hashedPwd);

           $run = mysqli_stmt_execute($insert);

           if($run){

              mysqli_close($connect);
              header("location:../../signinsignup/login.php?error=1000");
              
           }else{  
            header("location:../../signinsignup/login.php?error=999");
           }
        }
      
        return;
        }
    }
}
?>
