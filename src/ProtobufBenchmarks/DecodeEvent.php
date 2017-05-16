<?php

namespace ProtobufBenchmarks;

use Athletic\AthleticEvent;
use Symfony\Component\Yaml\Yaml;
use Yosymfony\Toml\TomlBuilder;
use Yosymfony\Toml\Toml;
use Sabre\Xml\Service;

class DecodeEvent extends AthleticEvent
{
    /**
     * @var \ProtobufBenchmarks\Person
     */
    protected $person = null;

    protected $personProto = null;

    protected $data = [
        'protobuf' => null,
        'xml' => null,
        'json' => null,
        'yaml' => null,
        'toml' => null,
        'php' => null,
    ];

    public function classSetUp()
    {
        $this->person = (new Person())
            ->SetName("Christopher Mancini")
            ->SetId(1)
            ->SetEmail("chris@mydomain.com")
            ->AddPhone("home", "0123456789")
            ->AddPhone("mobile", "1234567890")
            ->AddPhone("work", "2345678901");

        $this->personProto = $this->person->GenerateProto();
        $this->data['protobuf'] = $this->personProto->serializeToString();

        $service = new Service();
        $phones = [];
        foreach ($this->person->phone as $type => $number) {
            $phones[] = ['name' => 'phone', 'value' => ['type' => $type, 'number' => $number]];
        }
        $this->data['xml'] = $service->write('person', array_merge([
            'full_name' => $this->person->GetName(),
            'id' => $this->person->GetId(),
            'email' => $this->person->GetEmail(),
        ], $phones));

        $this->data['json'] = json_encode($this->person->GenerateArray());

        $this->data['yaml'] = Yaml::dump($this->person->GenerateArray());

        $tb = new TomlBuilder();

        $data = $tb->addValue('name', $this->person->GetName())
            ->addValue('id', $this->person->GetId())
            ->addValue('email', $this->person->GetEmail());

        foreach ($this->person->phone as $type => $number) {
            $data->addArrayTables('phone')
                ->addValue('type', $type)
                ->addValue('number', $number);
        }

        $this->data['toml'] = $data->getTomlString();

        $this->data['php'] = serialize($this->person);
    }

    /**
     * @iterations 10000
     */
    public function decodeProtobuf()
    {
        $data = new Message\Person();
        $data->mergeFromString($this->data['protobuf']);
    }

    /**
     * @iterations 10000
     */
    public function decodeXml()
    {
        $service = new Service();
        $data = $service->parse($this->data['xml']);
    }

    /**
     * @iterations 10000
     */
    public function decodeJson()
    {
        $data = json_decode($this->data['json']);
    }

    /**
     * @iterations 10000
     */
    public function decodeYaml()
    {
        $data = Yaml::parse($this->data['yaml']);
    }

    /**
     * @iterations 10000
     */
    public function decodeToml()
    {
        $data = Toml::Parse($this->data['toml']);
    }

    /**
     * @iterations 10000
     */
    public function decodePhp()
    {
        $data = unserialize($this->data['php']);
    }
}
