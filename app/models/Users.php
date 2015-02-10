<?php

use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Users extends \Phalcon\Mvc\Model
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
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $re_password;

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

    const STATUS_ADMIN = 1;
    const STATUS_USER = 0;

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                [
                    'field'    => 'email',
                    'required' => true,
                ]
            )
        );
        if (!empty($this->re_password)) {
            if (strcmp($this->password, $this->re_password) !== 0) {
                $this->_errorMessages[] = new Message('Re-password must be the same Password', 'password', 'Hash');
                return false;
            }
        } else {
            $this->_errorMessages[] = new Message('Re-password is required', 're_password', 'Hash');
            return false;
        }
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id', 
            'name' => 'name', 
            'email' => 'email', 
            'password' => 'password', 
            're_password' => 're_password', 
            'created' => 'created', 
            'status' => 'status'
        ];
    }

    public static function fetchByEmailPassword($data)
    {
        return \Phalcon\DI::getDefault()->getModelsManager()->createBuilder()
            ->from('Users')
            ->where('email=:email: AND password=:password:',
                [
                    'email' => $data['email'],
                    'password' => $data['password']
                ])
            ->getQuery()
            ->execute()
            ->getFirst();
    }

}
