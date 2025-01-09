<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Faqat quyidagi maydonlar to'ldirilishi mumkin
    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'file_path','payment','organization', 'payment_month',];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


}
