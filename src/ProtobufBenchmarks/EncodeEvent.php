<?php

namespace ProtobufBenchmarks;

use Athletic\AthleticEvent;
use Symfony\Component\Yaml\Yaml;
use Yosymfony\Toml\TomlBuilder;
use Sabre\Xml\Service;

class EncodeEvent extends AthleticEvent
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
    }

    public function classTearDown()
    {
        foreach ($this->data as $protocol => $data) {
            $size = strlen($data) * 8;
            echo "{$protocol} {$size} bits of memory:\n";
            echo "$data\n\n";
        }
    }

    /**
     * @iterations 10000
     */
    public function encodeProtobuf()
    {
        $this->data['protobuf'] = $this->personProto->serializeToString();
    }

    /**
     * @iterations 10000
     */
    public function encodeXml()
    {
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
    }

    /**
     * @iterations 10000
     */
    public function encodeJson()
    {
        $this->data['json'] = json_encode($this->person->GenerateArray());
    }

    /**
     * @iterations 10000
     */
    public function encodeYaml()
    {
        $this->data['yaml'] = Yaml::dump($this->person->GenerateArray());
    }

    /**
     * @iterations 10000
     */
    public function encodeToml()
    {
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
    }

    /**
     * @iterations 10000
     */
    public function encodePhp()
    {
        $this->data['php'] = serialize($this->person);
    }
}
