<?php

    session_start();
    
        //destroy all session and go ahead to exit the app
        session_destroy();

        header("location:../../signinsignup/login.php");