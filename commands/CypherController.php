<?php

namespace app\commands;

use app\models\User;
use app\models\UserDetail;
use yii;
use yii\console\Controller;

class CypherController extends Controller
{
    /**
     * Insert a new User with age in the database
     * @param string $username
     * @param integer|string $age
     */
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

        echo "User created.\n";
	}

    /**
     * Find all User by age
     * @param integer|string $age
     */
    public function actionFindByAge($age)
	{
		/** @var $details UserDetail[] */
		$details = UserDetail::find()->andWhere(['name' => 'Age', 'value' => $age])->all();

        if ($details)
        {
            foreach ($details as $detail)
            {
                var_dump($detail->user);
            }
        }
        else
        {
            echo "UserDetail not found.\n";
        }
	}

    /**
     * Rename a User in the database
     * @param string $old The old username
     * @param string $new The new username
     */
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

    /**
     * Find all User by name.
     * @param $name
     */
    public function actionFind($name)
	{
		$users = User::find()->andWhere(['username' => $name])->all();

        if ($users)
        {
            foreach ($users as $user)
            {
                var_dump($user->getAttributes());
            }
        }
        else
        {
            echo "User not found.\n";
        }
	}

    /**
     * Find all UserDetail by name/type (not by value).
     * @param $name
     */
    public function actionFindDetail($name)
	{
		$models = UserDetail::find()->with('user')->andWhere(['name' => $name])->all();

        if ($models)
        {
            foreach ($models as $model)
            {
                var_dump($model->getAttributes());
            }
        }
        else
        {
            echo "UserDetail not found.\n";
        }
	}

    /**
     * Find all User by name.
     * @param $name
     */
    public function actionDeleteUser($name)
    {
        $users = User::find()->andWhere(['username' => $name])->all();

        foreach ($users as $user)
        {
            if ($user->delete())
            {
                echo "User deleted.\n";
            }
        }
    }

    /**
     * Delete all Users from the database.
     */
    public function actionClear()
	{
		if (User::deleteAll())
        {
		    echo "All users deleted.\n";
        }
	}
}