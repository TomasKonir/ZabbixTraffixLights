<?php
require_once("ZabbixApi.php");

use IntelliTrend\Zabbix\ZabbixApi;
use IntelliTrend\Zabbix\ZabbixApiException;

$zabUrl ='http://zabbix.doma/';
$zabUser = 'Admin';
$zabPassword = 'zabbix';

$params = array(
	0 => array(
		'name' => 'TEST1',
		'host' => 'nas',
		'triggerid' => '23983'
	),
	1 => array(
		'name' => 'TEST2',
		'host' => 'nas',
		'triggerid' => '23977'
	),
	2 => array(
		'name' => 'TEST3',
		'host' => 'nas',
		'triggerid' => '23974'
	),
);

$zbx = new ZabbixApi();
try {
	$zbx->login($zabUrl, $zabUser, $zabPassword);
	echo '<div style="display:flex;flex-direction:column;gap:0.5rem">';
	foreach($params as $p){
		$result = $zbx->call('trigger.get',array("host" => $p['host'], "triggerids" => $p['triggerid']));
		$color = 'orange';
		$text = $p["name"];
		if(count($result) == 0){
			$color = 'yellow';
		} else {
			$status = $result[0]["status"];
			if($status == 0){
				$color = 'green';
			} else {
				$color = 'red';
			}
		}
		print '<div style="display:flex;color:white;"><div style="margin-top:auto;margin-bottom:auto;font-weight:bold;">'.$text.'</div><div style="margin-left:auto;background-color:'.$color.';width:2rem;height:2rem;border-radius:1rem"></div></div>';
	}
	echo '</div>';
} catch (ZabbixApiException $e) {
	print "<div> Trigger failed with: ";
	print 'Errorcode: '.$e->getCode()."\n";
	print 'ErrorMessage: '.$e->getMessage()."\n";
	print "</div>";
	exit;
} catch (Exception $e) {
	print "<div> Exception with: ";
	print 'Errorcode: '.$e->getCode()."\n";
	print 'ErrorMessage: '.$e->getMessage()."\n";
	print "</div>";
	exit;
}
