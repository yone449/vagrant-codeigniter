<html>
  <head>
   <title>新規作成</title>
  </head>
  <body>
 <?php echo validation_errors(); ?>
 <?php echo form_open('twitter'); ?>


<textarea name="tweet" cols="50" rows="5">
</textarea>

<div><input type="submit" name="tweetbutton" value="残り" /></div>
    </form>
  </body>
</html>
