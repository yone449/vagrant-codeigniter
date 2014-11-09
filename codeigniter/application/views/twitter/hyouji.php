<html>
<body>
<?php foreach ($tweets as $row) { ?>
	<li>
	<?php echo $row['UserName']; ?>さん:<?php echo $row['Date']; ?>
	</li>
	<?php echo $row['TweetText']; ?>
<?php } ?>
</form>
</body>
</html>
