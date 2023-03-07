<?php
$d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d");
                $expireDate=date('Y-m-d', strtotime('+1 month'));

echo $date;

echo $expireDate;


                ?>