<?php
General::validateSession('expert_email', __SITE_URL);
appController::countExpertPendingCalls($_SESSION['expert_id']);
$loggedExpertArray = appController::getExpertByEmail($_SESSION['expert_email']);
$ExpertArray = array();
foreach($loggedExpertArray[0] as $loggedKey=>$loggedValue)
{
    $ExpertArray[$loggedKey] = $loggedValue;
}
?>
<div id="header">
    <div id="headerContent">
        <div id="topNav" class="right">
            <ul>
                <li id="indexTab"><a href="<?=__SITE_URL?>expert/index"><img
                        src="<?=__TEMPLATE_URL?>images/home-icon.png"
                        alt="Home"/>My
                                    Home</a></li>
                <li id="aboutTab"><a href="<?=__SITE_URL?>expert/index"><img
                        src="<?=__TEMPLATE_URL?>images/about-icon.png"
                        alt="Statistics"/>My
                                          Statistics</a></li>
                <li id="aboutTab"><a href="<?=__SITE_URL?>expert/settings"><img
                        src="<?=__TEMPLATE_URL?>images/about-icon.png"
                        alt="Settings"/>Settings</a>
                </li>
                <li id="loginTab"><a href="<?=__SITE_URL?>expert/signout"><img
                        src="<?=__TEMPLATE_URL?>images/login-icon.png"
                        alt="Log Out"/>Log
                                       Out</a></li>
            </ul>
        </div>

        <!-- Image Based Logo -->
        <h1 id="logoImage"><a href="#" title="Technical support"><img src="<?=__TEMPLATE_URL?>images/logo.png"
                                                                      alt="Technical Support"/></a></h1>
    </div>
    <div class="clear"></div>
</div>