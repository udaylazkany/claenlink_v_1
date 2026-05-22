<?php
namespace App\Services;
 
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $users;

    public function __construct(UserRepositoryInterface $users) 
    {
        $this->users = $users;
    }

    public function login(array $data)
    {
        $user = $this->users->findByEmail($data['email']);

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw new \Exception('بيانات الدخول غير صحيحة');
        }

        return [
            'token' => $user->createToken('login')->plainTextToken,
            'user'  => $user
        ];
    }
}
