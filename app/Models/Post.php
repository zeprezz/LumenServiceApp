<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Post -> table_name = posts
    // custom table name
    // protected $table = 'table_name';

    // define column name
    protected $fillable = array('title', 'content', 'status', 'user_id');

    public $timestamps = true;
}