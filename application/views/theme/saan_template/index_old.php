<html>
<head>
    <title><?=$Title?></title>
    <link rel="stylesheet" href="<?php echo __TEMPLATE_URL; ?>styles/styles.css">
</head>
<body>
<p><img src="<?php echo __TEMPLATE_URL; ?>images/saan_logo.png"></p>

<h1><?=$PageHeading?></h1>

<p><?=$BodyText?></p>
<hr>
<p>Following is the list of arguments supplied to the action <br> <br> <?=$ArgumentList?></p>
<hr>
<p>Following is the Example for the Database Interaction</p>
<table width="20%" align="center">
    <tr>
        <th align="left">id</th>
        <th align="left">name</th>
    </tr>
    <?php
    foreach ($UserList as $userArray) {
        ?>
        <tr>
            <td><?=$userArray['index_id']?></td>
            <td><?=$userArray['index_name']?></td>
        </tr>
        <?php
    }
    ?>
</table>
<form action="" method="POST" name="frm">
    <input type="submit" name="btnSubmit" value="submit">
</form>
<hr>
</body>
</html>