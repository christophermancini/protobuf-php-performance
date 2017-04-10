<?php
/**
 * Auto generated from person.proto at 2017-04-10 15:58:36
 *
 * ProtobufBenchmarks\Message package
 */
namespace ProtobufBenchmarks\Message\Person\PhoneNumber {
/**
 * PhoneType enum embedded in PhoneNumber/Person message
 */
final class PhoneType
{
    const HOME = 0;
    const MOBILE = 1;
    const WORK = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'HOME' => self::HOME,
            'MOBILE' => self::MOBILE,
            'WORK' => self::WORK,
        );
    }
}
}