<?php

class Examinations extends \Phalcon\Mvc\Model
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
    public $user_id;

    /**
     *
     * @var integer
     */
    public $category_id;

    /**
     *
     * @var string
     */
    public $datetime;

    /**
     *
     * @var string
     */
    public $result_question;

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

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'user_id' => 'user_id', 
            'category_id' => 'category_id', 
            'datetime' => 'datetime', 
            'result_question' => 'result_question', 
            'created' => 'created', 
            'status' => 'status'
        );
    }

    public function initialize()
    {
        $this->skipAttributesOnUpdate(['user_id', 'category_id', 'created']);
        $this->belongsTo('category_id', 'Categories', 'id');
    }

    public static function fetchAll()
    {
        return Examinations::query()
            ->columns(['Examinations.*', 'category_name' => 't2.name'])
            ->join('Categories', 'Examinations.category_id=t2.id', 't2')
            ->orderBy("Examinations.created DESC")
            ->execute();
    }

    public static function formatDatetime($time)
    {
        $hour = $time / (60 * 60) % 24;
        $minute = ($time / 60) % 60;
        $second = $time % 60;
        if ($hour < 10) {
            $_time_hour = '0' . $hour;
        } else {
            $_time_hour = $hour;
        }
        if ($minute < 10) {
            $_time_minute = '0' . $minute;
        } else {
            $_time_minute = $minute;
        }
        if ($second < 10) {
            $_time_second = '0' . $second;
        } else {
            $_time_second = $second;
        }
        return $_time_hour . ':' . $_time_minute . ':' . $_time_second;
    }

}
