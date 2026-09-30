<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['brand', 'model', 'color', 'speed_rating'])]
class Car extends Model
{
    /**
     * Users currently driving this car.
     *
     * @return HasMany<User, Car>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * "Toyota Supra" style display name.
     */
    public function name(): string
    {
        return "{$this->brand} {$this->model}";
    }
}
