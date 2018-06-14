<?php
  require('config/config.php');
  require('config/db.php');
  
  // Get query

  $query = 'SELECT * FROM posts ORDER BY created_at DESC';

  // Get result

  $result = mysqli_query($conn ,$query);

  // Fetch Data

  $posts = mysqli_fetch_all($result ,MYSQLI_ASSOC);
  //var_dump($posts);

  // Free Result

  mysqli_free_result($result);

  // Close the connection

  mysqli_close($conn);

?>
<?php include('inc/header.php'); ?>
  <h1 class="text-center title">Latest News</h1>
<div class="container">
  <div class="row">
  <div class="col-md-12">
    <?php foreach($posts as $post): ?>
      <h2><?php echo $post['title']; ?></h2>
      <small>Created_at: <?php echo $post['created_at']; ?> | by: <?php echo $post['author']; ?></small>
      <p><?php echo $post['body']; ?></p>
      <a class="btn btn-secondary" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Read More...</a>
      <hr class="my-4">
    <?php endforeach; ?>
    </div>
  </div>
</div>

<?php include('inc/footer.php'); ?>