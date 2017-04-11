# Overview

This project was created to compare the payload size and performance of serialization formats (Protocol Buffers, XML, JSON, YAML, TOML, native PHP object serialization).

# Setup

I used PHP package `athletic/athletic` to execute this benchmark, simply comparing the performance of encoding / decoding a simple data structure.

*NOTE:* I did not use the official Protobuf library for PHP as I could not reliably get the extension to work and the performance of the native PHP code package was far slower than any of the other technologies in this benchmark.

## Platform

* Mac OS X
* protoc 3.2.0
* PHP 7.1.1
* basho/protobuf
* symfony/yaml
* yosymfony/toml
* sabre/xml

## Proto message

```
message Person {
  required string name = 1;
  required int32 id = 2;
  optional string email = 3;

  message PhoneNumber {
    enum PhoneType {
      HOME = 0;
      MOBILE = 1;
      WORK = 2;
    }

    required string number = 1;
    optional PhoneType type = 2 [default = HOME];
  }

  repeated PhoneNumber phone = 4;
}
```

# Payload

Below, you can see the size and raw output of the serialized payload using each serialization method.

|Technology|PayloadSize|
|PB|712b|
|JSON|1104b|
|YAML|1104b|
|TOML|1664b|
|PHP|1864b|
|XML|2728b|

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

|Technology|Encode Ops/Second|Decode Ops/Second|
|PHP|239,935|173,060|
|JSON|95,911|198,406|
|PB|23,160|10,557|
|XML|1,014|597|
|YAML|685|339|
|TOML|678|82|

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

# Conclusion

Protocol Buffers payload size is by far the smallest and not surprising since this method of serialization does not include syntax defining the structure of the data. PB payload size in this benchmark was 35.5% and 73.9% smaller than the JSON and XML payloads respectively.

The performance of PB with PHP is a little disappointing as it comes in the middle of the pack, with PHP serialization came out on top. Despite encoding 2184% and decoding 1668% faster than XML, JSON encoded 75.9% and decoded 94.7% faster than PB.

There are a few possible reasons for underperforming JSON and PHP serialization. The first is that both methods of serialization are core to the PHP runtime, meaning they have experienced countless iterations of improvements and optimizations over the last two and half decades.

The other reason is that official PB support for PHP is still alpha and the library I used for this project, `basho/protobuf`, is the offspring of a small community. Despite being a reasonably mature and stable extension, I am certain there is significant room for performance improvements.

When official support for PHP improves from the protobuf team, I will update this benchmark using the official PHP extension.
