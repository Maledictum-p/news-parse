<?php

namespace app\models;

use yii\db\ActiveRecord;

class NewsTag extends ActiveRecord
{
		const STATUS_INACTIVE = 0;
		const STATUS_ACTIVE = 1;

		public function rules()
		{
		    return [
					[[ 'name', 'newsId', 'status'], 'safe']
				];
		}


		public static function tableName()
    {
        return '{{newstag}}';
    }

		// public function getNews() {
		//
		// 	return $this->hasOne(News::className(), ['newsId' => 'newsId']);
		//
		// }

}
