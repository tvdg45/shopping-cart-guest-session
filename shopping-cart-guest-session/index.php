<?php
    header("Access-Control-Allow-Origin: https://www.timothysdigitalsolutions.com");
    header("Content-type: application/x-www-form-urlencoded");
    
    $new_session = str_shuffle(hash("sha256", "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"));
    $check_session = filter_input(INPUT_POST, 'check_session');
    $delete_session = filter_input(INPUT_POST, 'delete_session');
    $output = "";
    
    //Check if a guest session is active.
    //If a guest session does not exist, create one.
    if ($check_session == "Check") {
        
        if (filter_input(INPUT_COOKIE, "guest_cookie") != "") {
            
            $output = filter_input(INPUT_COOKIE, "guest_cookie");
        } else {
            
            setcookie("guest_cookie", $new_session, time() + 86400, "/");
            
            $output = $new_session;
        }
    }
    
    //Delete a guest session.
    if ($delete_session == "Delete") {
        
        if (filter_input(INPUT_COOKIE, "guest_cookie") != "") {
            
            setcookie("guest_cookie", filter_input(INPUT_COOKIE, "guest_cookie"), time() - 86400, "/");
        }
        
        $output = "";
    }
    
    echo $output;
