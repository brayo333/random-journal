<?php

namespace App\Helpers;

use DateTime;

function convertTime($timeString) {
  $dateTime = new DateTime($timeString);
  return $dateTime->format('d-m-Y h:i A');
}
