# Overview

This project was created to compare the payload size and performance of serialization formats (Protocol Buffers, XML, JSON, YAML, TOML).

# Setup

* PHP 7.1.1
* basho/protobuf
* symfony/yaml
* yosymfony/toml
* sabre/xml

# Payload

## PB

728 bits

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

```
ProtobufBenchmarks\DecodeEvent
    Method Name      Iterations    Average Time      Ops/second
    --------------  ------------  --------------    -------------
    decodeProtobuf: [1,000     ] [0.0000947201252] [10,557.41848]
    decodeXml     : [1,000     ] [0.0016745967865] [597.15868]
    decodeJson    : [1,000     ] [0.0000050401688] [198,406.05487]
    decodeYaml    : [1,000     ] [0.0029436485767] [339.71446]
    decodeToml    : [1,000     ] [0.0120675928593] [82.86657]
    decodePhp     : [1,000     ] [0.0000057783127] [173,060.90114]


ProtobufBenchmarks\EncodeEvent
    Method Name      Iterations    Average Time      Ops/second
    --------------  ------------  --------------    -------------
    encodeProtobuf: [1,000     ] [0.0000431771278] [23,160.41039]
    encodeXml     : [1,000     ] [0.0009857304096] [1,014.47616]
    encodeJson    : [1,000     ] [0.0000104262829] [95,911.45869]
    encodeYaml    : [1,000     ] [0.0014583096504] [685.72542]
    encodeToml    : [1,000     ] [0.0014738268852] [678.50574]
    encodePhp     : [1,000     ] [0.0000041677952] [239,935.01516]
```