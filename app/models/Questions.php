<?php

use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Relation;

class Questions extends \Phalcon\Mvc\Model
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
    public $category_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'category_id' => 'category_id',
            'name' => 'name'
        ];
    }

    public function initialize()
    {
        $this->hasMany(
            'id',
            'Answers',
            'question_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
        $this->belongsTo('category_id', 'Categories', 'id');
    }

    public function validation()
    {
        $this->validate(new PresenceOf(
            [
                'field'   => 'category_id',
                'message' => 'Category name is required.',
            ]
        ));
        $this->validate(new PresenceOf(
            [
                'field'   => 'name',
                'message' => 'Question name is required.',
            ]
        ));
        return $this->validationHasFailed() != true;
    }

}
