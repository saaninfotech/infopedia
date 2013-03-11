<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" lang="javascript">
	var openMyModal = function(source)
	{
		modalWindow.windowId = "myModal";
		modalWindow.width = 480;
		modalWindow.height = 405;
		modalWindow.content = "<iframe width='480' height='405' frameborder='0' scrolling='no' allowtransparency='true' src='" + source + "'>&lt/iframe>";
		modalWindow.open();
	};	
	</script>
	<style type="text/css">
	html,body
	{
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
		margin:10px;
		padding:10px;
		border-radius: 5px;
	}
	
	</style>
</head>

<body>
<table width="100%" border="0" cellspacing="3" cellpadding="3" style="background-color:#e3f1fb; border-radius:5px; padding:10px;">
  <tr>
    <td>Star Points: <?=$FeedbackArray[0]['star_value']?></td>
  </tr>
  <tr>
    <td>Date Time: <?=General::getFormatedDate($FeedbackArray[0]['feedback_datetime'])?></td>
  </tr>
  <tr>
    <td>Comments:</td>
  </tr>
  <tr>
    <td><?=$FeedbackArray[0]['feedback_comment']?></td>
  </tr>
</table>
</body>
</html>
