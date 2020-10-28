<?php

namespace app\models;

use yii\base\Model;

class DateFormat extends Model {

    public $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function changeDateFormat()
    {
        if($this->date != '') {
            $date_exploded = explode("-", $this->date);
            $year = $date_exploded[0];
            $month = $date_exploded[1];
            $day = $date_exploded[2];
            $date = $day . '.' . $month . '.' . $year;

            return $date;
        }
    }

    public function changeDateTimeFormat() {
        if($this->date != '') {
            $date_time_exploded = explode("T", $this->date);
            $date_first = $date_time_exploded['0'];
            $time = $date_time_exploded['1'];

            $date_exploded = explode("-", $date_first);

            $year = $date_exploded[0];
            $month = $date_exploded[1];
            $day = $date_exploded[2];

            $date_time = $day . '.' . $month . '.' . $year . ' (' . $time . ')';

            return $date_time;
        }
    }
}