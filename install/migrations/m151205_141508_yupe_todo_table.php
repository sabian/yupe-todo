<?php

class m151205_141508_yupe_todo_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->createTable('{{todo}}', [
			'id' => 'pk',
			'description' => 'string NOT NULL',
			'status' => 'TINYINT(1) NOT NULL DEFAULT 1',
			'sort' => 'integer NOT NULL DEFAULT 1',
		], $this->getOptions());
	}

	public function safeDown()
	{
		$this->dropTable('{{todo}}');
	}
}