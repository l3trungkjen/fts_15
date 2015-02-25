<?php

use Phalcon\Mvc\Model\Relation;

class Categories extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $created;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id', 
            'name' => 'name', 
            'created' => 'created', 
            'status' => 'status'
        ];
    }

    public function initialize()
    {
        $this->hasMany(
            'id',
            'Questions',
            'category_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
        $this->hasMany(
            'id',
            'Examinations',
            'category_id',
            [
                'foreignKey' => [
                    'action' => Relation::ACTION_CASCADE
                ]
            ]
        );
    }
}
