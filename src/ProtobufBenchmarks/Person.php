<?php

namespace ProtobufBenchmarks;

use ProtobufBenchmarks\Message;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBType;

class Person
{
    public $name  = "";
    public $id    = null;
    public $email = "";
    public $phone = [];

    public function GenerateArray()
    {
        return [
            'name'  => $this->name,
            'id'    => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    public function GenerateProto()
    {
        $message = new Message\Person();
        $message->setName($this->name);
        $message->setId($this->id);
        $message->setEmail($this->email);

        $phones = new RepeatedField(GPBType::MESSAGE, Message\Person_PhoneNumber::class);
        foreach ($this->phone as $key => $value) {
            $phone = new Message\Person_PhoneNumber();
            $phone->setNumber($value);
            switch ($key) {
                case 'home':
                    $phone->setType(Message\Person_PhoneType::HOME);
                case 'work':
                    $phone->setType(Message\Person_PhoneType::WORK);
                default:
                    $phone->setType(Message\Person_PhoneType::MOBILE);
            }
            $phones[] = $phone;
        }

        $message->setPhone($phones);

        return $message;
    }

    public function SetName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function SetId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function SetEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function AddPhone($type, $number)
    {
        $this->phone[$type] = $number;

        return $this;
    }

    public function GetName()
    {
        return $this->name;
    }

    public function GetId()
    {
        return $this->id;
    }

    public function GetEmail()
    {
        return $this->email;
    }

    public function toArray()
    {
        return $this->asArray;
    }

    public function toProtoMessage()
    {
        return $this->asProtoMessage;
    }
}
