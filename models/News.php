<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class News extends ActiveRecord
{
		const STATUS_INACTIVE = 0;
		const STATUS_ACTIVE = 1;

		// public $newsId;
    // public $name ='';
    // public $mainTag ='';
    // public $date;
    // public $html = '';
		// public $text = '';
		// public $link = '';
		// public $status = 1;



		// public function fields()
		// {
		//     return [
		// 			'name',
		// 			'mainTag',
		// 			'date',
		// 			'html',
		// 			'link',
		// 			'text',
		// 			'author'
		//
		//     ];
		// }

		public function rules()
		{
		    return [
					[[ 'name', 'mainTag', 'date', 'html', 'link', 'text', 'author', 'status'], 'safe']
				];
		}



		public static function tableName()
    {
        return '{{news}}';
    }

		public function getTags() {

			return $this->hasMany(NewsTag::className(), ['newsId' => 'newsId']);

		}

		public function getName() {

			return $this->name;

		}

		public function getMainTag() {

			return $this->mainTag;

		}

		public function getDate() {

			return Yii::$app->formatter->asDatetime($this->date);;

		}



}
