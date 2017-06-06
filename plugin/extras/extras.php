<?php
defined('ROOT') OR exit('No direct script access allowed');

## Traitements à effecturer lors de l'installation du plugin
function extrasInstall(){
}

## Hook (header admin)
function extrasAdminHead(){
    $data = '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">';
    $data.= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>'."\n";
    $data.= '<script src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.min.js"></script>'."\n";
    $data.= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css" />'."\n";
    $data.= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/slicknav.min.css" type="text/css" />'."\n";
    $data.= '<style type="text/css">.slicknav_menu{display:none;background:#2c313b;}</style><script>$(document).ready(function(){$("#navigation").slicknav({"label":""});});</script>';
    echo $data;
}

## Hook (header thème)
function extrasFrontHead(){
    $plugin = pluginsManager::getInstance()->getPlugin('extras');
    $data = '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">';
    $data.= '<meta name="generator" content="99ko CMS" />'."\n";
    $data.= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>'."\n";
    $data.= '<script src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.min.js"></script>'."\n";
    $data.= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css" />'."\n";
    $data.= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/slicknav.min.css" type="text/css" />'."\n";
    $data.= '<style type="text/css">.slicknav_menu{z-index:9999;display:none;background:transparent;position:fixed;width:100%;padding:0px;}.slicknav_nav{background:#222;}@media only screen and (max-width: '.$plugin->getConfigVal('breakpointMenu').'px){#navigation{display: none !important;}.slicknav_menu{display: block;}</style><script>$(document).ready(function(){$("#navigation").slicknav({"label":""});});</script>';
    echo $data;
}
?>