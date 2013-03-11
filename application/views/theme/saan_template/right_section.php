<div id="rightCol" class="left">

    <!-- Log In - Sign Up - Admin Options -->
    <div class="greyBox">
        <div class="greyBoxInner signup" style="background-color:#fef2df;">
            <!-- Sign Up -->
            <h3 class="signupTitle">Sign Up</h3>

            <p>Become a technical adviser and make money in your spare time!</p>

            <div class="signupBtn"><a href="<?=__SITE_URL?>signup"><span>Sign Up Now</span></a></div>
            <div class="clear"></div>
        
        </div>
        
    </div>
    <div class="greyBox">
        
        <div class="greyBoxInner signup" style="background-color:#effeee;">
           
            <!-- Member Login -->
            <h3>Experts Log In Here</h3>

            <div class="whiteBtn marTop10"><a href="<?=__SITE_URL?>login"><span>Log In Now &raquo;</span></a></div>
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
            <h3>Domain Categories</h3>

            <p>Get Registered as an Expert in any of the following domains!</p>
            <?php
            appController::getCategoryListWithCount();
            if (is_array(appController::$CategoryList) && count(appController::$CategoryList) > 0) {
                foreach (appController::$CategoryList as $categoryKey => $categoryValue) {
                    ?>
                    <div class="pointRow">
                        <span class="points"><?=$categoryValue['category_name']?>(<?=$categoryValue['count_value']?>
                                                                                 )</span>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <!-- ----------------------------------------- End: This is the Expert Categories Section ------------------------------- -->


    <div class="yellowBox">
        <div class="yellowBoxInner pointsBox">
            <h3>Star Points Scale</h3>

            <p>Earn points for giving the Expert Advice and Solution!</p>

            <div class="pointRow">
                <span class="right bigStar"><img src="<?=__TEMPLATE_URL?>images/grey-star-big.png"
                                                 alt="Grey Sta Levelr"/></span>
                <span class="points">[<span>1 - 25</span> <img src="<?=__TEMPLATE_URL?>images/grey-star-points-icon.png"
                                                               alt="Grey Star Level"/>]</span>
            </div>
            <div class="pointRow">
                <span class="right"><img src="<?=__TEMPLATE_URL?>images/green-star-big.png"
                                         alt="Green Star Level"/></span>
                <span class="points">[<span>26 - 50</span> <img
                        src="<?=__TEMPLATE_URL?>images/green-star-points-icon.png" alt="Green Star Level"/>]</span>
            </div>
            <div class="pointRow">
                <span class="right"><img src="<?=__TEMPLATE_URL?>images/blue-star-big.png"
                                         alt="Blue Star Level"/></span>
                <span class="points">[<span>51 - 500</span> <img
                        src="<?=__TEMPLATE_URL?>images/blue-star-points-icon.png" alt="Blue Star Level"/>]</span>
            </div>
            <div class="pointRow">
                <span class="right"><img src="<?=__TEMPLATE_URL?>images/orange-star-big.png"
                                         alt="Orange Star Level"/></span>
                <span class="points">[<span>501 - 5000</span> <img
                        src="<?=__TEMPLATE_URL?>images/orange-star-points-icon.png" alt="Orange Star Level"/>]</span>
            </div>
            <div class="pointRow">
                <span class="right"><img src="<?=__TEMPLATE_URL?>images/red-star-big.png" alt="Red Star Level"/></span>
                <span class="points">[<span>5001 - 25000</span> <img
                        src="<?=__TEMPLATE_URL?>images/red-star-points-icon.png" alt="Red Star Level"/>]</span>
            </div>
            <div class="pointRow">
                <span class="right"><img src="<?=__TEMPLATE_URL?>images/black-star-big.png"
                                         alt="Black Star Level"/></span>
                <span class="points">[<span>25001+</span> <img
                        src="<?=__TEMPLATE_URL?>images/black-star-points-icon.png" alt="Black Star Level"/>]</span>
            </div>
        </div>
    </div>
    <!-- / Star Points Box -->

    <!-- Ads Box -->
    <!-- Ads Box -->
</div>