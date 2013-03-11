<?php require_once(__TEMPLATE_PATH . "header.php"); ?>
<script type="text/javascript" language="javascript" src="<?=__TEMPLATE_URL?>scripts/modal-window.js"></script>
<script type="text/javascript" lang="javascript">
	var openMyModal = function(source)
	{
		modalWindow.windowId = "myModal";
		modalWindow.width = 480;
		modalWindow.height = 405;
		modalWindow.content = "<iframe width='480' height='405' frameborder='0' scrolling='no' allowtransparency='true' src='" + source + "'>&lt/iframe>";
		modalWindow.open();
	};	
	</script>
    
<style type="text/css">
.modal-overlay
	{
		position:fixed;
		top:0;
		right:0;
		bottom:0;
		left:0;
		height:100%;
		width:100%;
		margin:0;
		padding:0;
		background:#fff;
		opacity:.75;
		filter: alpha(opacity=75);
		-moz-opacity: 0.75;
		z-index:101;
	}
	* html .modal-overlay
	{   
		position: absolute;
		height: expression(document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + 'px');
	}
	.modal-window
	{
		position:fixed;
		top:50%;
		left:50%;
		margin:0;
		padding:0;
		z-index:102;
	}
	* html .modal-window
	{
		position:absolute;
	}
	.close-window
	{
		position:absolute;
		width:32px;
		height:32px;
		right:27px;
		top:27px;
		background:transparent url('<?=__TEMPLATE_URL?>images/close-button.png') no-repeat scroll right top;
		text-indent:-99999px;
		overflow:hidden;
		cursor:pointer;
		opacity:.5;
		filter: alpha(opacity=50);
		-moz-opacity: 0.5;
	}
	.close-window:hover
	{
		opacity:.99;
		filter: alpha(opacity=99);
		-moz-opacity: 0.99;
	}
</style>
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
                <h4>List of Feedbacks</h4>

                <table width="100%" border="0" cellspacing="4" cellpadding="4" class="table_content">
                    <?php
                    if (is_array($FeedbackListArray['result_set']) && count($FeedbackListArray['result_set']) > 0)
                    {
                    ?>
                        <tr style="background-color:#e5f1fc; padding:2px;">
                            <th width="7%" align="left" valign="top">Sl. No.</th>
                            <th width="17%" align="left" valign="top">Name</th>
                            <th width="28%" align="left" valign="top">Email</th>
                            <th width="17%" align="left" valign="top">Phone Number</th>
                            <th width="15%" align="left" valign="top">Start Point</th>
                            <th width="8%">Comments</th>
                            <th width="8%">Date Time</th>
                            <th width="8%">Action</th>
                        </tr>
                        <?php

                        $i = 1;
                        foreach ($FeedbackListArray['result_set'] as $feedbackArray) {
							$feedbackId = $this->registry->security->encryptData($feedbackArray['advice_feedback_id']);
                            ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$feedbackArray['user_fullname']?></td>
                                <td><?=$feedbackArray['user_email_address']?></td>
                                <td><?=$feedbackArray['user_phone_number']?></td>
                                <td><?=$feedbackArray['star_value']?></td>
                                <td><?=$feedbackArray['feedback_comment']?></td>
                                <td><?=General::getFormatedDate($feedbackArray['feedback_datetime'])?></td>
                                <td><a class="icoMr" onclick="openMyModal('<?=__SITE_URL?>expert/read_feedback/feedback_id:<?=$feedbackId?>'); return false;" href="<?=__SITE_URL?>expert/read_feedback/feedback_id:<?=$feedbackId?>">Read</a></td>
                                
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        <tr>
                            <td colspan="8">
                                <?php
                                $paginationContent = General::getFullNavigation($FeedbackListArray['total_rows'], $FeedbackListArray['total_pages'], $PresentPage, "expert/expertFeedbacks");
                                echo $paginationContent;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8">
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