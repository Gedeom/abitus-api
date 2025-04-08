<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Base\BaseRepository;

class AuthRepository extends BaseRepository
{
    protected $entity = User::class;

    public function getByEmail(string $email): ?User
    {
        return $this->entity::where("email", $email)->first();
    }

    public function createToken(object $user): string
    {
        return $user->createToken('api_token', ['*'], now()->addMinutes(5))->plainTextToken;
    }

    public function refreshToken(int $userId): string
    {
        $this->deleteTokens($userId);
        return $this->createToken($this->entity::find($userId));
    }

    public function deleteTokens(string $userId): bool
    {
        return $this->entity::find($userId)->tokens()->delete();
    }
}
