<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Communes extends Model
{

    protected $table = 'communes';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_com';

    protected $fillable = [
        'description',
        'trash',
        'id_reg'
    ];

    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function regions(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'id_reg', 'id_reg');
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'id_com', 'id_com');
    }
}
