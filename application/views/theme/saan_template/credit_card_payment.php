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
                                <h2>Credit Card Payment Status</h2>

                                <!-- Show Form Errors -->
                                <!-- / Show Form Errors -->


                                <!-- Sign Up Form -->

                                <table width="90%" cellpadding="0" cellspacing="0"
                                       style="margin-left:40px; margin-top:30px; margin-bottom:30px;">
                                    <tr>
                                        <td>
                                            <div id="credit_card_section"
                                                 style="background-color:#f3fbfe; width:100%; height:auto; border:1px #0099CC solid; padding:10px;">
                                                <?php
                                                if (isset($_SESSION['last_payment_id']))
                                                {
                                                    if ($_SESSION['last_payment_id'] == "failure")
                                                    {
                                                    ?>
                                                        <table width="100%" border="0" cellspacing="5" cellpadding="5">
                                                            <tr>
                                                                <td width="8%" rowspan="4" align="center" valign="top">
                                                                    <img src="<?=__TEMPLATE_URL?>images/error_icon.png"
                                                                         width="25" height="25"></td>
                                                                <td width="92%" align="left" valign="top"><span
                                                                        style="font-size:16px; font-weight:bold; margin-left:-4px;">Following Error occured during the Transaction:</span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td align="left"
                                                                    valign="top"><?=$_SESSION['transaction_details']['L_LONGMESSAGE0'];?></td>
                                                            </tr>
                                                        </table>
                                                    <?php
                                                    }
                                                    else if ($_SESSION['last_payment_id'] == "none")
                                                    {
                                                    ?>
                                                        <table width="100%" border="0" cellspacing="5" cellpadding="5">
                                                            <tr>
                                                                <td width="8%" rowspan="4" align="center" valign="top">
                                                                    <img src="<?=__TEMPLATE_URL?>images/error_icon.png"
                                                                         width="25" height="25"></td>
                                                                <td width="92%" align="left" valign="top"><span
                                                                        style="font-size:16px; font-weight:bold; margin-left:-4px;">There was a problem in proessing this payment. Please try again!</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <table width="100%" border="0" cellspacing="5" cellpadding="5">
                                                            <tr>
                                                                <td width="8%" rowspan="4" align="center" valign="top">
                                                                    <img src="<?=__TEMPLATE_URL?>images/success_icon.png"
                                                                         width="25" height="25"></td>
                                                                <td width="92%" align="left" valign="top"><span
                                                                        style="font-size:16px; font-weight:bold; margin-left:-4px;">Thank You for your Payment!</span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td align="left" valign="top">Infopedia has recieved a
                                                                    payment
                                                                    of
                                                                    <strong>$<?=$_SESSION['transaction_details']['AMT']?></strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" valign="top">You will recieve a reciept of
                                                                    this
                                                                    payment on your email address.
                                                                </td>
                                                            </tr>
                                                        </table>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </div>
                                        </td>
                                    </tr>
                                </table>
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
</div>
<!-- / Main Section -->


<!-- Footer Section -->
<?php require_once("footer.php"); ?>
<!-- / Footer Section -->

</body>
</html>
