<?php
if (!defined('IN_AOS'))
{
    die('Hacking attempt');
}

if (isset ( $set_modules ) && $set_modules == TRUE) {
	$i = isset ( $modules ) ? count ( $modules ) : 0;
	$modules [$i] ['code'] = basename ( __FILE__, '.php' );
	$modules [$i] ['config'] = array (
		array ('name' => 'appId','value' => ''),
		array ('name' => 'appSecret','value' => ''),
		array ('name' => 'partnerId','value' => ''),
		array ('name' => 'partnerKey','value' => '') 
	);
	return;
}
?>