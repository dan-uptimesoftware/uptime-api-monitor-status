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

if ( isset($_SERVER['UPTIME_MONITOR_ID']) ) {
    $monitor_id = trim($_SERVER['UPTIME_MONITOR_ID']);
}

if ( isset($_SERVER['UPTIME_MIRROR_MODE']) ) {
    $mirror_mode = trim($_SERVER['UPTIME_MIRROR_MODE']);
}

$api = new uptimeApi($username, $password, $hostname, $port);

if( isset ($monitor_id))
{
    $result = $api->getMonitorStatus($monitor_id);
    echo "STATUS {$result['status']}\n";
    echo "msg {$result['message']}\n";
    echo "monitor_name {$result['name']}\n";

    if ($mirror_mode == "on")
    {
        handleStatus($result['status']);
    }
}

//set the local monitor's status to match the remote monitor's status
function handleStatus( $status)
{

    if( $status == "WARN")
    {
        exit(1);
    }
    elseif ($status == "CRIT")
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