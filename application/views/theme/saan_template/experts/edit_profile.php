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

            <div id="post-2" class="post">
                <h4>Edit your profile...</h4>
                <?=General::getMessage()?>
                <form name="form1" method="post" action="">
                    <table width="100%" border="0" cellspacing="3" cellpadding="3">
                        <tr>
                            <td>Domain:</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="expert_category_id">
                                    <option value="0">Select Category</option>
                                    <?php
                                    foreach ($CategoryArray as $categoryKey => $categoryValue) {
                                        ?>
                                        <option value="<?=$categoryValue['expert_category_id']?>" <?=($ExpertArray['expert_category_id'] == $categoryValue['expert_category_id']) ? "selected" : "" ?> ><?=$categoryValue['expert_category_name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Full Name:</td>
                        </tr>
                        <tr>
                            <td><input name="expert_name" type="text" id="expert_name"
                                       value="<?=$ExpertArray['expert_name']?>"></td>
                        </tr>
                        <tr>
                            <td>Email Address:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="expert_email" id="expert_email"
                                       value="<?=$ExpertArray['expert_email']?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="expert_phone_number" id="expert_phone_number"
                                       value="<?=$ExpertArray['expert_phone_number']?>"></td>
                        </tr>
                        <tr>
                            <td>Paypal Email:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="expert_paypal" id="expert_paypal"
                                       value="<?=$ExpertArray['expert_paypal']?>"></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                        </tr>
                        <tr>
                            <td><textarea name="expert_address" id="expert_address" cols="45"
                                          rows="5"><?=$ExpertArray['expert_address']?></textarea></td>
                        </tr>
                        <tr>
                            <td>About your Credentials:</td>
                        </tr>
                        <tr>
                            <td><textarea name="expert_credential_description" id="expert_credential_description"
                                          cols="45"
                                          rows="5"><?=$ExpertArray['expert_credential_description']?></textarea></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </form>
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