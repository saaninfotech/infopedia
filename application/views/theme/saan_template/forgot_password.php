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

                <div class="reset"></div>
                <div class="bordsp10"></div>
                <!-- /Navigation Tabs -->

                <!-- Tabs Content Blocks -->
                <div id="wContent">

                    <!-- Recent Questions -->
                    <div class="wContentBox">

                        <div class="greyBoxInner3 page">
                            <?=General::getMessage()?>
                            <h2>Forgot Password</h2>
                            <!-- Show Form Errors -->
                            <p class="introText">Enter your email address below to reset your password. Your new
                                                 password will be emailed to you shortly after completeing the form.</p>

                            <form class="message" name="forgotPassword" id="forgotPassword" method="post" action="">
                                <label>Email Address:</label>
                                <fieldset><input name="forgot_email" id="forgot_email" class="input" size="20"
                                                 maxlength="40" tabindex="10" type="text" value="<?=$PostArray['forgot_email']?>"></fieldset>
                                <input name="forgot_pass_post" value="1" type="hidden">

                                <div class="forgotpassword"><input name="resetpass" id="resetpass"
                                                                   src="<?=__TEMPLATE_URL?>images/reset-password-btn.png"
                                                                   value="Reset Password" type="image"></div>
                            </form>
                            <div class="divider"></div>
                            <div class="post">
                                <div class="whiteBtn right"><a href="<?=__SITE_URL?>login"><span>Log In Now</span></a>
                                </div>
                                <div class="clear"></div>
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
