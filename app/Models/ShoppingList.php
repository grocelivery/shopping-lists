<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Grocelivery\Utils\Traits\UsesUuid;

/**
 * Class ShoppingList
 * @package Grocelivery\ShoppingLists\Models
 * @property string $id
 * @property string $customer_id
 * @property string $contractor_id
 * @property string $name
 * @property string $description
 * @property Carbon $end_date
 * @property string $location_id
 * @property boolean $is_archived;
 */
class ShoppingList extends Model
{
    use UsesUuid;

    protected $fillable = ['name', 'description', 'customer_id', 'contractor_id', 'end_date', 'location_id'];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}