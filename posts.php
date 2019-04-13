<?php
include_once "connectDB.php";

function printAllPosts() {
    $posts = SQL::selectAllPosts();
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

  $title = '"' . SQL::safeEncodeString($title) . '"';
  $body = '"' . SQL::safeEncodeString($body)  . '"';
  $result = SQL::InsertPost($title, $body);
}
?>
