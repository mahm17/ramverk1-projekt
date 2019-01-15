<?php
namespace Anax\Forum;

use Anax\DatabaseActiveRecord\ActiveRecordModel;
use Anax\Database\Database;

class Forum extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Forum";

    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $title;
    public $content;
    public $tag;
}
