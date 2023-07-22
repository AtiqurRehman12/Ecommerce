<?php

namespace Modules\Type\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'category';
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Type\database\factories\TypeFactory::new();
    }
}
