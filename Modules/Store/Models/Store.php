<?php

namespace Modules\Store\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'store';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Store\database\factories\StoreFactory::new();
    }
}
