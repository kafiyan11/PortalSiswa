<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        SocialLink::create([
            'twitter' => 'https://x.com/smkn1kawali',
            'facebook' => 'https://www.facebook.com/smkn1kawali',
            'instagram' => 'https://www.instagram.com/smkn1kawali/',
            'youtube' => 'https://www.youtube.com/channel/UC9-U_yQ5zqWvLxFHv7ZK0XQ',
        ]);
    }
}
