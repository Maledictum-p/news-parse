<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\News;
use app\models\NewsTag;
use yii\helpers\Url;

$this->title = 'News list';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?=Html::encode($this->title)?></h1>



    <?foreach($news as $id => $thisnews):?>

		<div class="row">

			<div class="col-md-3">

			</div>

			<div class="col-md-6">

				<div class="row">

					<div class="col-md-12 margin-y-10 padding-y-10 bg-info">

						<h4><a class="" href="<?=Url::to(['news/view', 'id' => $thisnews->newsId]);?>"><?=$thisnews->name;?></a></h4>

					</div>

					<div class="col-md-12 padding-y-10">

						<?if($thisnews->text):?>

								<?=mb_substr(trim(preg_replace('/[ \t]+/', ' ', preg_replace('/\s*$^\s*/m', "\n", $thisnews->text))), 0, 200);?>

								<br>

								<a class="btn btn-success margin-top-10" href="<?=Url::to(['news/view', 'id' => $thisnews->newsId]);?>">Подробнее</a>

						<?else:?>

						<h4><a href="<?=$thisnews->link;?>">It isn't news!</a></h4>

						<?endif;?>

					</div>

					<div class="col-md-12 small text-right">

						<span><?=$thisnews->getDate();?></span>

						<span> </span>

						<span class="btn btn-default margin-left-10"><?=$thisnews->getMainTag();?></span>


					</div>

					<div class="col-md-12 hr"></div>

		    </div>

			</div>

			<div class="col-md-3">

			</div>

		</div>



    <?endforeach;?>

</div>
