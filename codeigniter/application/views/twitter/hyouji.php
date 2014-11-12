<html>
<body>
<?php foreach ($tweets as $row) { ?>
<div style="border-width:thin; border-color:#d0d0d0; border-style:solid">
	<?php echo $row['UserName']; ?>さん:<?php echo $row['Date']; ?><br>
	<?php echo nl2br( $row['TweetText'],true ); ?>
<br>
<br>
</div>
<?php } ?>
</form>
</body>
</html>
