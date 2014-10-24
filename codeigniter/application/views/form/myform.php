<html>
<head>
<title>ユーザ登録</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('form/register'); ?>

<h5>ユーザ名(4文字以上12文字以下)</h5>
	<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />

<h5>パスワード</h5>
<input type="password" name="password" value="" size="50" />

<h5>パスワードの確認</h5>
<input type="password" name="passconf" value="" size="50" />

<h5>メールアドレス</h5>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<div><input type="submit" value="送信" /></div>

</form>

</body>
</html>
