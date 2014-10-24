<html>
<head>
<title>login</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('form'); ?>

<h5>メールアドレス</h5>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<h5>パスワード</h5>
<input type="password" name="password" value="" size="50" />

<div><input type="submit" value="ログイン" /></div>
<A Href="<?php echo site_url("form/register") ?>">ユーザ登録</A>
</form>

</body>
</html>
