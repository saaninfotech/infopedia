<?php
$uriArray = explode("/", $_SERVER['REQUEST_URI']);
$lastURIArray = explode(".", $uriArray[(count($uriArray) - 1)]);
$pageNameValue = $lastURIArray[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title><?=$Title?></title>
    <link rel="stylesheet" type="text/css" href="<?=__TEMPLATE_URL?>styles/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?=__TEMPLATE_URL?>styles/blue-meadow-styles.css"/>
    <link rel='stylesheet' id='A2A_SHARE_SAVE-css' href='<?=__TEMPLATE_URL?>styles/addtoany.min.css?ver=1.0'
          type='text/css' media=''/>
    <script language="javascript" type="text/javascript" src="<?=__TEMPLATE_URL?>scripts/jquery-1.8.3.min.js"></script>
    <!-- <script type="text/javascript" src="<?=__TEMPLATE_URL?>scripts/check_browser_close.js"></script> -->
    <!--[if IE]>
    <style type="text/css">
        ul.addtoany_list a img {
            filter: alpha(opacity = 70)
        }

        ul.addtoany_list a:hover img, ul.addtoany_list a.addtoany_share_save img {
            filter: alpha(opacity = 100)
        }
    </style>
    <![endif]-->
    <!--[if IE 6]>
    <script src="<?=__TEMPLATE_URL?>scripts/DD_belatedPNG_0.0.7a-min.js"></script>
    <script>
        DD_belatedPNG.fix('img, #main, #topNav');
    </script>
    <link rel="stylesheet" type="text/css" href="<?=__TEMPLATE_URL?>styles/styles-ie6.css"/>
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="<?=__TEMPLATE_URL?>styles/styles-ie7.css"/>
    <![endif]-->

    <script type="text/javascript" src="<?=__TEMPLATE_URL?>scripts/tab-widget.js"></script>