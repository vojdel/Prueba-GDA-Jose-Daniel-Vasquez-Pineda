<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'dni';

    protected $fillable = [
        'email',
        'name',
        'last_name',
        'address',
        'date_reg',
        'trash',
        'id_reg',
        'id_com',
    ];

    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function communes(): BelongsTo
    {
        return $this->belongsTo(Communes::class, 'id_com', 'id_com');
    }

    public function regions(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'id_reg', 'id_reg');
    }
}
