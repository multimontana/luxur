<h1>Hello Woreld</h1>
<?php foreach ($posts as $post) :?>
<h3><?= $post->title?></h3>
<?php endforeach; ?>


<?php
$logs = RedBeanPHP\R::getDatabaseAdapter()
    ->getDatabase()
    ->getLogger();

debug($logs->grep('SELECT'));
?>