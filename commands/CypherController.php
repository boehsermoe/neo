<?php

namespace app\commands;

use app\models\User;
use yii;
use yii\console\Controller;

class CypherController extends Controller
{
	public function actionCreate($username)
	{
		Yii::$app->db->open();

		$record = new User();

		$record->username = $username;

		$record->save();

		Yii::$app->db->close();
	}

	public function actionUpdate($old, $new)
	{
		Yii::$app->db->open();


		$record = User::find()->andOnCondition(['username' => $old])->one();

		$record->username = $new;

		$record->save();

		Yii::$app->db->close();
	}

	public function actionClear()
	{
		Yii::$app->db->open();

		User::deleteAll();

		Yii::$app->db->close();
	}
}