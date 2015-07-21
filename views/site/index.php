<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

$markdown = file_get_contents(__DIR__."/../../README.md");
?>
<div class="site-index">
    <?php echo \yii\helpers\Markdown::process($markdown, 'gfm'); ?>
</div>
