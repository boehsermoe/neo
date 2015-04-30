<?php

namespace app\commands;

use app\models\User;
use yii;
use yii\console\Controller;

class CypherController extends Controller
{
	public function actionIndex()
	{
		Yii::$app->db->open();

		#User::deleteAll();

		$record = User::find()->one();
		$record->username = 'foo';
		#$record->insert();

		$record->password = date('Y-m-d H:i:s');
		$record->update();

		Yii::$app->db->close();
	}
}