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
                        <div class="greyBox3">
                            <div class="greyBoxInner3 page">

                                <?=General::getMessage()?>
                                <h2>Log In</h2>
                                <!-- Show Form Errors -->
                                <!-- / Show Form Errors -->
                                <div class="formImage right"><img src="<?=__TEMPLATE_URL?>images/login-image.png"
                                                                  alt="Log In"></div>
                                <form class="message" name="loginformMain" id="loginformMain" method="post"
                                      action="<?=__SITE_URL?>login/expertLogin">
                                    <label for="user_username">Email Address:</label>
                                    <fieldset><input name="user_login" id="user_username" class="input" value="<?=$UsernameValue?>"
                                                     size="20" maxlength="40" tabindex="10" type="text"></fieldset>
                                    <label for="user_password">Password:</label>
                                    <fieldset><input name="password" id="user_password" class="input" value="" size="20"
                                                     maxlength="40" tabindex="20" type="password"></fieldset>

                                    <input name="login_post" value="1" type="hidden">

                                    <div class="login left"><input name="btnLogin" id="btnLogin"
                                                                   src="<?=__TEMPLATE_URL?>images/login-now-btn.png"
                                                                   value="Log In Now" type="image"></div>
                                    <div class="forgotLink left"><a href="<?=__SITE_URL?>login/forgot_password">Forgot your
                                                                                                          password?</a>
                                    </div>
                                    <div class="clear"></div>
                                </form>

                                <div class="divider"></div>
                                <div class="post">
                                    <div class="whiteBtn right"><a
                                            href="<?=__SITE_URL?>signup"><span>Sign Up Now!</span></a></div>
                                    <p class="right buttonDesText">Not a member yet? </p>

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
