<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

//Se agrega SPATIE y la fachada
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_division',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public  function adminlte_image(){
        //Nos reegresa la imagen que pongamos en Jetstream
        return asset('storage/'.$this->profile_photo_path);
    }

    public function adminlte_desc()
    {
        if (auth()->check()) {
            // Si el usuario está autenticado, obtenemos su rol actual
            return $this->getRoleNames()->first();
        }

        // Si el usuario no está autenticado, retornamos null o algún valor por defecto
        return null;
    }

    public function adminlte_profile_url()
    {
        //Nos lleva a la vista ditar usuario
        return 'user/profile';
    }


    public function division(){
        return $this->belongsTo(Division::class, 'id_division');
    }

    public function jurado(){
        return $this->hasOne(Jurado::class, 'id');
        //un usuario tiene un jurado
    }
}
