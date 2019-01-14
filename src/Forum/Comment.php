<?php
namespace Anax\Forum;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

class Comment extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Comment";

    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $content;
    public $question_id;
}
