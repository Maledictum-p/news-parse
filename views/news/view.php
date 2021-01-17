<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\News;
use app\models\NewsTag;
use yii\helpers\Url;

$this->title = $news->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">



		<div class="row">

			<div class="col-md-2">

			</div>

			<div class="col-md-8">


				<div class="row">

					<div class="col-md-12 margin-y-10 padding-y-10 bg-info">

						<span><strong><?=Html::encode($news->mainTag)?></strong></span>, <span><?=Html::encode($news->getDate())?></span>

					</div>

					<div class="col-md-12">

						<h1><?=Html::encode($this->title)?></h1>

						<?if($news->html):?>

							<div class="news-content">

								<?=$news->html;?>

							</div>

						<?else:?>

						<h4><a href="<?=$news->link;?>">It isn't news!</a></h4>

						<?endif;?>

						<?if($news->author):?>

							<span class="small"><strong>Автор:</strong>	<?=$news->author;?></span>

						<?endif;?>

					</div>

					<?if(NewsTag::find()->where(['newsId' => $news->newsId, 'status' => NewsTag::STATUS_ACTIVE])->count()):?>

					<div class="col-md-12 bg-info margin-y-10">

						<?foreach(NewsTag::find()->where(['newsId' => $news->newsId, 'status' => NewsTag::STATUS_ACTIVE])->all() as $tag):?>

						<span class="btn btn-secondary"><?=$tag->name;?></span>

						<?endforeach;?>

					</div>

					<?endif;?>

				</div>

			</div>

			<div class="col-md-2">

			</div>

		</div>


</div>
