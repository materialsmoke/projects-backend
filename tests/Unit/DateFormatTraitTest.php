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
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(59) === "00:00:59");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(60) === "00:01:00");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(120) === "00:02:00");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(599) === "00:09:59");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(600) === "00:10:00");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(3599) === "00:59:59");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(3600) === "01:00:00");
    }
    
    public function testSecondIsAlwaysTwoDigits()
    {
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(0) === "00:00:00");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(1) === "00:00:01");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(2) === "00:00:02");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(3) === "00:00:03");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(9) === "00:00:09");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(10) === "00:00:10");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(59) === "00:00:59");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(60) === "00:01:00");
        $this->assertTrue(DateFormatTrait::secondsToHoursMinutesSeconds(61) === "00:01:01");
    }

    public function testSecondCannotBeOneDigits()
    {
        $time = DateFormatTrait::secondsToHoursMinutesSeconds(1);
        $this->assertNotTrue($time === "00:00:1");
    }
}
