<html>
<body>
<?php foreach ($tweets as $row) { ?>
<div style="border-width:thin; border-color:#d0d0d0; border-style:solid">
	<?php echo $row['UserName']; ?>さん:<?php echo $row['Date']; ?><br>
	<?php echo nl2br(htmlentities($row['TweetText'], ENT_QUOTES, mb_internal_encoding())); ?>
<br>
<br>
</div>
<?php } ?>
</form>
</body>
</html>
