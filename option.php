<?php 
    include 'Session.php';

    // Personnalize PHP session name
    Session::$sessionName = 'kriss'; // default is empty
    // If the user does not access any page within this time,
    // his/her session is considered expired (3600 sec. = 1 hour)
    Session::$inactivityTimeout = 7200; // default is 3600
    // If you get disconnected often or if your IP address changes often.
    // Let you disable session cookie hijacking protection
    Session::$disableSessionProtection = true; // default is false
    // Ban IP after this many failures.
    Session::$banAfter = 5; // default is 4
    // Ban duration for IP address after login failures (in seconds).
    // (1800 sec. = 30 minutes)
    Session::$banDuration = 3600; // default is 1800
    // File storage for failures and bans. If empty, no ban management.
    Session::$banFile = 'ipbans.php'; // default is empty

    Session::init();
?>
