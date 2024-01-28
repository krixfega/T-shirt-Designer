<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TShirtDesign extends Model
{
    use HasFactory;

    protected $fillable = ['design', 'image_path', 'generated_code'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_shirt_designs'; 

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Adjust the primary key if needed

    /**
     * 
     *
     * @var bool
     */
    public $timestamps = true; // Set to false if you don't want timestamps



}
