# ZabbixTraffixLights
Simple php script for generate div like traffic lights for zabbix triggers

Using ZabbixApi.php from: https://github.com/intellitrend/zabbixapi-php

Usage: 

1. Copy php scripts to web server.
2. Fill config.php with auth and params (host names and trigger id's from your zabbix).
3. Try if everything works with browser (https://your-server/dir/widget.php)
4. Add URL widget to zabbix dashboard, pointing to your widget.php

Note:

For better security, it's recommended to have config.php outside of http server dirs.
