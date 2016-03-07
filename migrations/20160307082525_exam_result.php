<?php

use Phinx\Migration\AbstractMigration;

class ExamResult extends AbstractMigration
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
        $table = $this->table('exam_result');
        $table->addColumn('exam_id', 'integer')
            ->addColumn('student_id', 'integer')
            ->addColumn('course_id', 'integer')
            ->addColumn('marks', 'string', ['limit' => 15])
            ->addForeignKey('exam_id', 'exam', 'id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->addForeignKey('student_id', 'student', 'id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->addForeignKey('course_id', 'course', 'id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
