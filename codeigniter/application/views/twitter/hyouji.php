<html>
<body>
<?php foreach ($tweets as $row) { ?>
<div style="border-width:thin; border-color:#d0d0d0; border-style:solid">
	<pre><?php echo $row['UserName']; ?>さん:<?php echo $row['Date']; ?></pre><br>
	<pre><?php echo nl2br( $row['TweetText'],true ); ?></pre>
<br>
<br>
</div>
<?php } ?>
</form>
</body>
</html>
