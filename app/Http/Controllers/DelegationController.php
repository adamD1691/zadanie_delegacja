<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDelegationRequest;
use App\Models\Country;
use App\Models\Delegation;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class DelegationController extends Controller
{


    public function store(CreateDelegationRequest $request)
    {
        $employee = Employee::getEmployeeByIdentifier($request->get('employee_identifier'));
        $country = Country::getCountryByCode($request->get('country'));

        Delegation::query()
            ->create([
                'employee_id' => $employee->id,
                'country_id' => $country->id,
                'date_start' => $request->get('date_start'),
                'date_end' => $request->get('date_end'),
                'currency' => $country->currency
            ]);

        return new JsonResponse(['success' => true, 'message' => 'Delegation saved.'], JsonResponse::HTTP_CREATED);
    }
}
