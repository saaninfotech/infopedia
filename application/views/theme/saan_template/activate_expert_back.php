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

            <!-- Search Form -->
            <div class="greenBox">
                <div class="greenBoxInner searchbox">
                    <h2>Infopedia:</h2>

                    <form method="get" id="searchform" action="#/">
                        <div class="submitBtn right"><input type="image" id="searchsubmit" value="Submit"
                                                            src="<?=__TEMPLATE_URL?>images/submit-search.png"/></div>
                        <input type="text" name="s" id="s" class="cleardefault"/></form>
                </div>
            </div>
            <!-- Search Form -->

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


                                <!-- Show Form Errors -->
                                <!-- / Show Form Errors -->
                                <div class="formImage right">

                                    <h2>Invalid Activate Link. Please Sign up for activate your account.</h2>
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
