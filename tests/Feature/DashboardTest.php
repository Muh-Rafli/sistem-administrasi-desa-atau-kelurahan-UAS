<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('unauthenticated users are redirected to login', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect(route('login'));
});

test('authenticated users can access the dashboard and see metrics', function () {
    $user = User::where('role', 'Admin')->first();

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);

    // Verify statistics passed to the view
    $response->assertViewHas('totalUsers');
    $response->assertViewHas('totalPenduduk');
    $response->assertViewHas('totalKK');
    $response->assertViewHas('suratPendingCount');
    $response->assertViewHas('pendudukLaki');
    $response->assertViewHas('pendudukPerempuan');
    $response->assertViewHas('pendidikanDistribution');
    $response->assertViewHas('pekerjaanDistribution');
    $response->assertViewHas('suratStatusCounts');

    // Assert actual values from the seeders
    $response->assertViewHas('totalUsers', 4);
    $response->assertViewHas('totalKK', 15);
});
