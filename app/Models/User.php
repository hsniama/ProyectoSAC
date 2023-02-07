<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Person;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; // agrego desde spatie

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'email_verified_at',//agrego esta
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const CONFIRMAREMAIL = ['Si', 'No'];


    public function person()
    {
        return $this->hasOne(Person::class);
    }

    // Function to know if the user has a person and a speciality
    public function hasPersonAndSpeciality()
    {
        return $this->person && $this->person->specialities->count() > 0;
    }


    // function to get the number of users
    public static function countUsers()
    {
        return User::count();
    }

    // function to get the number of users with role doctor
    public static function countDoctors()
    {
        return User::role('doctor')->count();
    }

}
