<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','sex','phone','address','state','avatar_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    /**
//     * 审查人员审查的文章
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function verifierArticle()
//    {
//        return $this->hasMany(Article::class,"verifier_id");
//    }

    public function getSexAttribute($sex){

        return $sex == 1 ? '男' : '女';
    }

    public function getStateAttribute($state){
        return $state == 1 ? '有效' : '停用';
    }

    public function getAvatarIdAttribute($avatarId){
        if(!$avatarId){
            return null;
        }
        return Resource::find($avatarId)->path;
    }
}
