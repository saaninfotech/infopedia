<?php require_once("header.php"); ?>
<style type="text/css">
#signup_dynamic_content
{
	
}
#signup_dynamic_content img
{
	max-width:700px;
}
</style>
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

                <div class="reset"></div>
                <div class="bordsp10"></div>
                <!-- /Navigation Tabs -->

                <!-- Tabs Content Blocks -->
                <div id="wContent">

                    <!-- Recent Questions -->
                    <div class="wContentBox">
                        <div class="greyBox3">
                            <div class="greyBoxInner3 page">
                                <div id="signup_dynamic_content">
                                    <?=appController::getAppSettingBySettingName('signup_page_content')?>
                                </div>
                                <div id="markup">
                                    <?=General::getMessage()?>
                                </div>
                                <h2>Sign Up</h2>


                                <!-- Show Form Errors -->
                                <!-- / Show Form Errors -->

                                <div class="formImage right"><img src="<?=__TEMPLATE_URL?>images/signup-image.png"
                                                                  alt="Sign Up"></div>
                                <!-- Sign Up Form -->
                                <form name="signupform" id="signupform" action="<?=__SITE_URL?>signup/register#markup"
                                      method="post">

                                    <label>Full Name:<span class="asterixRequired">*</span></label>
                                    <fieldset><input name="expert_name" id="expert_name" class="text"
                                                     value="<?=$PostRetain['expert_name']?>" type="text"></fieldset>

                                    <label>Phone Number:<span class="asterixRequired">*</span></label>
                                    <div class="help_text">Customer Information will be sent to this number</div>
                                    <fieldset><input name="expert_phone_number" id="expert_phone_number" class="text"
                                                     value="<?=$PostRetain['expert_phone_number']?>" type="text">
                                    </fieldset>

                                    <label>Email:<span class="asterixRequired">*</span></label>
                                    <div class="help_text">This will be your userid to login.</div>
                                    <fieldset><input name="expert_email" id="expert_email" class="text"
                                                     value="<?=$PostRetain['expert_email']?>" type="text"></fieldset>

                                    <label>Paypal Id:<span class="asterixRequired">*</span></label>
                                    <div class="help_text">This is the Paypal aaccount where the money will be transfered to you.</div>
                                    <fieldset><input name="expert_paypal" id="expert_paypal" class="text"
                                                     value="<?=$PostRetain['expert_paypal']?>" type="text"></fieldset>


                                    <label>Category:<span class="asterixRequired">*</span></label>
                                    <div class="help_text">Choose the category in which you have an expertise.</div>
                                    <fieldset>
                                        <select name="expert_category">
                                            <option value="0">Select Category</option>
                                            <?php
                                            foreach ($CategoryArray as $categoryKey => $categoryValue) {
                                                ?>
                                                <option value="<?=$categoryValue['expert_category_id']?>" <?=($PostRetain['expert_category'] == $categoryValue['expert_category_id']) ? "selected" : "" ?> ><?=$categoryValue['expert_category_name']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <label>Address:</label>
                                    <fieldset><textarea
                                            name="expert_address"><?=$PostRetain['expert_address']?></textarea>
                                    </fieldset>

                                    <label>Credential Description:<span class="asterixRequired">*</span></label>
                                    <div class="help_text">Make sure to include Keywords that describe your expertise in detail so the customers search will find your profile</div>

                                    <fieldset><textarea
                                            name="expert_credential_description"><?=$PostRetain['expert_credential_description']?></textarea>
                                    </fieldset>
                                    

                                    <label>Choose a Password:<span class="asterixRequired">*</span></label>
                                    <fieldset><input name="password" id="password" class="text"
                                                     value="<?=$PostRetain['password']?>" type="password"></fieldset>

                                    <label>Re-enter Password:<span class="asterixRequired">*</span></label><br>
                                    <fieldset><input name="pass_confirm" id="pass_confirm" class="text"
                                                     value="<?=$PostRetain['pass_confirm']?>" type="password">
                                    </fieldset>

                                    <div class="divider"></div>

                                    <div class="signup"><input name="signup_submit" id="signup_submit"
                                                               src="<?=__TEMPLATE_URL?>images/signup-now-btn.png"
                                                               value="Sign Up Now" type="image"></div>

                                </form>
                                <!-- / Sign Up Form -->

                                <div class="divider"></div>
                                <div class="post">
                                    <div class="whiteBtn right"><a
                                            href="<?=__SITE_URL?>login"><span>Log In Now</span></a></div>
                                    <p class="right buttonDesText">Already a member? </p>

                                    <div class="clear"></div>
                                </div>


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
    <?php require_once("right_section.php"); ?>
    <!-- / Right Column -->
    <div class="clear"></div>


</div>
.</div>
<!-- / Main Section -->


<!-- Footer Section -->
<?php require_once("footer.php"); ?>
<!-- / Footer Section -->

</body>
</html>
