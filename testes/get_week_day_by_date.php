<?php

$horario = "17:00";

$var = get_week_day_by_date("2018-10-15") . explode(":", $horario)[0];

echo $var;

function get_week_day_by_date($date) {
    $convertWeekDay = array('Mon' => 'seg',
                            'Tue' => 'ter',
                            'Wed' => 'qua',
                            'Thu' => 'qui',
                            'Fri' => 'sex',
                            'Sat' => 'NaN',
                            'Sun' => 'NaN');

    return $convertWeekDay[date('D', strtotime($date))];
}


?>