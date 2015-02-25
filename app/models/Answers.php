<?php

use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Answers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $question_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var integer
     */
    public $correct;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'question_id' => 'question_id', 
            'name' => 'name', 
            'correct' => 'correct'
        );
    }

    public function initialize() {
        $this->belongsTo('question_id', 'Questions', 'id');
    }

    public function validation()
    {
        $this->validate(new PresenceOf(
            [
                'field'   => 'name',
                'message' => 'Answer name is required.',
            ]
        ));
        return $this->validationHasFailed() != true;
    }

    public static function fetchByIdAndQuestionId($id, $question_id)
    {
        return Answers::findFirst(
            [
                'conditions' => 'id = :id: AND question_id = :question_id:',
                'bind' => [
                    'id' => $id,
                    'question_id' => $question_id
                ]
            ]
        );
    }
}
