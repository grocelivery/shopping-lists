<?php

declare(strict_types=1);

namespace Grocelivery\AdsCatalog\Models;

use Grocelivery\Utils\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Product
 * @package Grocelivery\AdsCatalog\Models
 * @property string $id
 * @property string $shopping_list_id
 * @property string $name
 * @property string $description
 * @property float $max_price
 */
class Product extends Model
{
    use UsesUuid;

    protected $fillable = ['name', 'description', 'max_price'];

    /**
     * @return BelongsTo
     */
    public function shoppingList(): BelongsTo
    {
        return $this->belongsTo(ShoppingList::class);
    }
}