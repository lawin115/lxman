<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

// Ev ji bo têkiliya bi transactions re ye
public function transactions()
{
    return $this->hasMany(Transaction::class, 'patient_id');
}

// Ev ji bo têkiliya bi appointments (mesrefan) re ye
public function treatmentsAsPatient()
{
    return $this->hasMany(Appointment::class, 'patient_id');
}

// Ev fonksiyona herî girîng e: Hesabkirina deynî
public function getDebtAttribute(): float
{
    // 1. Hemû mesrefên wî kom bike
    $totalCost = $this->treatmentsAsPatient()->sum('total_cost');

    // 2. Hemû peredayînên wî kom bike
    $totalPaid = $this->transactions()->sum('amount');
    
    return $totalCost - $totalPaid;
}
    // Peywendiya dektorî bi mew'idan re
public function doctorAppointments()
{
    return $this->hasMany(Appointment::class, 'doctor_id');
}

// Peywendiya nexweşî bi mew'idan re
public function patientAppointments()
{
    return $this->hasMany(Appointment::class, 'patient_id');
}
}
