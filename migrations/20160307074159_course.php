<?php

use Phinx\Migration\AbstractMigration;

class Course extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('course', [
            'id' => 'course_id',
            'primary_key' => 'course_id'
        ]);
        $table->addColumn('name', 'string', ['limit' => 45])
            ->addColumn('description', 'string', ['limit' => 45])
            ->addColumn('grade_id', 'integer')
            ->addForeignKey('grade_id', 'grade', 'grade_id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
