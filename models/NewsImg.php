<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class NewsImg extends ActiveRecord
{

		public function rules()
		{
		    return [
					[[ 'extlink', 'link'], 'safe']
				];
		}


		public static function tableName()
    {
        return '{{newsimg}}';
    }

		public static function getLinkByExternal($link) {

			$Img = self::find()->where([
				'extlink' => $link
				])->one();

			if (!is_object($Img)) {

				$ext = explode(".", $link);

				$filename = hash('md5', microtime(true)) . '.' .  array_pop($ext);

				is_dir(Yii::getAlias('@webroot') .'/img/') ?: mkdir(Yii::getAlias('@webroot') .'/img/');

				file_put_contents(Yii::getAlias('@webroot') .'/img/'.$filename, file_get_contents($link));

				$Img = new NewsImg();

				$Img->attributes = [
					'extlink' => $link,
					'link' => $filename
				];

				$Img->save();

			}

			return $Img->link;

		}

}
