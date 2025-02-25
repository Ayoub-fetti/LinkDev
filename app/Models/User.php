<?php

namespace App\Models;
use App\Models\Posts;
use App\Models\Skills;
use App\Models\Comments;
use App\Models\Likes;
use App\Models\Notifications;
use App\Models\Shares;
use App\Models\Job_offers;
use App\Models\Hashtags;
use App\Models\Connections;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'cover',
        'bio',
        'website',
        'github_url',   
        'linkedin_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function posts()
    {
        return $this->hasMany(Posts::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skills::class,'skills_user','user_id','skill_id');
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
    public function project()
    {
        return $this->hasMany(Project::class);
    
    }
    public function notifications()
    {
        return $this->hasMany(Notifications::class);
    
    }
    public function shares()
    {
        return $this->hasMany(Shares::class);
    
    }
    public function job_offers()
    {
        return $this->hasMany(Job_offers::class);
    
    }
    public function hashtags()
    {
        return $this->hasMany(Hashtags::class);
    
    }
    public function connections()
    {
        return $this->hasMany(Connections::class);
    
    }
    
   
}
