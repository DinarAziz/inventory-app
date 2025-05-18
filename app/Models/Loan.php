<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'borrow_date',
        'due_date',
        'return_date',
        'quantity',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected static function booted()
    {
        static::saving(function ($loan) {
            $item = $loan->item;

            if ($loan->status === 'approved') {
                if ($item->stock < $loan->quantity) {
                    throw new \Exception('Stok tidak mencukupi!');
                }

                if ($loan->isDirty('status') && $loan->getOriginal('status') !== 'approved') {
                    $item->stock -= $loan->quantity;
                    $item->save();
                }
            }

            if ($loan->isDirty('status') && $loan->status === 'returned' && $loan->getOriginal('status') !== 'returned') {
                $item->stock += $loan->quantity;
                $item->save();
            }
        });
    }
}
