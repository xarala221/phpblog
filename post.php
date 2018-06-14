<?php
  require('config/config.php');
  require('config/db.php');
  //Check for delete
  if(isset($_POST['delete'])){
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $query = "DELETE FROM posts WHERE id = {$delete_id}";

  if(mysqli_query($conn, $query)){
    header('Location:'.ROOT_URL.'');
  }else{
    echo 'ERROR:' .mysqli_error($conn);
  }
    
  }

  //Get id
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  // Get query

  $query = 'SELECT * FROM posts WHERE id = '.$id;

  // Get result

  $result = mysqli_query($conn ,$query);

  // Fetch Data

  $post = mysqli_fetch_assoc($result);
  //var_dump($posts);

  // Free Result

  mysqli_free_result($result);

  // Close the connection

  mysqli_close($conn);

?>

<?php include('inc/header.php'); ?>
  <div class="container">
      <a href="<?php echo ROOT_URL; ?>" class="btn btn-light">Back</a>
      <h1><?php echo $post['title']; ?></h1>
      <small>Created_at: <?php echo $post['created_at']; ?> | by: <?php echo $post['author']; ?></small>
      <p><?php echo $post['body']; ?></p>
      <hr>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="delete_id" value="<?php echo $post['id'] ?>">
        <input class="btn btn-warning float-left" type="submit" value="Delete" name="delete">
      </form>
      <a class="btn btn-info float-right" href="<?php echo ROOT_URL; ?>edit_post.php?id=<?php echo $post['id']; ?>">Edit</a>
  </div>
<?php include('inc/footer.php'); ?>