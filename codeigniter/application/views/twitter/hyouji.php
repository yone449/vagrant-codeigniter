<html>
  <body>
    <?php foreach ($tweets as $row) { ?>
    <div class="tweet-index">
      <?php echo $row['UserName']; ?>さん:<?php echo $row['Date']; ?><br>
      <?php echo nl2br(htmlentities($row['TweetText'], ENT_QUOTES, mb_internal_encoding())); ?>
      <br>
      <br>
    </div>
    <?php } ?>
  </form>
</body>
</html>
