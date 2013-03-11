<?php require_once("header.php"); ?>
<script language="javascript" type="text/javascript">
function showStarCount(countValue)
{
	document.getElementById('point_value').innerHTML = countValue;
}
function removeStartCount()
{
	document.getElementById('point_value').innerHTML = document.getElementById('hdnPoint').value;
}
function setStarCount(countValue)
{
	document.getElementById('point_value').innerHTML = countValue;
	document.getElementById('hdnPoint').value = countValue;
}
</script>
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
                                <h2>Feedback for <?=ucwords($AdviceArray[0]['expert_name'])?></h2>

                                <div id="post-2" class="post">
                                  <form name="form1" method="post" action="">
                                    <table width="70%" border="0" align="center" cellpadding="5" cellspacing="5">
                                      <tr>
                                        <td>Choose Star Rating:</td>
                                      </tr>
                                      <tr>
                                        <td>
                                        	<a href="javascript:void(0);" onMouseOver="showStarCount(1);" onMouseOut="removeStartCount();" onClick="setStarCount(1);"><img src="<?=__TEMPLATE_URL?>images/grey-star-big.png" alt="" width="20" height="22" border="0"></a>&nbsp;
                                            <a href="javascript:void(0);" onMouseOver="showStarCount(2);" onMouseOut="removeStartCount();" onClick="setStarCount(2);"><img src="<?=__TEMPLATE_URL?>images/green-star-big.png" alt="" width="20" height="22" border="0"></a>&nbsp;
                                            <a href="javascript:void(0);" onMouseOver="showStarCount(3);" onMouseOut="removeStartCount();" onClick="setStarCount(3);"><img src="<?=__TEMPLATE_URL?>images/blue-star-big.png" alt="" width="20" height="22" border="0"></a>&nbsp;
                                            <a href="javascript:void(0);" onMouseOver="showStarCount(4);" onMouseOut="removeStartCount();" onClick="setStarCount(4);"><img src="<?=__TEMPLATE_URL?>images/orange-star-big.png" alt="" width="20" height="22" border="0"></a>&nbsp;
                                            <a href="javascript:void(0);" onMouseOver="showStarCount(5);" onMouseOut="removeStartCount();" onClick="setStarCount(5);"><img src="<?=__TEMPLATE_URL?>images/red-star-big.png" alt="" width="20" height="22" border="0"></a>&nbsp;                                        </td>
                                      </tr>
                                      <tr>
                                        <td>Total Points: <span id="point_value">0</span> <input type="hidden" name="hdnPoint" id="hdnPoint" value="0"></td>
                                      </tr>
                                      <tr>
                                        <td>Comments:</td>
                                      </tr>
                                      <tr>
                                        <td><textarea name="comments" id="comments" cols="45" rows="5"></textarea></td>
                                      </tr>
                                      <tr>
                                        <td>
                                        	<input type="submit" value="Submit Feedback" name="submit_comments" id="submit_comments">

                                            </div>
                                        </td>
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
