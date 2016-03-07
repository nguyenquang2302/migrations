<?php

use Phinx\Migration\AbstractMigration;

class ClassRoom extends AbstractMigration
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
        $table = $this->table('classroom', [
            'id' => 'id',
            'primary_key' => 'id'
        ]);
        $table->addColumn('year', 'year')
            ->addColumn('grade_id', 'integer')
            ->addColumn('section', 'string', ['limit' => 2])
            ->addColumn('status', 'boolean')
            ->addColumn('remarks', 'string', ['limit' => 45])
            ->addColumn('teacher_id', 'integer')
            ->addForeignKey('grade_id', 'grade', 'id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->addForeignKey('teacher_id', 'teacher', 'id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
