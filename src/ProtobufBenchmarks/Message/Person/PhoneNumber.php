<?php
/**
 * Auto generated from person.proto at 2017-04-10 15:53:18
 *
 * ProtobufBenchmarks\Message package
 */

namespace ProtobufBenchmarks\Message\Person {
/**
 * PhoneNumber message embedded in Person message
 */
class PhoneNumber extends \ProtobufMessage
{
    /* Field index constants */
    const NUMBER = 1;
    const PHONE_TYPE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NUMBER => array(
            'name' => 'number',
            'required' => true,
            'type' => 7,
        ),
        self::PHONE_TYPE => array(
            'default' => \ProtobufBenchmarks\Message\Person\PhoneNumber\PhoneType::HOME, 
            'name' => 'phone_type',
            'required' => false,
            'type' => 5,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::NUMBER] = null;
        $this->values[self::PHONE_TYPE] = \ProtobufBenchmarks\Message\Person\PhoneNumber\PhoneType::HOME;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'number' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setNumber($value)
    {
        return $this->set(self::NUMBER, $value);
    }

    /**
     * Returns value of 'number' property
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->get(self::NUMBER);
    }

    /**
     * Sets value of 'phone_type' property
     *
     * @param PhoneType $value Property value
     *
     * @return null
     */
    public function setPhoneType($value)
    {
        return $this->set(self::PHONE_TYPE, $value);
    }

    /**
     * Returns value of 'phone_type' property
     *
     * @return PhoneType
     */
    public function getPhoneType()
    {
        return $this->get(self::PHONE_TYPE);
    }
}
}