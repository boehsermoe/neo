<?php
/**
 * Created by PhpStorm.
 * User: bk
 * Date: 05.05.15
 * Time: 08:37
 */

namespace app\models;


use neo4j\db\ActiveQuery;
use neo4j\db\ActiveRecord;

class UserDetail extends ActiveRecord
{
	public $id;
	public $name;
	public $value;

	public function getUser()
	{
		return $this->hasOne(UserDetail::className(), ['HAS'], ActiveQuery::DIRECTION_IN);
	}
}