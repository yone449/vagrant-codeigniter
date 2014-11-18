<html>
<head>
<title>ツイート画面</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tweet_show.js"></script>
<script>
	var mailadd='<?php echo $mailadd ?>';
	var csrf_token_name='<?php echo $this->security->get_csrf_token_name(); ?>';
	var csrf_hash='<?php echo $this->security->get_csrf_hash(); ?>';
</script>

</head>
<body>

<style type="text/css">

div {
}
textarea {
width: 100%;
}
</style>


<div style="float:left"><?php echo $username ?>さん</div>
<div style="float:right"><a href="<?php echo site_url("twitter/logout") ?>">ログアウト</a>
</div>

<div style="width:500; position: relative; top: 0; left:100px;">
<textarea id="tweettext" name="tweettext"  rows="5">
</textarea>

<div id="tweetbtn"><input type="button"  name="tweetbutton" value="ツイート" /></div>

<div id="tweet_contents">
</div>

<div id="btn"><input type="submit" value="次の10件" /></div>
</div>

</form>

</body>
</html>
