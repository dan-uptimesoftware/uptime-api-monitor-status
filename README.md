uptime-api-monitor-status
=========================

Check the Status and other details of another Service Monitor via the uptime api. Similar to making an api call to /api/v1/monitors/ID/status

##Input Variables
 * api port
 * username
 * password
 * monitor_id
 * mirror_mode - Will Mirror the Status of the remote monitor( overrides output thersholding)

##Output Variables
 * Monitor Status
 * Monitor Msg
 * Monitor Name
 * Element Name
