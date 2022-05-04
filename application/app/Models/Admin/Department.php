<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'departments';
    protected $guarded = [];
    // protected $fillable = [
    //     'id', '	departments_code', 'departments_name','created_at'
    // ];
}
