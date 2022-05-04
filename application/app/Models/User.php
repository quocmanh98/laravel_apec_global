<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Support\Traits\HasUserPermissions;
use App\Support\Traits\HasUserRole;
use App\Support\Traits\UuidTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasUserRole, HasUserPermissions, UuidTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'id', 'name', 'email', 'password', 'username', 'email_verified_at',
    //     'first_name', 'last_name', 'phone', 'address', 'birthday',
    //     'avatar', 'status', 'country', 'last_activity', 'role_id'
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email','password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'last_login_at' => 'datetime'
    ];

    /**
     * Get user by email
     *
     * @param string $email
     */
    public function findByEmail($email)
    {
        return self::where('email', $email)->first();
    }

    /**
     * Get user by username
     *
     * @param string $username
     * @return
     */
    public function findByUsername($username)
    {
        return self::where('username', $username)->first();
    }

    /**
     * overwrite create metahod
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public static function create(array $attributes = [])
    {
        if(isset($attributes['role_id']) == false ){
            $role = Role::findByName('users');
            $attributes['role_id'] = $role->id;
        }

        if(option('auth_verifyEmail') == true && isset($attributes['email_verified_at']) == false ){
            $attributes['email_verified_at'] = (string)now();
        }

        return (new static)->newQuery()->create($attributes);
    }

    /**
     * Get chartjs
     *
     * @return array
     */
    public static function countOfNewUsersPerMonth(Carbon $from, Carbon $to)
    {
        $result = self::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($user) {
                return $user->created_at->format("Y_n");
            });

        $counts = [];

        while ($from->lt($to)) {
            list($year, $month) = explode("_", $from->format("Y_M"));
            $counts["{$month} {$year}"] = count($result->get($from->format("Y_n"), []));
            $from->addMonth();
        }
        return $counts;
    }

    /**
     * Accessor fullname of user
     */
    public function getFullName()
    {
        if($this->first_name && $this->last_name){
            return "{$this->first_name} {$this->last_name}";
        }

        if($this->username){
            return $this->username;
        }

        return $this->email;
    }

    /**
     * Accessor for Age.
     */
    public function getAge()
    {
        return Carbon::parse($this->birthday)->age;
    }

}
