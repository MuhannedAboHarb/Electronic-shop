<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use HasFactory;

    /**
     * set the table primary key name (column)
     * @var string
     */
    protected $primaryKey = 'user_id' ;

    protected $fillable = [
        'user_id' , 'first_name' , 'last_name' , 'gender' , 'birthday' , 
        'address' , 'city' ,'country_code' , 'locale' ,'timezone'
    ];
    /**
     * Inverse One-To-One Realationship : Profile belongs to one user
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
