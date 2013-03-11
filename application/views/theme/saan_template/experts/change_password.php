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
                <h4>Change Password...</h4>
                <?=General::getMessage()?>
                <form action="" method="post" name="form1">
                    <table width="100%" border="0" cellspacing="3" cellpadding="3">

                        <tr>
                            <td>Old Password:</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="old_password" id="old_password"></td>
                      </tr>
                        <tr>
                          <td>New Password:</td>
                        </tr>
                        <tr>
                          <td><input type="password" name="new_password" id="new_password"></td>
                        </tr>
                        <tr>
                          <td>Confirm New Password:</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="confirm_new_password" id="confirm_new_password"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="btnChangePassword" id="btnChangePassword" value="Change Password"></td>
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