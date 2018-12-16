<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Nexmo\Call\Collection;

class Visitor extends Model
{
    protected $fillable = [
        'name',
        'agreed_terms'
    ];

    public function build(array $data)
    {
        $this->name = $data['name'];
        $this->agreed_terms = true;
    }

    public function syncSectors(array $sectors)
    {
        $this->sectors()->detach();
        $this->sectors()->attach($sectors);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sectors()
    {
        return $this->belongsToMany(
            Sectors::class,
            'visitor_sectors',
            'visitor_id',
            'sector_id');
    }
}
