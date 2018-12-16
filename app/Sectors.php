<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Sectors extends Model
{

    /**
     * Child relationship.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany( Sectors::class, 'parent_id', 'id' );
    }

    /**
     * Parent relationship.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne( Sectors::class, 'id', 'parent_id' );
    }

    public static function getSectorOutputs(Collection $sectors, array $selected, $parentLevel = 0)
    {
        $builtSectors = collect();
        foreach ($sectors as $sector) {
            $builtSectors->push([
                'name' => $sector->name,
                'value' => $sector->value,
                'level' => $parentLevel,
                'selected' => in_array($sector->id, $selected)
            ]);

            $child = $sector->children;
            if ($child->count()) {
                $builtSectors = $builtSectors->merge(
                    self::getSectorOutputs($sector->children, $selected, $parentLevel + 1)
                );
            }
        }

        return $builtSectors;
    }
}
