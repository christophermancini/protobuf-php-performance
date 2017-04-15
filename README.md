# Overview

This project was created to compare the payload size and performance of serialization formats (Protocol Buffers, XML, JSON, YAML, TOML, native PHP object serialization).

# Setup

I used PHP package `athletic/athletic` to execute this benchmark, simply comparing the performance of encoding / decoding a simple data structure.

*NOTE:* I did not use the official Protobuf library for PHP as I could not reliably get the extension to work and the performance of the native PHP code package was far slower than any of the other technologies in this benchmark.

## Platform

* Mac OS X
* protoc 3.2.0
* PHP 7.1.1
* google/protobuf [package]
* symfony/yaml
* yosymfony/toml
* sabre/xml

## Dependency Setup

```bash
# install protoc
brew install protobuf

# install composer deps
composer install

# generate proto messages
protoc --php_out=src/ person.proto
```

## Execution

```bash
./vendor/bin/athletic -p src/ -b vendor/autoload.php
```

## Proto message

```
syntax = "proto3";

package ProtobufBenchmarks.Message;

message Person {
  string name = 1;
  int32 id = 2;
  string email = 3;

  enum PhoneType {
    MOBILE = 0;
    HOME = 1;
    WORK = 2;
  }

  message PhoneNumber {
    string number = 1;
    PhoneType type = 2;
  }

  repeated PhoneNumber phone = 4;
}
```

# Payload

Below, you can see the size and raw output of the serialized payload using each serialization method.

| Technology | PayloadSize |
|------------|-------------|
| PB         | 680b        |
| JSON       | 1104b       |
| YAML       | 1104b       |
| TOML       | 1664b       |
| PHP        | 1864b       |
| XML        | 2728b       |

## PB

680 bits

```

Christopher Mancinichris@mydomain.com"


0123456789"


1234567890"


2345678901
```

## XML

2728 bits

```xml
<?xml version="1.0"?>
<person>
 <full_name>Christopher Mancini</full_name>
 <id>1</id>
 <email>chris@mydomain.com</email>
 <phone>
  <type>home</type>
  <number>0123456789</number>
 </phone>
 <phone>
  <type>mobile</type>
  <number>1234567890</number>
 </phone>
 <phone>
  <type>work</type>
  <number>2345678901</number>
 </phone>
</person>
```

## JSON

1104 bits

```json
{"name":"Christopher Mancini","id":1,"email":"chris@mydomain.com","phone":{"home":"0123456789","mobile":"1234567890","work":"2345678901"}}
```

## YAML

1104 bits

```yaml
name: 'Christopher Mancini'
id: 1
email: chris@mydomain.com
phone:
    home: '0123456789'
    mobile: '1234567890'
    work: '2345678901'
```

## TOML

1664 bits

```toml
name = "Christopher Mancini"
id = 1
email = "chris@mydomain.com"

[[phone]]
type = "home"
number = "0123456789"

[[phone]]
type = "mobile"
number = "1234567890"

[[phone]]
type = "work"
number = "2345678901"
```

## PHP Object Serialization

1864 bits

```php
O:25:"ProtobufBenchmarks\Person":4:{s:4:"name";s:19:"Christopher Mancini";s:2:"id";i:1;s:5:"email";s:18:"chris@mydomain.com";s:5:"phone";a:3:{s:4:"home";s:10:"0123456789";s:6:"mobile";s:10:"1234567890";s:4:"work";s:10:"2345678901";}}
```

# Performance

| Technology | Encode Ops/Second | Decode Ops/Second |
| ---------- | ----------------- | ----------------- |
| PHP        | 171,189           | 122,375           |
| JSON       | 76,436            | 96,431            |
| XML        | 957               | 524               |
| YAML       | 620               | 301               |
| PB         | 260               | 363               |
| TOML       | 614               | 76                |

```
ProtobufBenchmarks\DecodeEvent
    Method Name      Iterations    Average Time      Ops/second
    --------------  ------------  --------------    -------------
    decodeProtobuf: [1,000     ] [0.0027496304512] [363.68524]
    decodeXml     : [1,000     ] [0.0019056563377] [524.75359]
    decodeJson    : [1,000     ] [0.0000103700161] [96,431.86573]
    decodeYaml    : [1,000     ] [0.0033161306381] [301.55627]
    decodeToml    : [1,000     ] [0.0130415604115] [76.67794]
    decodePhp     : [1,000     ] [0.0000081715584] [122,375.67836]

ProtobufBenchmarks\EncodeEvent
    Method Name      Iterations    Average Time      Ops/second
    --------------  ------------  --------------    -------------
    encodeProtobuf: [1,000     ] [0.0038354923725] [260.72272]
    encodeXml     : [1,000     ] [0.0010448067188] [957.11483]
    encodeJson    : [1,000     ] [0.0000130827427] [76,436.57172]
    encodeYaml    : [1,000     ] [0.0016120166779] [620.34098]
    encodeToml    : [1,000     ] [0.0016279020309] [614.28758]
    encodePhp     : [1,000     ] [0.0000058414936] [171,189.09432]
```
