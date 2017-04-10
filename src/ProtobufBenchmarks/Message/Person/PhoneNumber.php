<?php
/**
 * Auto generated from person.proto at 2017-04-10 15:58:36
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
    const TYPE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NUMBER => array(
            'name' => 'number',
            'required' => true,
            'type' => 7,
        ),
        self::TYPE => array(
            'default' => \ProtobufBenchmarks\Message\Person\PhoneNumber\PhoneType::HOME, 
            'name' => 'type',
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
        $this->values[self::TYPE] = \ProtobufBenchmarks\Message\Person\PhoneNumber\PhoneType::HOME;
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
     * Sets value of 'type' property
     *
     * @param PhoneType $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return PhoneType
     */
    public function getType()
    {
        return $this->get(self::TYPE);
    }
}
}