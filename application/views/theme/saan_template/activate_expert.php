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
                                <h2>Profile Activation Status</h2>

                                <div id="post-2" class="post">
                                    <p><?=General::getMessage()?></p>

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
