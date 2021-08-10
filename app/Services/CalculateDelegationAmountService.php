<?php


namespace App\Services;


use App\Models\Country;
use Carbon\Carbon;

class CalculateDelegationAmountService
{
    const DAY_IN_SECONDS = 86400;

    public function calculateAmount(Country $country, string $dateStart, string $dateEnd)
    {
        $dateStart = Carbon::createFromFormat('Y-m-d H:i:s', $dateStart);
        $dateEnd = Carbon::createFromFormat('Y-m-d H:i:s', $dateEnd);
        $daysCount = 0;

        while($dateStart < $dateEnd) {
            $daysCount++;
            $dateStart = $dateStart->addWeekday();
        }

        $checkDateStart = $dateStart->addDay()->format('Y-m-d');
        $checkDateEnd = $dateEnd->format('Y-m-d');
        if ((self::DAY_IN_SECONDS - $dateStart->diffInSeconds($checkDateStart)) > (8*60*60)) {
            $daysCount--;
        }
        if($dateEnd->diffInSeconds($checkDateEnd) < (8*60*60)) {
            $daysCount--;
        }

        if ($daysCount > 7) {
            $daysCount = 7 + ($daysCount - 7) * 2;
        }

        return $country->daily_rate * $daysCount;
    }
}
