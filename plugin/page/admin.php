<?php
defined('ROOT') OR exit('No direct script access allowed');

$mode = '';
$action = (isset($_GET['action'])) ? urldecode($_GET['action']) : '';
$msg = (isset($_GET['msg'])) ? urldecode($_GET['msg']) : '';
$msgType = (isset($_GET['msgType'])) ? $_GET['msgType'] : '';
$error = false;
$hideTitles = $runPlugin->getConfigVal('hideTitles');
$page = new page();

switch($action){
	case 'save':
		if($administrator->isAuthorized()){
			if($_POST['id'] != '') $pageItem = $page->create($_POST['id']);
			else $pageItem = new pageItem();
			$pageItem->setName($_POST['name']);
			$pageItem->setPosition($_POST['position']);
			$pageItem->setIsHomepage((isset($_POST['isHomepage'])) ? 1 : 0);
			$pageItem->setContent((isset($_POST['content'])) ? $_POST['content'] : '');
			$pageItem->setFile((isset($_POST['file'])) ? $_POST['file'] : '');
			$pageItem->setIsHidden((isset($_POST['isHidden'])) ? 1 : 0);
			$pageItem->setMainTitle((isset($_POST['mainTitle'])) ? $_POST['mainTitle'] : '');
			$pageItem->setMetaDescriptionTag((isset($_POST['metaDescriptionTag'])) ? $_POST['metaDescriptionTag'] : '');
			$pageItem->setMetaTitleTag((isset($_POST['metaTitleTag'])) ? $_POST['metaTitleTag'] : '');
			$pageItem->setTarget((isset($_POST['target'])) ? $_POST['target'] : '');
			$pageItem->setTargetAttr((isset($_POST['targetAttr'])) ? $_POST['targetAttr'] : '');
			$pageItem->setNoIndex((isset($_POST['noIndex'])) ? 1 : 0);
			$pageItem->setParent((isset($_POST['parent'])) ? $_POST['parent'] : '');
			if($page->save($pageItem)){
				$msg = $core->lang("The changes have been saved.");
				$msgType = 'success';
			}
			else{
				$msg = $core->lang("An error occurred while saving the changes.");
				$msgType = 'error';
			}
			header('location:index.php?p=page&msg='.urlencode($msg).'&msgType='.$msgType);
			die();
		}
		break;
	case 'edit':
		if(isset($_GET['id'])) $pageItem = $page->create($_GET['id']);
		else $pageItem = new pageItem();
		$isLink = (isset($_GET['link']) || $pageItem->targetIs() == 'url') ? true : false;
		$isParent = (isset($_GET['parent']) || $pageItem->targetIs() == 'parent') ? true : false;
		$mode = 'edit';
		break;
	case 'del':
		if($administrator->isAuthorized()){
			$pageItem = $page->create($_GET['id']);
			if($page->del($pageItem)){
				$msg = $core->lang("The changes have been saved.");
				$msgType = 'success';
			}
			else{
				$msg = $core->lang("An error occurred while saving the changes.");
				$msgType = 'error';
			}
			header('location:index.php?p=page&msg='.urlencode($msg).'&msgType='.$msgType);
			die();
		}
		break;
	case 'up':
		if($administrator->isAuthorized()){
			$pageItem = $page->create($_GET['id']);
			$newPos = $pageItem->getPosition()-1;
			$pageItem->setPosition($newPos);
			$page->save($pageItem);
			header('location:index.php?p=page');
			die();
		}
		break;
	case 'down':
		if($administrator->isAuthorized()){
			$pageItem = $page->create($_GET['id']);
			$newPos = $pageItem->getPosition()+2;
			$pageItem->setPosition($newPos);
			$page->save($pageItem);
			header('location:index.php?p=page');
			die();
		}
		break;
	default:
		$mode = 'list';
}
?>