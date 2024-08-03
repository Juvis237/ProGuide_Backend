<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'first_name',
        'last_name',
        'status',
        'school',
        'faculty',
        'department',
        'level',
        'matricule',
        'role',
        'email',
        'phone',
        'password',
        'referal_code',
        'refered_by',
        'profile',
        'referal_paid',
        'bio'
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

    public function getNameAttribute(){
        if(isset($this->first_name) || isset($this->last_name)){
            return $this->first_name.' '.$this->last_name;
        }
        return $this->user_name;
    }
    public function referer(){
        return $this->belongsTo(User::class, 'refered_by');
    }

    public function requests(){
        return $this->hasMany(Request::class, 'user_id');
    }

    public function city(){
        return $this->belongsTo(Cities::class , "city_id");
    }

    public function region(){
        return $this->belongsTo(Regions::class , "region_id");
    }


    public function isAdmin(){
        return $this->role === 'admin';
    }
    public function isAgent(){
        return $this->role === 'agent';
    }


    public function getProfilePictureAttribute(){
        return asset('storage/'.$this->profile);
    }

    public function wallet(){
        return Wallet::where('user_id', $this->id)->first();
    }


}
