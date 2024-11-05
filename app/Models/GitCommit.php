<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GitCommit extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch',
        'safdarCoded',
        'gitCode',
        'commitMessage',
    ];


}


