<?php require_once __TEMPLATE_PATH . 'header.php'; ?>
</head>
<body id="home">
<!-- Header Section -->
<?php require_once(__TEMPLATE_PATH . "experts/header_section.php"); ?>
<!-- / Header Section -->
<!-- Main Section -->
<div id="main">
    <div id="mainContent">
        <!-- Left Column -->
        <!-- / Left Column -->
        <!-- Center Column -->
        <div id="centerCol" class="left">
            <!-- Search Form -->
            <?php require_once(__TEMPLATE_PATH . "experts/expert_menu.php"); ?>
            <!-- Search Form -->
            <!-- Recent / Popular Questions Section -->
            <?php require_once(__TEMPLATE_PATH . "experts/welcome_text.php"); ?>

            <div id="post-2" class="post">
                <h4>Your Statistics Details</h4>
                <table width="80%" border="0" cellspacing="0" cellpadding="0" style="margin-left:60px; font-size: 12px;">
                    <tr>
                        <td align="center" valign="top" width="43%"><img name=""
                                                                         src="<?=__TEMPLATE_URL?>images/money.jpg"
                                                                         alt=""></td>
                        <td align="center" valign="top" width="33%"><img name=""
                                                                         src="<?=__TEMPLATE_URL?>images/customers.jpg"
                                                                         alt=""></td>
                        <td align="center" valign="top"><img name="" src="<?=__TEMPLATE_URL?>images/feedback.jpg"
                                                             alt=""></td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">&nbsp;</td>
                        <td align="center" valign="top">&nbsp;</td>
                        <td align="center" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                        <?php $priceValue = appController::countTotalAmountPaidByExpertId($_SESSION['expert_id']); ?>
                        <td align="center" valign="top">Total Money Paid To You: <strong>$<?=($priceValue == "")?"0.00":"$priceValue"?></strong><br>
                            Money Pending To Be Paid: <strong>$<?=appController::countTotalAmountPendingByExpertId($_SESSION['expert_id'])?></strong>
                        </td>
                        <td align="center" valign="top">Total Customers: <strong><?=appController::countTotalCustomersByExpertId($_SESSION['expert_id'])?></strong><br>
                            Total Calls Made: <strong><?=appController::countTotalCallsByExpertId($_SESSION['expert_id'])?></strong>
                        </td>
                        <td align="center" valign="top">Total Feedbacks: <strong><?=appController::countTotalFeedbackByExpertId($_SESSION['expert_id'])?></strong><br>
                            Total Points: <strong><?=appController::getTotalPointsByExpertId($_SESSION['expert_id'])?></strong>
                        </td>
                    </tr>
                </table>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</div>
<!-- Popular Questions -->
</div>
<!-- Tabs Content Blocks -->
<div class="reset"></div>
</div>
<!-- Recent / Popular Questions Section -->
</div>
<!-- / Center Column -->
<!-- Right Column -->
<?php require_once(__TEMPLATE_PATH . "experts/right_section.php"); ?>
<!-- / Right Column -->
<div class="clear"></div>
</div>
.
</div>
<!-- / Main Section -->
<!-- Footer Section -->
<?php require_once __TEMPLATE_PATH . 'footer.php'; ?>
<!-- / Footer Section -->
</body>
</html>