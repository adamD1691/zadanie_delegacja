<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;


class EmployeeController extends Controller
{


    public function store()
    {
        $employee = Employee::factory()->make();
        $employee->save();

        return new JsonResponse(['employee_identifier' => $employee->identifier], JsonResponse::HTTP_CREATED);
    }

    public function getDelegations(string $identifier)
    {
        $employee = Employee::getEmployeeByIdentifier($identifier);
        if (is_null($employee)) {
            return new JsonResponse(['message' => 'Bad employee identifier.'], JsonResponse::HTTP_BAD_REQUEST);
        }
        $delegations = [];

        foreach ($employee->delegations as $delegation) {
            $delegations [] = [
                'start' => $delegation->date_start,
                'end' => $delegation->date_end,
                'country' => $delegation->country->code,
                'amount_due' => $delegation->amount_due,
                'currency' => $delegation->currency
            ];
        }
        return new JsonResponse($delegations, JsonResponse::HTTP_OK);
    }
}
