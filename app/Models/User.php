<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'lecturer_id');
    }

    public function groups()
    {
        return $this->hasMany(GroupMembers::class, 'student_id');
    }

    public function projectRegistrations()
    {
        return $this->hasMany(ProjectRegistration::class, 'student_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'student_id');
    }

    public function peersAssessments()
    {
        return $this->hasMany(PeersAssessment::class, 'student_id');
    }

    public function studentMarks()
    {
        return $this->hasMany(StudentMark::class, 'student_id');
    }
}
