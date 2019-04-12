<?php
include_once "connectDB.php";

function printAllPosts() {
    $posts = SQL::SELECT(['title, body'], 'POSTS');
    foreach ($posts as &$post) {
        printPost($post);
    }
}

function printPost($post) {
    ?>
    <div class="shell">
        <div class="post">
            <div class="post--header">
                <div class="post--title"><?php echo $post[title]; ?></div>
            </div>
            <div class="post--description"><?php echo $post[body]; ?></div>
        </div>
    </div>
    <?php
}

function insertPost($title, $body) {
  if (!isset($title) || !isset($body))
  		return 'INCORRECT_INPUT';

  $args = array();
  $args['title'] = '"' . SQL::safeEncodeString($title) . '"';
  $args['body'] = '"' . SQL::safeEncodeString($body)  . '"';

  if (2 < mb_strlen($args['title']) &&
  		mb_strlen($args['title']) < 50 &&
  		2 < mb_strlen($args['body']) &&
  		mb_strlen($args['body']) < 1024
  ) {
  		$result = SQL::INSERT_set('POSTS', $args);
  }
}
?>
