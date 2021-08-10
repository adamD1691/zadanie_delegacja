<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function delegations() : HasMany
    {
        return $this->hasMany(Delegation::class);
    }

    public static function getEmployeeByIdentifier(string $identifier)
    {
        return self::query()
            ->firstWhere('identifier', '=', $identifier);
    }
}
