<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

    it('Can be created with a mass-assignment', function () {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'github_id' => '1234',
            'github_token' => 'gh-token',
            'commiter_name' => 'John',
            'repository_name' => 'appunti',
            'commit_message' => 'Initial commit'
        ];

        $user = User::create($data);

        foreach ($data as $key => $value) {
            if ($key !== 'password') { // Il password sarà hashed
                expect($user->{$key})->toBe($value);
            }
        }
    });

    it('Hides protected attributes when transformed to array', function () {
        $user = User::factory()->create();

        $userArray = $user->toArray();

        expect(array_key_exists('password', $userArray))->toBeFalse();
        expect(array_key_exists('remember_token', $userArray))->toBeFalse();
    });

    it('Hashes the password when setting', function () {
        $user = new User();
        $user->password = 'my-plain-password';

        expect(password_verify('my-plain-password', $user->password))->toBeTrue();
    });


