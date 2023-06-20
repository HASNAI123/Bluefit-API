<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'ic_number' => 'required|unique:users',
            'dob' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'ic_number' => $request->ic_number,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
        ]);

        // Generate token for the registered user
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    public function createExampleUsers()
    {
        // Example user data
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'ic_number' => '123456789',
                'dob' => '1990-01-01',
                'password' => 'password123',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'ic_number' => '987654321',
                'dob' => '1995-05-10',
                'password' => 'password456',
            ],
            // Add more example users as needed
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'ic_number' => $userData['ic_number'],
                'dob' => $userData['dob'],
                'password' => Hash::make($userData['password']),
            ]);
        }

        return response()->json(['message' => 'Example users created'], 201);
    }
}
