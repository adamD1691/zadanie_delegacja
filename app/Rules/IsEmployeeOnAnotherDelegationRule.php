<?php

namespace App\Rules;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class IsEmployeeOnAnotherDelegationRule implements Rule
{
    private $dateStart;
    private $dateEnd;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $dateRange)
    {
        $this->dateStart = Carbon::createFromFormat('Y-m-d H:i:s', Arr::get($dateRange, 'date_start', '1970-01-01 00:00:00'));
        $this->dateEnd = Carbon::createFromFormat('Y-m-d H:i:s', Arr::get($dateRange, 'date_end', '1970-01-01 00:00:00'));
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $employee = Employee::getEmployeeByIdentifier($value);
        if (is_null($employee)) {
            return false;
        }
        $employeeDelegations = $employee->delegations()->get();

        if ($employeeDelegations->isEmpty()) {
            return true;
        }

        foreach ($employeeDelegations as $delegation) {
            if ($this->dateStart->between($delegation->date_start, $delegation->date_end) || $this->dateEnd->between($delegation->date_start, $delegation->date_end)){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Employee can be on one delegation.';
    }
}
