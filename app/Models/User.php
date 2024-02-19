<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'password',
        'address',
        'country',
        'state',
        'city',
        'zip',
        'how_do_you_know_about_garcia',
        'terms_and_condition'
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
        'password' => 'hashed',
    ];

    public function insert($userData){

        $this->name = $userData['name'];
        $this->email = $userData['email'];
        $this->phone = $userData['phone'];
        $this->date_of_birth = $userData['date_of_birth'];
        $this->password = $userData['password'];
        $this->address = $userData['address'];
        $this->country = $userData['country'];
        $this->state = $userData['state'];
        $this->city = $userData['city'];
        $this->zip = $userData['zip'];
        $this->how_do_you_know_about_garcia = $userData['how_do_you_know_about_garcia'];
        $this->terms_and_condition = $userData['terms_and_condition'];

        $this->save();
    }

    public function getUser(){
        return User::all();
    }

    public function updateUserOrder($userId,$coursePurchased){
        return $this->where("id",$userId)->update(["is_course_purchased",$coursePurchased]);
    }
}
