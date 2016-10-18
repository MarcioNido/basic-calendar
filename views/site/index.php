<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'NIDO Basic Calendar';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Basic Calendar</h1>

        <p class="lead">This is a demo application. To see how it was done check the tutorial at: <a href="/blog/web/index.php?r=site%2Fphp-yii&page=project">http://marcionido.info.</a></p>
        <br />
        <br />
        <p>You can sign in using: ADMIN/ADMIN or DEMO/DEMO (uppercase).</p>
        <br />
        <p><?= Html::a("Open Calendar", ['calendar/event'], ['class'=>'btn btn-lg btn-success']); ?></p>
    </div>

</div>
