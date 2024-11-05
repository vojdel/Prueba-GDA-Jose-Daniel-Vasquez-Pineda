<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    protected $table = 'regions';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_reg';

    protected $fillable = [
        'description',
        'trash',
    ];
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function communes(): HasMany
    {
        return $this->hasMany(Communes::class, 'id_reg', 'id_reg');
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'id_reg', 'id_reg');
    }
}
