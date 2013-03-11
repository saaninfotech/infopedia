<?php require_once(__TEMPLATE_PATH . "header.php"); ?>
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
            <?=General::getMessage()?>
            <div id="post-2" class="post">
                <h4>List of Customers</h4>

                <table width="100%" border="0" cellspacing="4" cellpadding="4" class="table_content">
                    <?php
                    if (is_array($CustomerListArray['result_set']) && count($CustomerListArray['result_set']) > 0)
                    {
                    ?>
                        <tr style="background-color:#e5f1fc; padding:2px;">
                            <th width="7%" align="left" valign="top">Sl. No.</th>
                            <th width="17%" align="left" valign="top">Name</th>
                            <th width="28%" align="left" valign="top">Email</th>
                            <th width="17%" align="left" valign="top">Phone Number</th>
                            <th width="15%" align="left" valign="top">Date</th>
                            <th width="8%">Status</th>
                            <th width="8%">Action</th>
                        </tr>
                        <?php

                        $i = 1;
                        foreach ($CustomerListArray['result_set'] as $customerArray) {
                            ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$customerArray['user_fullname']?></td>
                                <td><?=$customerArray['user_email_address']?></td>
                                <td><?=$customerArray['user_phone_number']?></td>
                                <td><?=General::getFormatedDate($customerArray['advice_request_datetime'])?></td>
                                <td><?=$customerArray['advice_request_status']?></td>
                                <td>
                                    <?php
                                    if ($customerArray['advice_request_status'] == "open") {
                                        $advice_id = $this->registry->security->encryptData($customerArray['advice_request_id']);
                                        ?>
                                        <a href="<?=__SITE_URL?>expert/updateCallStatus/advice_id:<?=$advice_id?>" onclick="return confirm('Do you want to mark it as Called?');">Called</a>
                                        <?php
                                    }
                                    ?>

                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        <tr>
                            <td colspan="7">
                                <?php
                                $paginationContent = General::getFullNavigation($CustomerListArray['total_rows'], $CustomerListArray['total_pages'], $PresentPage, "expert/expertUserList");
                                echo $paginationContent;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <table width="100%" style="font-size:11.5px;">
                                    <tr style="color:#FF9900;">
                                        <td width="11%">open:</td>
                                        <td width="89%">They are the customers waiting for your call.</td>
                                    </tr>
                                    <tr style="color:#33CC99;">
                                        <td>called:</td>
                                        <td>They are the customers you have already called up.</td>
                                    </tr>
                                    <tr style="color:#00CC00;">
                                        <td>paid_for:</td>
                                        <td>You have been paid for calling these customers:</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <?php
                    }
                    else
                    {
                    ?>
                        <tr>
                            <td colspan="7" >
                                <div class="no_records">No records found.</div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
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
<?php require_once(__TEMPLATE_PATH . "footer.php"); ?>
<!-- / Footer Section -->
</body>
</html>