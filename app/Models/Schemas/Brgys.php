<?php

namespace App\Models\Schemas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brgys extends Model
{
    use HasFactory;

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public static function getByCity(int $city_id)
    {
        return self::where("city_id", $city_id)->get();
    }
}
