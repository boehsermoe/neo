<?php

namespace app\commands;

use app\models\User;
use app\models\UserDetail;
use yii;
use yii\console\Controller;

class CypherController extends Controller
{
	public function actionCreate($username)
	{
		#$user = new User();
		#$user->username = $username;
		#$user->save();

		$detail = new UserDetail();
		$detail->name = 'Detail1';
		#$detail->save();

		#$user->link('details', $detail);

		var_dump($detail->user);
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

	public function actionFindDetail($name)
	{
		$models = UserDetail::find()->with('user')->andWhere(['name' => $name])->all();

		foreach ($models as $model)
		{
			var_dump($model->getAttributes());
		}
	}

	public function actionClear()
	{
		$count = User::deleteAll();

		echo "$count user(s) deleted\n";
	}
}