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
                <h4>List of Payments done to you</h4>


                <table width="100%" border="0" cellspacing="4" cellpadding="4" class="table_content">
                    <?php
                    if (is_array($ExpertEarningArray['result_set']) && count($ExpertEarningArray['result_set']) > 0)
                    {
                    ?>
                        <tr>
                          <td colspan="3" align="center" valign="top">
                          	Total Amount Paid to you: <strong>$<?=appController::countTotalAmountPaidByExpertId($_SESSION['expert_id'])?></strong> | Total Pending Amount: <strong>$<?=appController::countTotalAmountPendingByExpertId($_SESSION['expert_id'])?></strong>
                          </td>
                        </tr>
                        <tr style="background-color:#e5f1fc; padding:2px;">
                            <th width="7%" align="left" valign="top">Sl. No.</th>
                            <th width="17%" align="left" valign="top">Paid Amount</th>
                            <th width="28%" align="left" valign="top">Paid Date</th>
                        </tr>
                        <?php

                        $i = 1;
                        foreach ($ExpertEarningArray['result_set'] as $earningArray) {
                            ?>
                            <tr>
                                <td><?=$i?></td>
                                <td>$<?=$earningArray['paid_amount']?></td>
                                <td><?=General::getFormatedDate($earningArray['paid_datetime'])?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        <tr>
                            <td colspan="7">
                                <?php
                                $paginationContent = General::getFullNavigation($ExpertEarningArray['total_rows'], $ExpertEarningArray['total_pages'], $PresentPage, "expert/expertUserList");
                                echo $paginationContent;
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    else
                    {
                    ?>
                        <tr>
                            <td colspan="7" >
                                <div class="no_records">No records found.</div>                            </td>
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