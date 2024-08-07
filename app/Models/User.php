<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
<<<<<<< HEAD
=======
use App\Service\ImgurHelpers;
use Carbon\Carbon;
>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
<<<<<<< HEAD

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
=======
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, ImgurHelpers;
>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
<<<<<<< HEAD
        'name',
        'email',
        'password',
=======
        'email',
        'password',
        'firstname',
        'lastname',
        'name',
        'dial_code',
        'phone_number',
        'profession',
        'photo_url',
        'is_active',
        'is_professional',
        'email',
        'birthday',
        'email_verified_at',
        'password',
        "user_types_id"
>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f
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

<<<<<<< HEAD
=======
    // protected $appends = ['type'];

>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
<<<<<<< HEAD
=======

    public static array $rules = [
        'email' => ["required", "unique:users"],
        'firstname' => "required",
        'lastname' => "required",
        'dial_code' => "required",
        'phone_number' => "required",
        'profession_id' => "nullable",
        'photo_url' => "nullable",
        // 'is_active' => "required",
        // 'user_types_id' => "required",
        'password' => "required"
        // 'is_professional' => "required",
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the userType that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_types_id');
    }

    /**
     * Get all of the salons for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salons()
    {
        return $this->hasMany(Salon::class);
    }

    /**
     * Get the artist associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function artist()
    {
        return $this->hasOne(Artist::class);
    }

    public function getAppointementsAttribute()
    {
        $all = [];
        $appointments = Appointement::where('creator_id', $this->id)
            ->orWhere('user_id', $this->id)
            ->get();

        foreach ($appointments as $appointment) {
            if (!Carbon::parse($appointment->hour)->isPast()) {
                array_push($all, $appointment);
            }
        }

        return $all;
    }

    /**
     * Get all of the cartes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartes()
    {
        return $this->hasMany(Carte::class);
    }

    // public function getInfosAttribute(){
    //     return $this->userType;
    // }

    // public function getTypeAttribute()
    // {
    //     return $this->userType;
    // }
>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f
}
