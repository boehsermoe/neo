<?php

namespace app\commands;

use app\models\User;
use app\models\UserDetail;
use yii;
use yii\console\Controller;

class CypherController extends Controller
{
	public function actionCreate($username, $age)
	{
		$user = new User();
		$user->username = $username;
		$user->save();

		$detail = new UserDetail();
		$detail->name = 'Age';
		$detail->value = $age;
		$detail->save();

		$user->link('details', $detail);
	}

	public function actionUserViaDetail($username)
	{
		/** @var $detail UserDetail */
		$detail = UserDetail::find()->andWhere(['name' => 'Username', 'value' => $username])->one();

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
		if (User::deleteAll())
        {
		    echo "All users deleted\n";
        }
	}
}