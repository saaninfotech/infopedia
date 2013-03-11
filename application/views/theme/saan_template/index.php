<?php require_once("header.php"); ?>

</head>

<body id="home">
<!-- Header Section -->
<?php require_once("header_section.php"); ?>
<!-- / Header Section -->

<!-- Main Section -->
<div id="main">
    <div id="mainContent">

        <!-- Left Column -->
        <!-- / Left Column -->
        <!-- Center Column -->
        <div id="centerCol" class="left">

            <?php require_once("search.php"); ?>

            <!-- Recent / Popular Questions Section -->
            <div id="tabWidget1">
                <!-- Navigation Tabs -->
                <div id="wTabs1">
                    <ul>
                        <li class="on"><a href="javascript:showWidget(0,1)"><img
                                src="<?=__TEMPLATE_URL?>images/clock-icon.png"
                                alt="Clock"/>Recent Joined Experts</a></li>
                        <li><a href="javascript:showWidget(1,1)"><img
                                src="<?=__TEMPLATE_URL?>images/big-grey-star-icon.png"
                                alt="Star"/>Popular Experts</a></li>
                    </ul>
                </div>
                <div class="reset"></div>
                <div class="bordsp10"></div>
                <!-- /Navigation Tabs -->

                <!-- Tabs Content Blocks -->
                <div id="wContent">

                    <!-- Recent Joined Experts -->
                    <div class="wContentBox">
                        <div class="greyBox2">
                            <div class="greyBoxInner2">


                                <!------------------------------- Start: List of Recetnly Joined Experts -------------------------------------->
                                <?php
                                if (is_array($ExpertListLatest) && count($ExpertListLatest) > 0) {
                                    foreach ($ExpertListLatest as $expertKey => $expertValue) {
                                        ?>
                                        <div class="question">
                                            <div class="left">
                                                <a href="#" title="<?=ucwords($expertValue['expert_name'])?>"
                                                   alt="<?=ucwords($expertValue['expert_name'])?>"><img
                                                        alt='<?=ucwords($expertValue['expert_name'])?>'
                                                        title="<?=ucwords($expertValue['expert_name'])?>"
                                                        src='<?=__VIEW_URL?>uploads/expert_profile_image/<?php echo (file_exists(__VIEW_PATH . "uploads/expert_profile_image/" . $expertValue['expert_photo'])) ? $expertValue['expert_photo'] : "default.jpg"?>'
                                                        class='avatar avatar-50 photo' height='67' width='67'/></a>
                                                <br>
                                                <div style="margin-top:5px; width:67px; text-align:center;">
                                                	<img src="<?=__TEMPLATE_URL . "images/"?><?php echo ($expertValue['expert_login_status']=="online")?"online.png":"offline.png" ?>" width="80" height="20">
                                                </div>
                                            </div>
                                            <div class="left questionMain">

                                                <h4>
                                                	<a href="javascript:void(0);"><?=ucwords($expertValue['expert_name'])?></a>
                                                </h4>

                                                <p><?=$expertValue['expert_credential_description']?></p>

                                                <div class="questionByline">
                                                    <a href=""><img src="<?=__TEMPLATE_URL?>images/num-answer-icon.png"
                                                                    alt="Answers"/></a>
                                                    <span class="answers"><a href=""><?=($expertValue['expert_total_advice'] > 0)?$expertValue['expert_total_advice']:"No"?> Answer(s)</a></span>
                                                    <span>Domain: <a href="javascript:void(0);"
                                                                     title="<?=$expertValue['expert_category_name']?>"
                                                                     rel="category tag"><?=$expertValue['expert_category_name']?></a></span>

                                                    <span class="points">[<span><?=$expertValue['expert_total_points']?></span> <img
                                                            src="<?=__TEMPLATE_URL?>images/grey-star-points-icon.png"
                                                            alt="Grey Star Level" title="Grey Star Level"/>]</span>
                                                    <span>Member Since: <?=General::getFormatedDate($expertValue['expert_email_active_date'])?></span>
                                                </div>
                                                <div style="text-align:right;">
                                                	<span>
                                                    	<a href="<?=__SITE_URL?>advice/request/expert:<?php echo $this->registry->security->encryptData($expertValue['expert_email']);?>" title="Get an Advice from <?=ucwords($expertValue['expert_name'])?>">
                                                        	<img src="<?=__TEMPLATE_URL . "images/advice_button.jpg"?>" width="100" height="20">
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No Experts have registered yet!";
                                }
                                ?>
                                <!----------------------------------End: List of Recetnly Joined Experts ------------------------------------------>

                                <!-- <div class="navigation">
                                    <div class="whiteBtn right"><a href="#/page/2/"><span>Next Questions &raquo;</span></a>
                                    </div>
                                    <div class="whiteBtn left"></div>
                                    <div class="clear"></div>
                                </div> -->


                            </div>
                        </div>
                    </div>
                    <!-- /Recent Joined Experts -->

                    <!-- Popular Joined Experts -->
                    <div class="wContentBox" style="display:none;">
                        <div class="greyBox2">
                            <div class="greyBoxInner2">
                                <!-- <p class="right"><em>Top 25 from the last 30 Days</em></p> -->

                                <div class="clear"></div>

                                <!------------------------------------------------ Start: Question --------------------------------------------->
                                <?php
                                if (is_array($ExpertListPopular) && count($ExpertListPopular) > 0) {
                                    foreach ($ExpertListPopular as $expertPopKey => $expertPopValue) {
                                        ?>
                                        <div class="question">
                                            <div class="left">
                                                <a href="#" title="<?=ucwords($expertPopValue['expert_name'])?>"
                                                   alt="<?=ucwords($expertPopValue['expert_name'])?>"><img
                                                        alt='<?=ucwords($expertPopValue['expert_name'])?>'
                                                        title="<?=ucwords($expertPopValue['expert_name'])?>"
                                                        src='<?=__VIEW_URL?>uploads/expert_profile_image/<?php echo (file_exists(__VIEW_PATH . "uploads/expert_profile_image/" . $expertPopValue['expert_photo'])) ? $expertPopValue['expert_photo'] : "default.jpg"?>'
                                                        class='avatar avatar-50 photo' height='67' width='67'/></a>
                                                <br>
                                                <div style="margin-top:5px; width:67px; text-align:center;">
                                                	<img src="<?=__TEMPLATE_URL . "images/"?><?php echo ($expertPopValue['expert_login_status']=="online")?"online.png":"offline.png" ?>" width="80" height="20">
                                                </div>
                                            </div>
                                            <div class="left questionMain">

                                                <h4>
                                                	<a href="javascript:void(0);"><?=ucwords($expertPopValue['expert_name'])?></a>
                                                </h4>

                                                <p><?=$expertPopValue['expert_credential_description']?></p>

                                                <div class="questionByline">
                                                    <a href=""><img src="<?=__TEMPLATE_URL?>images/num-answer-icon.png"
                                                                    alt="Answers"/></a>
                                                    <span class="answers"><a href=""><?=($expertPopValue['expert_total_advice'] > 0)?$expertPopValue['expert_total_advice']:"No"?> Answer(s)</a></span>
                                                    <span>Domain: <a href="javascript:void(0);"
                                                                     title="<?=$expertPopValue['expert_category_name']?>"
                                                                     rel="category tag"><?=$expertPopValue['expert_category_name']?></a></span>

                                                    <span class="points">[<span><?=$expertPopValue['expert_total_points']?></span> <img
                                                            src="<?=__TEMPLATE_URL?>images/grey-star-points-icon.png"
                                                            alt="Grey Star Level" title="Grey Star Level"/>]</span>
                                                    <span>Member Since: <?=General::getFormatedDate($expertPopValue['expert_email_active_date'])?></span>
                                                </div>
                                                <div style="text-align:right;">
                                                	<span>
                                                    	<a href="<?=__SITE_URL?>advice/request/expert:<?php echo $this->registry->security->encryptData($expertPopValue['expert_email']);?>" title="Get an Advice from <?=ucwords($expertPopValue['expert_name'])?>">
                                                        	<img src="<?=__TEMPLATE_URL . "images/advice_button.jpg"?>" width="100" height="20">
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No Experts have registered yet!";
                                }
                                ?>
                                <!-----------------------------------------------Start: / Question ---------------------------------------------------->


                            </div>
                        </div>
                    </div>
                    <!-- Popular Joined Experts -->

                </div>
                <!-- Tabs Content Blocks -->
                <div class="reset"></div>
            </div>
            <!-- Recent / Popular Questions Section -->

        </div>
        <!-- / Center Column -->
        <!-- Right Column -->
        <?php require_once("right_section.php"); ?>
        <!-- / Right Column -->
        <div class="clear"></div>


    </div>
    .
</div>
<!-- / Main Section -->


<!-- Footer Section -->
<?php require_once("footer.php"); ?>
<!-- / Footer Section -->

</body>
</html>
