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

		$record = new User();
		$record->username = 'foo';
		$record->password = 'bar';
		$record->insert();
		$record->update();

		Yii::$app->db->close();
	}
}