<?php

namespace app\commands;

use app\models\User;
use yii;
use yii\console\Controller;

class CypherController extends Controller
{
	public function actionCreate($username)
	{
		$record = new User();

		$record->username = $username;

		$record->save();
	}

	public function actionUpdate($old, $new)
	{
		/** @var $user User */
		$user = User::find()->andWhere(['username' => $old])->one();

		if ($user)
		{
			$user->username = $new;
			$user->save();
		}
		else
		{
			echo "$old not found\n";
		}
	}

	public function actionFind($name)
	{
		$users = User::find()->andWhere(['username' => $name])->all();

		foreach ($users as $user)
		{
			var_dump($user->getAttributes());
		}
	}

	public function actionClear()
	{
		$count = User::deleteAll();

		echo "$count users deleted\n";
	}
}