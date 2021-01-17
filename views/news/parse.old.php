<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\News;
use app\models\NewsTag;
use yii\helpers\Url;

$this->title = 'Parse news';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">



		<div class="row">

			<div class="col-md-2">

			</div>

			<div class="col-md-8">

				<div class="row">

					<div class="col-md-12">

						<?foreach($news as $article):?>

								<div class="row">

									<div class="col-md-12 margin-y-10 padding-y-10 bg-info">

										<span><strong><?=$article['mainTag'];?></strong></span>, <span><?=$article['date'];?></span>

									</div>

									<div class="col-md-12">

										<h1><?=$article['name'];?></h1>

										<?if($article['html']):?>

											<div class="news-content">

												<?=$article['html'];?>

											</div>

										<?else:?>

										<h4><a href="<?=$article['link'];?>">It isn't news!</a></h4>

										<?endif;?>

										<?if($article['author']):?>

											<span class="small"><strong>Автор:</strong>	<?=$article['author'];?></span>

										<?endif;?>

									</div>

									<?if(count($article['tags'])):?>

									<div class="col-md-12 bg-info margin-y-10">

										<?foreach($article['tags'] as $tag):?>

										<span class="btn btn-secondary"><?=$tag;?></span>

										<?endforeach;?>

									</div>

									<?endif;?>

						    </div>

							<hr class="col-md-12"/>


						<?endforeach;?>

					</div>

		    </div>

			</div>

			<div class="col-md-2">

			</div>

		</div>


</div>
