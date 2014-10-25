<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); } 

/**
 * 云签到内部计划任务
 *
 */

function cron_system_sign() {
	global $i;

	$today = date('Y-m-d H:m:s');

	$sign_again = unserialize(option::get('cron_sign_again'));
	if ($sign_again['lastdo'] != $today) {
		option::set('cron_sign_again',serialize(array('num' => 0, 'lastdo' => $today)));
	}

	foreach ($i['table'] as $value) {
		$return = misc::DoSign($value,unserialize(option::get('sign_mode')));
	}
}
