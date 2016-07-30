<?php
namespace Soukicz\Mailgun;

class Address {
    /**
     * @var string
     */
    private $name, $email;

    /**
     * Address constructor.
     * @param string $email
     * @param string $name
     */
    public function __construct($email, $name = null) {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

}
