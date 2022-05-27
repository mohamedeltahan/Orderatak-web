<?php namespace App\Traits;

use Carbon\Carbon;

trait Time
{

    public function getYear(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->year;
    }
    public function getMonth(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->month;
    }
    public function getDay()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->day;
    }
    public function getYearMonth()
    {
        return $this->getYear().'-'.$this->getMonth();
    }
    public function getDate()
    {
        return explode(' ', $this->created_at)[0];
    }
    public function getTime()
    {
        $time =  explode(' ', $this->created_at)[1];
        $hours = explode(':', $time)[0];
        if($hours / 12 > 1) {
            $hours = $hours % 12;
            $time = substr_replace($time, $hours, 0, 2).' am';
        }
        else $time = $time . ' pm';
        return $time;

    }

    public function setTemp(&$temp)
    {
        $temp = $this->getYearMonth();
    }
    public function setTempDay(&$tempDay)
    {
        $tempDay = $this->getDay();
    }
    public function setTempMonthYear(&$tempMonthYear, $temp){$tempMonthYear = $temp;}
    public function startOfMonth($temp, $tempMonthYear)
    {
        return ($temp != $tempMonthYear)? true: false;
    }
    public function showMonth($temp)
    {
        return $temp;
    }
    public function startOfDay($tempDay)
    {
        return ($this->getDay() != $tempDay) ? true: false;
    }
    public function showDate()
    {
        return $this->getDate();
    }
    public function endOfDay($nextObject)
    {
        return ($this->getDay() != $nextObject->getDay())? true: false;
    }
    public function endOfMonth($nextObject)
    {
        return ($this->getMonth() != $nextObject->getMonth())? true: false;

    }
    public function sameDay($nextObject)
    {
        return ($this->getDay() == $nextObject->getDay())? true : false;
    }
    public function differentMonth($nextObject)
    {
        return ($this->getMonth() != $nextObject->getMonth() )? true : false;
    }
    public function hour(){
        return explode(" ",$this->created_at)[1];
    }
}
