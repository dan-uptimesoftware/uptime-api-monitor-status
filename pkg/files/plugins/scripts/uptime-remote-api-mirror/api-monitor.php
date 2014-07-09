<?php
include('uptimeApi.php');


$hostname = "localhost";
$port = 9997;
$username = "";
$password = "";


if ( isset($_SERVER['UPTIME_HOSTNAME']) ) {
    $hostname = trim($_SERVER['UPTIME_HOSTNAME']);
}

if ( isset($_SERVER['UPTIME_API_PORT']) ) {
    $port = trim($_SERVER['UPTIME_API_PORT']);
}

if ( isset($_SERVER['UPTIME_API_USERNAME']) ) {
    $username = trim($_SERVER['UPTIME_API_USERNAME']);
}

if ( isset($_SERVER['UPTIME_API_PASSWORD']) ) {
    $password = trim($_SERVER['UPTIME_API_PASSWORD']);
}

if ( isset($_SERVER['UPTIME_ELEMENT_ID']) ) {
    $element_id = trim($_SERVER['UPTIME_ELEMENT_ID']);
}

if ( isset($_SERVER['UPTIME_MONITOR_ID']) ) {
    $monitor_id = trim($_SERVER['UPTIME_MONITOR_ID']);
}


$api = new uptimeApi($username, $password, $hostname, $port);


if( isset ($element_id))
{
    $result = $api->getElementStatus($element_id);

}

elseif( isset ($monitor_id))
{
    $result = $api->getMonitorStatus($monitor_id);
    handleStatusCodeExit($result['status'], $result['message']);
}


function handleStatusCodeExit( $status, $message)
{
    echo "MSG {$message}";
    if ($status == "CRIT")
    {
        exit(1);
    }
    elseif( $status == "WARN")
    {
        exit(2);
    }
    elseif( $status == "UNKNOWN")
    {
        exit(3);
    }
    elseif( $status == "OK")
    {
        exit(0);
    }
}

?>