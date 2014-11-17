Brigade Checkins
================

This checkin tool lets you post and track attendance at your Brigade events.

To record checkins you can either:
* Use the form at http://www.codeforamerica.org/brigade/checkin/
* POST a checkin also at http://www.codeforamerica.org/brigade/checkin/

To view attendance at your events:
* COMING SOON

## The Check In Form
The form at http://www.codeforamerica.org/brigade/checkin/ can prepoulate the name of the event and the name of the Brigade using url parameters. For example `http://www.codeforamerica.org/brigade/checkin/?event=Hack+Night&brigade=Code+for+San+Francisco` will have the event name set to Hack Night and the Brigade name as Code for San Francisco.

## POSTing a Check In
If your Brigade has built its own attendace tool, have it post to http://www.codeforamerica.org/brigade/checkin as well. It will be expecting data to look like:
```
{
  "name" : "Caeser Chavez",
  "email" : "cchavez@ufw.org,
  "event" : "Labor Protest",
  "brigade" : "United-Farm-Workers"
}

```
The `brigade` attribute should be your Brigade's ID on the CfAPI. For example Code for San Francisco is on the CfAPI at http://codeforamerica.org/api/organizations/Code-for-San-Francisco so the ID is `Code-for-San-Francisco`.



Contacts
--------

* Andrew Hyder ([ondrae](https://github.com/ondrae))
