<?php

namespace app\controllers;

use Yii;
// use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
// use yii\filters\VerbFilter;
use app\models\News;
use app\models\NewsTag;
use app\models\NewsImg;
use linslin\yii2\curl;
use GuzzleHttp\Client;

class NewsController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

				$News = new News();
				$News = $News::find()->where(['status' => 1])->orderBy(['newsId' => SORT_DESC])->all();
				return $this->render('index', [
					'news' => $News
				]);
    }


    /**
     * Displays about newpage.
     *
     * @return string
     */
    public function actionView($id)
    {

				$News = new News();
				$News = $News::findOne($id);
				return $this->render('view', [
					'news' => $News
				]);
    }

    public function actionParse()
    {
				// $client = new Client();
				// $res = $client->request('GET', 'https://www.rbc.ru/v10/ajax/get-news-feed/project/rbcnews.spb_sz/limit/15');
				// $body = $res->getBody();
        // $document = \phpQuery::newDocumentHTML($body);
        // $news = $document->find("a.news-feed__item");

				$curl = new curl\Curl();

			 	$res = $curl->get('https://www.rbc.ru/v10/ajax/get-news-feed/project/rbcnews.spb_sz/limit/15');

				$newsJson = json_decode($res, true);

				$news = [];

				$news_count = 0;

				foreach ($newsJson['items'] as $one) {

					$newsBoby = \phpQuery::newDocumentHTML($one['html']);

					$link = pq($newsBoby->find("a.news-feed__item")[0]);

					$link = $link->attr('href');

					$name= pq($newsBoby->find("span.news-feed__item__title")[0]);

					$mainTag = pq($newsBoby->find("span.news-feed__item__date-text")[0]);

					$client = new Client();

					$res = $client->request('GET', $link);

					$body = $res->getBody();

	        $document = \phpQuery::newDocumentHTML($body);

					$news_body = '';

					$news_text = '';

					$author = '';

					$tags = [];

					if ($article_body = $document->find('div.article__text')) {

						foreach ($article_body as $article) {

							$article = pq($article);

							foreach ($article->find('div.news-bar') as $delete) {

								pq($delete)->remove();

							}

							foreach ($article->find('div.banner') as $delete) {

								pq($delete)->remove();

							}

							foreach ($article->find('div.article__clear') as $delete) {

								pq($delete)->remove();

							}

							foreach ($article->find('div.article__inline-item') as $delete) {

								pq($delete)->remove();

							}

							foreach ($article->find('div.article__inline-video') as $delete) {

								pq($delete)->remove();

							}

							foreach ($article->find('div.pro-anons') as $delete) {

								pq($delete)->remove();

							}

							foreach ($article->find('blockquote.twitter-tweet') as $delete) {

								pq($delete)->remove();

							}

							foreach ($article->find('img') as $img) {

								$img = pq($img);

								$new_src = NewsImg::getLinkByExternal($img->attr('src'));

								$img->attr('src', '/img/'.$new_src);

							}

							$news_body .=  $article->html();

							foreach ($article->find('div.article__main-image') as $delete) {

								pq($delete)->remove();

							}

							$news_text .=  $article->text();

							// $article = 0;

							// break;

						}

						if ($article_author = $document->find('div.article__authors__row')) {

							foreach ($article_author as $a_autor) {

								$a_autor = pq($a_autor);

								foreach ($a_autor->find('div.article__authors__name') as $delete) {

									pq($delete)->remove();

								}

								$author = $a_autor->text();

							}

						}

						if ($article_tags = $document->find('a.article__tags__item')) {

							foreach ($article_tags as $article_tag) {

								$article_tag = pq($article_tag);

								$tags[] = $article_tag->text();

							}

						}

					}

					$news[] =  [

						'name' => trim($name->text()),
						'mainTag' => explode(',', $mainTag->text())[0],
						'link' => $link,
						'date' => date('Y-m-d H:i', $one['publish_date_t']),
						'html' => $news_body,
						'text' => $news_text,
						'author' => $author,
						'tags' => $tags

					];

					$News = News::find()->where([
						'name' => trim($name->text()),
						'date' => date('Y-m-d H:i', $one['publish_date_t']),
						'status' => News::STATUS_ACTIVE
					])->one();

					if (!is_object($News)) {

						$News = new News();

						$news_count += 1;

					}

					$News->attributes = [

						'name' => trim($name->text()),
						'mainTag' => explode(',', $mainTag->text())[0],
						'link' => $link,
						'date' => date('Y-m-d H:i', $one['publish_date_t']),
						'html' => $news_body,
						'text' => strtr(trim($news_text), ["\r"=>'', "\n"=>'']),
						'author' => $author,
						'status' => News::STATUS_ACTIVE

					];

					$News->save();

					foreach ($tags as $tag) {

						$newsTag = NewsTag::find()->where([
							'name' => $tag,
							'newsId' => $News->newsId,
							'status' => NewsTag::STATUS_ACTIVE
							])->one();

							if (!is_object($newsTag)) {

								$newsTag = new NewsTag();

							}

							$newsTag->attributes = [
								'name' => $tag,
								'newsId' => $News->newsId,
								'status' => NewsTag::STATUS_ACTIVE
							];

							$newsTag->save();
					}

				}

				return $this->render('parse', ['news' => $news_count]);
    }
}
