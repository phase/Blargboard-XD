<?php
//  AcmlmBoard XD - Administration hub page
//  Access: administrators
if (!defined('BLARG')) die();


CheckPermission('admin.viewadminpanel');

$title = __("Administration");

MakeCrumbs(array(actionLink("admin") => __('Admin')));


if (function_exists('curl_init'))
	$protstatus = __('Enabled (using cURL)');
else if (ini_get('allow_url_fopen'))
	$protstatus = __('Enabled (using fopen)');
else
	$protstatus = __('Disabled');


$adminInfo = array();
$adminInfo[__('Proxy protection')] = $protstatus;
$adminInfo[__('Last viewcount milestone')] = $misc['milestone'];


$adminLinks = array();

if ($loguser['root']) 				$adminLinks[] = actionLinkTag(__("Recalculate statistics"), "recalc");
if (HasPermission('admin.manageipbans'))	$adminLinks[] = actionLinkTag(__("Manage IP bans"), "ipbans");
if (HasPermission('admin.editforums'))		$adminLinks[] = actionLinkTag(__("Manage forum list"), "editfora");
if (HasPermission('admin.editsettings'))	$adminLinks[] = actionLinkTag(__("Manage plugins"), "pluginmanager");
if (HasPermission('admin.editsettings'))	$adminLinks[] = actionLinkTag(__("Edit Settings"), "editsettings");
if (HasPermission('admin.editsettings'))	$adminLinks[] = actionLinkTag(__("Edit Home Page"), "editsettings", '', 'field=homepageText');
if (HasPermission('admin.editsettings'))	$adminLinks[] = actionLinkTag(__("Edit FAQ"), "editsettings", '', 'field=faqText');
if (HasPermission('admin.editsmilies'))		$adminLinks[] = actionLinkTag(__("Manage smilies"), "editsmilies");
if ($loguser['root'])				$adminLinks[] = actionLinkTag(__("Optimize tables"), "optimize");
if (HasPermission('admin.viewlog'))		$adminLinks[] = actionLinkTag(__("View log"), "log");
if (HasPermission('admin.ipsearch'))		$adminLinks[] = actionLinkTag(__('Rereg radar'), 'reregs');
if (HasPermission('admin.ipsearch'))		$adminLinks[] = actionLinkTag(__('Last Known Browsers'), 'lastknownbrowsers');
if ($loguser['root'])		                $adminLinks[] = actionLinkTag(__('Edit Groups'), 'editgroups');
if ($loguser['root'])		                $adminLinks[] = actionLinkTag(__('Add secondary Groups'), 'secgroups');


$bucket = "adminpanel"; include(BOARD_ROOT."lib/pluginloader.php");


RenderTemplate('adminpanel', array('adminInfo' => $adminInfo, 'adminLinks' => $adminLinks));

?>
