<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User; // Bawer be ku User model hatiye importkirin
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});




Broadcast::channel('doctor.{doctorId}', fn ($user, $doctorId) => (int)$user->id === (int)$doctorId);


Broadcast::channel('doctor.{doctorId}', function (User $user, int $doctorId) {
    // Piştrastkirina ku bikarhênerê login-kirî dektor e Û ID ya wî rast e
    return $user->role === 'doctor' && $user->id === $doctorId;
});