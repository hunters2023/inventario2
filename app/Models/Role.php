<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\PermissionRegistrar as shield;

class Role extends shield
{
    use HasFactory;
}
