<?php

namespace Tests\Unit;

use App\Traits\DateFormatTrait;
use PHPUnit\Framework\TestCase;

class DateFormatTraitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testConvertCorrectly()
    {
        // for converting we can use: https://www.inchcalculator.com/convert/second-to-hour/
        $time = DateFormatTrait::secondsToHoursMinutesSeconds(5400);
        $this->assertTrue($time === "01:30:00");
    }

    public function testConvertBigNumbersCorrectly()
    {
        $time = DateFormatTrait::secondsToHoursMinutesSeconds(90111);
        $this->assertTrue($time === "25:01:51");
    }

    public function testConvertVeryBigNumbersCorrectly()
    {
        $time = DateFormatTrait::secondsToHoursMinutesSeconds(9011111333);
        $this->assertTrue($time === "2503086:28:53");
    }

    public function testMinutesIsAlwaysTwoDigits()
    {
        $time = DateFormatTrait::secondsToHoursMinutesSeconds(90059);
        $this->assertTrue($time === "25:00:59");
    }
    
    public function testSecondIsAlwaysTwoDigits()
    {
        $time = DateFormatTrait::secondsToHoursMinutesSeconds(90060);
        $this->assertTrue($time === "25:01:00");
    }

    public function testSecondCannotBeOneDigits()
    {
        $time = DateFormatTrait::secondsToHoursMinutesSeconds(1);
        $this->assertNotTrue($time === "00:00:1");
    }
}
