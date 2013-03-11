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
                                <div id="signupContent">

                                </div>
                                <div id="error">
                                    <?=General::getMessage()?>
                                </div>
                                <h2>Request an Advice from </h2>

                                <!-- Show Form Errors -->
                                <!-- / Show Form Errors -->

                                <div class="formImage right"><img src="<?=__TEMPLATE_URL?>images/signup-image.png"
                                                                  alt="Sign Up"></div>
                                <!-- Sign Up Form -->
                                <form name="adviceform" id="adviceform" action="<?=__SITE_URL?>advice/request/expert:<?=$EncryptedEmail?>" method="post">
								  <table width="100%" border="0" cellspacing="5" cellpadding="5">
                                    <tr>
                                        <td>Full Name:<div class="help_text">Enter your full name.</div></td>
                                      </tr>
                                      <tr>
                                        <td><input type="text" name="user_full_name" id="user_full_name" value="<?=$RetainPost['user_full_name']?>"></td>
                                      </tr>
                                      <tr>
                                        <td>Email Address:<div class="help_text">You will be emailed conformation and You will be able to rate your experts answer.</div></td>
                                      </tr>
                                      <tr>
                                        <td><input type="text" name="user_email_address" id="user_email_address" value="<?=$RetainPost['user_email_address']?>"></td>
                                      </tr>
                                      <tr>
                                        <td>Phone Number:<div class="help_text">Your technical adviser will call you on this number shortly.</div></td>
                                      </tr>
                                      <tr>
                                        <td><input type="text" name="user_phone_number" id="user_phone_number" value="<?=$RetainPost['user_phone_number']?>"></td>
                                      </tr>
                                      <tr>
                                        <td>Comments:<div class="help_text">Please enter any message you would want to convey to the selected expert.</div></td>
                                      </tr>
                                      <tr>
                                        <td><textarea name="user_comments" id="user_comments" cols="45" rows="5"><?=$RetainPost['user_comments']?></textarea></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td><input name="get_advice_button" id="get_advice_button"
                                                               value="Continue" type="submit" style="font-weight: bold; font-size: 24px; background-color: #f85100; border: 2px #c5490d solid; border-radius:5px; color: #fff; letter-spacing: 2px;"></td>
                                      </tr>
                                    </table>
                              </form>
                                <!-- / Sign Up Form -->
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
