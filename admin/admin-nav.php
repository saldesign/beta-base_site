 <aside>
  <section class="module secondary">
  <nav role='navigation'>
    <ul class="main">
    <?php // if an admin is logged, show the full nav bar, otherwise show commenter nav items

    if( IS_LOGGED_IN){ ?>
      <li class="home"><a href="../index.php">Home</a></li>
      <li class="dashboard"><a href="index.php">Dashboard</a></li>
      <li class="write"><a href="admin-write.php">Write Post</a></li>
      <li class="edit"><a href="admin-manage.php">Edit Posts</a></li>
      <li class="comments"><a href="#">Comments</a></li>
      <li class="users"><a href="#">Manage Users</a></li>
    <?php }else{
        header('Location:'.ROOT_URL.'/signin.php');
      }
      ?>
    </ul>
  </nav>
  </section>
</aside>