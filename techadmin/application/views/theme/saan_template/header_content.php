<div id="main">
    <!-- Tray -->
    <div id="tray" class="box">
        <p class="f-left box">
            <!-- Switcher -->
				<span class="f-left" id="switcher">
					<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img
                            src="<?=__TEMPLATE_URL?>images/switcher-1col.gif" alt="1 Column"/></a>
					<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img
                            src="<?=__TEMPLATE_URL?>images/switcher-2col.gif" alt="2 Columns"/></a>
				</span>
            Project: <strong><?php echo "Infopedia";?></strong>
        </p>

        <p class="f-right">
            User: <strong><a href="#"><?php echo $_SESSION['adminLogin']; ?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <strong><a href="<?=__SITE_URL?>adminhome/signout" id="logout">Log out</a></strong>
        </p>
    </div>
    <!--  /tray -->
    <hr class="noscreen"/>
    <!-- Menu -->
    <div id="menu" class="box">

        <ul class="box f-right">
            <li><a href="<?php echo __SITE_URL; ?> " target="_blank"><span><strong>Visit
                                                                                   Site &raquo;</strong></span></a>
            </li>
        </ul>
        <ul class="box">
            <li><a href="<?=__SITE_URL?>adminhome/view_category"><span>Category</span></a></li>
            <li><a href="<?=__SITE_URL?>adminhome/view_experts"><span>Experts</span></a></li>
            <li><a href="<?=__SITE_URL?>adminhome/view_templates"><span>Email Templates</span></a></li>
            <li><a href="<?=__SITE_URL?>adminhome/view_transactions"><span>Transactions</span></a></li>
            <li><a href="<?=__SITE_URL?>adminhome/view_expert_earning"><span>Expert Earning</span></a></li>
            <li><a href="<?=__SITE_URL?>adminhome/view_payable_experts"><span>Payable Experts</span></a></li>
            <li><a href="<?=__SITE_URL?>adminhome/view_expert_payment"><span>Expert Payment</span></a></li>
            <li><a href="<?=__SITE_URL?>adminhome/view_expert_feedback"><span>Expert Feedback</span></a></li>
            <li><a href="<?=__SITE_URL?>adminhome/view_app_setting"><span>App Setting</span></a></li>
            <!-- Active -->
        </ul>
    </div>