<?php

namespace Volosatov;

class WorkHours
{
    private $offtimes = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 13, 19, 20, 21, 22, 23);
    private $weekends = array("Sat", "Sun");
    private $holydays = array(
        "2018-01-01",
        "2018-01-02",
        "2018-01-03",
        "2018-01-04",
        "2018-01-05",
        "2018-01-06",
        "2018-01-07",
        "2018-01-08",
        "2018-02-23",
        "2018-03-08"
    );

    public function addHours($date, $hours)
    {
        $time = strtotime($date);
        for ($j = 0; $j < $hours; $j++) {
            $time = $this->addHour($time);
        }
        return date("Y-m-d H:i:s", $time);
    }

    private function addHour($time)
    {
        do {
            $time += 3600;
        } while ($this->isWeekend($time) || $this->isHolyday($time) || $this->isOfftime($time));

        return $time;
    }

    private function isOfftime($time)
    {
        return in_array(date("G", $time), $this->offtimes);
    }

    private function isWeekend($time)
    {
        return in_array(date("D", $time), $this->weekends);
    }

    private function isHolyday($time)
    {
        return in_array(date("Y-m-d", $time), $this->holydays);
    }
}

$wh = new WorkHours();
$date_from = "2017-12-29 17:00:00";
$date_till = $wh->addHours($date_from, 2);
echo $date_from . "\n" . $date_till;
