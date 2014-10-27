<html>
<head>
<title>ツイート画面</title>
</head>
<body>



<ul>
<?php foreach ($tweets as $row) { ?>
	<li>
	<?php echo $row['UserID']; ?>:<?php echo $row['Date']; ?>
	</li>
	<?php echo $row['TweetText']; ?>
<?php } ?>
</ul>


<div><input type="submit" value="次の10件" /></div>

</form>

</body>
</html>
