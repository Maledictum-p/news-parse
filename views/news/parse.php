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

						Parsed: <?=$news;?>

						<br>

						Updated: <?=15 - $news;?>

					</div>

		    </div>

			</div>

			<div class="col-md-2">

			</div>

		</div>


</div>
