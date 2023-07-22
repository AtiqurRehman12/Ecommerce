<?php

namespace Modules\Slide\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'slides';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Slide\database\factories\SlideFactory::new();
    }
}
