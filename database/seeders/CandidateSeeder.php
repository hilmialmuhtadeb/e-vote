<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidate::create([
            'name' => 'Anies Baswedan',
            'description' => 'Anggota sejak 2011 sampai sekarang',
            'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaR27jLLj7Q8uqGepTiQ_3KYXfFCjqyTPbNg&s',
        ]);

        Candidate::create([
            'name' => 'Prabowo Subianto',
            'description' => 'Anggota sejak 2011 sampai sekarang',
            'photo' => 'https://umj.ac.id/storage/2024/10/parb.jpg',
        ]);

        Candidate::create([
            'name' => 'Ganjar Pranowo',
            'description' => 'Anggota sejak 2011 sampai sekarang',
            'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmkquAFHOxOQKHPHd53jSXDUQXjBXLMoh3LA&s',
        ]);
    }
}
