<?php

namespace App\Observers;

use App\Models\Delegation;
use App\Services\CalculateDelegationAmountService;

class DelegationObserver
{
    private $calculateAmountService;

    public function __construct()
    {
        $this->calculateAmountService = new CalculateDelegationAmountService();
    }

    public function creating(Delegation $delegation)
    {
        $amount = $this->calculateAmountService->calculateAmount($delegation->country, $delegation->date_start, $delegation->date_end);
        $delegation->amount_due = $amount;
    }
}
