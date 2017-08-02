<?php

namespace violuke\Barcodes\Tests;

use violuke\Barcodes\BarcodeValidator;

class BarcodeValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testInit()
    {
        $validator = new BarcodeValidator('12345123');
        $this->assertInstanceOf('\violuke\Barcodes\BarcodeValidator', $validator);
    }

    public function testEan()
    {

        $validator = new BarcodeValidator('string123');
        $this->assertFalse($validator->isValid());

        $validator = new BarcodeValidator('5060411950138');
        $this->assertFalse($validator->isValid());

        $validator = new BarcodeValidator('001303050100');
        $this->assertFalse($validator->isValid());

        $validator = new BarcodeValidator('2100000030019');
        $this->assertTrue($validator->isValid());
        $this->assertSame(BarcodeValidator::TYPE_EAN_RESTRICTED, $validator->getType());

        $validator = new BarcodeValidator('570691542245');
        $this->assertTrue($validator->isValid());
        $this->assertSame(BarcodeValidator::TYPE_UPC_COUPON_CODE, $validator->getType());

        $validator = new BarcodeValidator('8838108476586');
        $this->assertTrue($validator->isValid());
        $this->assertSame(BarcodeValidator::TYPE_EAN, $validator->getType());

        $validator = new BarcodeValidator('5060411950139');
        $this->assertTrue($validator->isValid());
        $this->assertSame(BarcodeValidator::TYPE_EAN, $validator->getType());

        $validator = new BarcodeValidator('0700867967774');
        $this->assertTrue($validator->isValid());
        $this->assertSame(BarcodeValidator::TYPE_EAN, $validator->getType());

        $validator = new BarcodeValidator('700867967774');
        $this->assertTrue($validator->isValid());
        $this->assertSame(BarcodeValidator::TYPE_UPC, $validator->getType());
    }
}