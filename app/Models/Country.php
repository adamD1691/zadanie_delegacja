<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function delegations() : HasMany
    {
        return $this->hasMany(Delegation::class);
    }

    public static function getCountryByCode(string $code)
    {
        return self::query()
            ->firstWhere('code', '=', $code);
    }
}
