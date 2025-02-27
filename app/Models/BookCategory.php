<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'type', // 'expense' oder 'income'
        'description',
    ];

    /**
     * Get the expenses for the category.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}