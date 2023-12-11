<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{
    use HasFactory;

	public $table = 'entries';

    protected $fillable = [
        'month',
        'year',
		'label',
		'value', // money amount
		'type', // income = 0 or outcome = 1

    ];
}
