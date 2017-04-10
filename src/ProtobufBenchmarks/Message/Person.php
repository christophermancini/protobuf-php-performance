<?php
/**
 * Auto generated from person.proto at 2017-04-10 15:58:36
 *
 * ProtobufBenchmarks\Message package
 */

namespace ProtobufBenchmarks\Message {
/**
 * Person message
 */
class Person extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const ID = 2;
    const EMAIL = 3;
    const PHONE = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => true,
            'type' => 7,
        ),
        self::ID => array(
            'name' => 'id',
            'required' => true,
            'type' => 5,
        ),
        self::EMAIL => array(
            'name' => 'email',
            'required' => false,
            'type' => 7,
        ),
        self::PHONE => array(
            'name' => 'phone',
            'repeated' => true,
            'type' => '\ProtobufBenchmarks\Message\Person\PhoneNumber'
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
        $this->values[self::NAME] = null;
        $this->values[self::ID] = null;
        $this->values[self::EMAIL] = null;
        $this->values[self::PHONE] = array();
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
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        return $this->get(self::NAME);
    }

    /**
     * Sets value of 'id' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setId($value)
    {
        return $this->set(self::ID, $value);
    }

    /**
     * Returns value of 'id' property
     *
     * @return int
     */
    public function getId()
    {
        return $this->get(self::ID);
    }

    /**
     * Sets value of 'email' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setEmail($value)
    {
        return $this->set(self::EMAIL, $value);
    }

    /**
     * Returns value of 'email' property
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->get(self::EMAIL);
    }

    /**
     * Appends value to 'phone' list
     *
     * @param \ProtobufBenchmarks\Message\Person\PhoneNumber $value Value to append
     *
     * @return null
     */
    public function appendPhone(\ProtobufBenchmarks\Message\Person\PhoneNumber $value)
    {
        return $this->append(self::PHONE, $value);
    }

    /**
     * Clears 'phone' list
     *
     * @return null
     */
    public function clearPhone()
    {
        return $this->clear(self::PHONE);
    }

    /**
     * Returns 'phone' list
     *
     * @return \ProtobufBenchmarks\Message\Person\PhoneNumber[]
     */
    public function getPhone()
    {
        return $this->get(self::PHONE);
    }

    /**
     * Returns 'phone' iterator
     *
     * @return ArrayIterator
     */
    public function getPhoneIterator()
    {
        return new \ArrayIterator($this->get(self::PHONE));
    }

    /**
     * Returns element from 'phone' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \ProtobufBenchmarks\Message\Person\PhoneNumber
     */
    public function getPhoneAt($offset)
    {
        return $this->get(self::PHONE, $offset);
    }

    /**
     * Returns count of 'phone' list
     *
     * @return int
     */
    public function getPhoneCount()
    {
        return $this->count(self::PHONE);
    }
}
}