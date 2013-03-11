<div id="rightCol" class="left">

    <!-- Log In - Sign Up - Admin Options -->
    <div class="greyBox">
        <div class="greyBoxInner signup">
            <div align="center"><img src="<?=appController::getExpertProfileImage($ExpertArray['expert_photo'])?>" width="80"
                                     height="80" title="" alt="" style="border:1px solid;"/></div>
            <div class="divider"></div>
            <!-- / Sign Up -->

            <!-- Member Login -->
            <div align="center"><h3><?=ucwords($ExpertArray['expert_name'])?></h3></div>
            <div align="center" class="marTop10" style="font-size:11px;">
                <?php
                    $loginDatetimeArray = appController::getExpertLastLogin($_SESSION['expert_id']);
                ?>
                Last Login: <?=General::getFormatedDate($loginDatetimeArray[0]['login_datetime'])?>
            </div>
            <div class="clear"></div>
            <!-- / Member Login -->

        </div>
    </div>
    <!-- / Log In - Sign Up - Admin Options -->

    <!-- Dynamic Sidebar -->
    <!-- / Dynamic Sidebar -->

    <!-- Star Points Box -->
    <!-- ----------------------------------------- Start: This is the Expert Categories Section ------------------------------- -->
    <div class="yellowBox">
        <div class="yellowBoxInner pointsBox">
            <h3>Notifications...</h3>

            <p>Please have a look at the following points. You have:</p>

            <div class="pointRow">
                <span class="points">Pending Calls: <span class="verified"><?=$_SESSION['expert_pending_calls']?></span></span>
            </div>
            <div class="pointRow">
                <span class="points">Unread Feedbacks: <span class="verified"><?=appController::countTotalFeedbackByExpertId($_SESSION['expert_id'], "unread")?></span></span>
            </div>
            <div class="pointRow">
                <span class="points">Email Verification: <span class="verified">Verified</span></span>
            </div>
            <div class="pointRow">
                <span class="points">Phone Verification:</span>
            </div>
            <div class="pointRow">
                <span class="points">Admin Message:</span>
            </div>
        </div>
    </div>
    <!-- ----------------------------------------- End: This is the Expert Categories Section ------------------------------- -->


    <!-- / Star Points Box -->

    <!-- Ads Box -->
    <!-- Ads Box -->
</div>