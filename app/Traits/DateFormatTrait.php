<?php
namespace App\Traits;

class DateFormatTrait
{
    /**
     * convert seconds to "hh:mm:ss"
     */
    public static function secondsToHoursMinutesSeconds($seconds)
    {
        $h = (int) ($seconds / 3600);
        if($h <= 9){
            $h = "0$h";
        }
        $diff = $seconds % 3600;
        $m = (int) ($diff / 60);
        if($m <= 9){
            $m = "0$m";
        }
        $s = $diff % 60;
        if($s <= 9){
            $s = "0$s";
        }
        $time = "$h:$m:$s";

        return $time;
    }
}