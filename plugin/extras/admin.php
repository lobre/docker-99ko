<?php
defined('ROOT') OR exit('No direct script access allowed');

$action = (isset($_GET['action'])) ? $_GET['action'] : '';

switch($action){
	case 'save':
		if($administrator->isAuthorized()){
            $runPlugin->setConfigVal('breakpointMenu', trim($_POST['breakpointMenu']));
            if($pluginsManager->savePluginConfig($runPlugin)){
                $msg = $core->lang("The changes have been saved.");
				$msgType = 'success';
            }
            else{
				$msg = $core->lang("An error occurred while saving the changes.");
				$msgType = 'error';
			}
			header('location:index.php?p=extras&msg='.urlencode($msg).'&msgType='.$msgType);
			die();
		}
		break;
	default:
}
?>