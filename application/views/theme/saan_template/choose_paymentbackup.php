<?php require_once("header.php"); ?>
<script language="javascript">
$(document).ready(function(){
alert("fdsafsd");
	$('#credit_card_section').hide();
	$('#credit_card_button').click(function(){
		$('#credit_card_section').show('slow');
	});
});
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
                                <div id="signupContent">

                                </div>
                                <div id="error">
                                    <?=General::getMessage()?>
                                </div>
                                <h2>Choose you Payment Mode</h2>

                                <!-- Show Form Errors -->
                                <!-- / Show Form Errors -->

                                
                                <!-- Sign Up Form -->
                                
                                	<table width="90%" cellpadding="0" cellspacing="0" style="margin-left:40px; margin-top:30px; margin-bottom:30px;">
                                    	<tr class="help_text">
                                        	<td width="50%">This option facilitates you to use your credit card for the transaction. This transaction is safe and secured over SSL and with Paypal Payment Gateway.</td>
                                            <td>This option facilitates you to use your own Paypal account for the Transaction. You will be redirected to the Paypal site where you can Login and do the transaction.</td>
                                        </tr>
                                        <tr class="help_text">
                                        	<td width="50%">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    	<tr>
                                        	<td><a href="javascript:void(0);" id="credit_card_button"><img src="<?=__TEMPLATE_URL?>images/credit_card_pay.jpg"></a></td>
                                            <td><a href=""><img src="<?=__TEMPLATE_URL?>images/paypal_pay.jpg"></a></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="2">
                                            	<div id="credit_card_section">
                               					  <form name="adviceform" id="adviceform" action="" method="post">
                                           			<table align="center" width="70%" border="0" cellspacing="5" cellpadding="5" style="margin-left:100px; margin-top:30px; font-size:12px;">
                                                          <tr>
                                                            <td>First Name</td>
                                                          	<td><input name="first_name" type="text" id="first_name" size="26" ></td>
                                                          </tr>
                                                          <tr>
                                                            <td>Last Name</td>
                                                          	<td><input name="last_name" type="text" id="last_name" size="26"></td>
                                                          </tr>
                                                          <tr>
                                                            <td>Credit Card Type</td>
                                                          	<td>
                                                            	<select name="card_type" id="card_type">
                                                                	<option value="Visa">Visa</option>
                                                                    <option value="MasterCard">MasterCard</option>
                                                                    <option value="Discover">Discover</option>
                                                                    <option value="American Express">American Express</option>
                                                           	  </select>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td>Credit Card Number</td>
                                                          	<td><input name="card_number" type="text" id="card_number" size="26"></td>
                                                          </tr>
                                                          <tr>
                                                            <td>Expiry Date</td>
                                                          	<td>
                                                            	<span class="help_text">Month:</span> 
                                                              	<select name="date_month" id="date_month">
                                                                	<option value="1">1</option>
                                                                	<option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                           	  </select>
                                                             	<span class="help_text">Year:</span> 
                                                             	<select name="date_year" id="date_year">                                                                	
                                                                <option value="2013">2013</option>
                                                                <option value="2014">2014</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2017">2017</option>
                                                                <option value="2018">2018</option>
                                                                <option value="2019">2019</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                                <option value="2024">2024</option>
                                                                <option value="2025">2025</option>
                                                                <option value="2026">2026</option>
                                                                <option value="2027">2027</option>
                                                                <option value="2028">2028</option>
                                                                <option value="2029">2029</option>
                                                                <option value="2030">2030</option>
                                                                <option value="2031">2031</option>
                                                                <option value="2032">2032</option>
                                                                <option value="2033">2033</option>
                                                                <option value="2034">2034</option>
                                                                <option value="2035">2035</option>
                                                                <option value="2036">2036</option>
                                                                <option value="2037">2037</option>
                                                                <option value="2038">2038</option>
                                                                <option value="2039">2039</option>
                                                                <option value="2040">2040</option>
                                                                <option value="2041">2041</option>
                                                                <option value="2042">2042</option>
                                                                <option value="2043">2043</option>
                                                                <option value="2044">2044</option>
                                                                <option value="2045">2045</option>
                                                                <option value="2046">2046</option>
                                                                <option value="2047">2047</option>
                                                                <option value="2048">2048</option>
                                                                <option value="2049">2049</option>
                                                                <option value="2050">2050</option>
                                                                <option value="2051">2051</option>
                                                                <option value="2052">2052</option>
                                                                <option value="2053">2053</option>
                                                                <option value="2054">2054</option>
                                                                <option value="2055">2055</option>
                                                                <option value="2056">2056</option>
                                                                <option value="2057">2057</option>
                                                                <option value="2058">2058</option>
                                                                <option value="2059">2059</option>
                                                                <option value="2060">2060</option>
                                                                <option value="2061">2061</option>
                                                                <option value="2062">2062</option>
                                                                <option value="2063">2063</option>

                                                           	  </select>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td>Security Code</td>
                                                          	<td><input name="security_code" type="text" id="security_code" size="26"></td>
                                                          </tr>
                                                          <tr>
                                                          	<td>&nbsp;</td>
                                                            <td><input type="submit" name="pay_now" id="pay_now" value="Finalize Payment"></td>
                                                          </tr>
                                                          
                                                        </table>       
                                                  </form>                
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
