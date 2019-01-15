<?php
namespace Anax\Forum;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

class Answer extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Svar";

    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $content;
    public $questionId;
}
