<?php

namespace App\Models\Schemas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;

    public function brgys(): BelongsTo
    {
        return $this->belongsTo(Brgys::class);
    }

    public static function coronaVirusReport(int $brgys_id)
    {
        return self::where('brgys_id', $brgys_id)->selectRaw("
                COUNT(*) AS total,
                COUNT(CASE WHEN coronavirus_status = 'recovered' THEN 1 END) AS recovered,
                COUNT(CASE WHEN coronavirus_status = 'active' THEN 1 END) AS active,
                COUNT(CASE WHEN coronavirus_status = 'death' THEN 1 END) AS death
        ")->get()->first();
    }
   
    
    public static function awarenessReport(int $brgys_id)
    {
        return self::where('brgys_id', $brgys_id)->selectRaw("
                COUNT(CASE WHEN case_type = 'PUI' THEN 1 END) AS PUI,
                COUNT(CASE WHEN case_type = 'PUM' THEN 1 END) AS PUM,
                COUNT(CASE WHEN case_type = 'Positive on Covid' THEN 1 END) AS 'Positive on Covid',
                COUNT(CASE WHEN case_type = 'Negative on Covid' THEN 1 END) AS 'Negative on Covid'
        ")->get()->first();
    }




}
