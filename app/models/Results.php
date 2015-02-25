<?php

class Results extends \Phalcon\Mvc\Model
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
    public $exam_id;

    /**
     *
     * @var integer
     */
    public $question_id;

    /**
     *
     * @var integer
     */
    public $answer_id;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'exam_id' => 'exam_id', 
            'question_id' => 'question_id', 
            'answer_id' => 'answer_id'
        );
    }

}
