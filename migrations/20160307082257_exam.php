<?php

use Phinx\Migration\AbstractMigration;

class Exam extends AbstractMigration
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
         $table = $this->table('exam', [
            'id' => 'exam_id',
            'primary_key' => 'exam_id'
        ]);
        $table->addColumn('exam_type_id','integer')
            ->addColumn('name', 'string', ['limit' => 45])
            ->addColumn('start_date', 'timestamp')
            ->addForeignKey('exam_type_id', 'exam_type', 'exam_type_id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
