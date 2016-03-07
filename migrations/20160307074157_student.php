<?php

use Phinx\Migration\AbstractMigration;

class Student extends AbstractMigration
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
        $table = $this->table('student', [
            'id' => 'student_id',
            'primary_key' => 'student_id'
        ]);
        $table->addColumn('email', 'string', ['limit' => 45])
            ->addColumn('password', 'string', ['limit' => 45])
            ->addColumn('fname', 'string', ['limit' => 45])
            ->addColumn('lname', 'string', ['limit' => 45])
            ->addColumn('role', 'string', ['limit' => 20])
            ->addColumn('dob', 'timestamp')
            ->addColumn('phone', 'string', ['limit' => 15])
            ->addColumn('mobile', 'string', ['limit' => 15])
            ->addColumn('parent_id', 'integer')
            ->addColumn('date_of_join', 'timestamp')
            ->addColumn('status', 'boolean')
            ->addColumn('last_login_date', 'timestamp')
            ->addColumn('last_login_ip', 'string', ['limit' => 45])
            ->addForeignKey('parent_id', 'parent', 'parent_id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
