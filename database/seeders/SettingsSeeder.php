<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::insert([
            [
                'key' => 'Site Name',
                'slug' => 'site_name',
                'value' => 'Eraz NewMag',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Website URL',
                'slug' => 'website_url',
                'value' => 'https://eraz.newmag.am/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Admin email',
                'slug' => 'admin_email',
                'value' => 'gohar.manukyan@newmag.am',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Public Email',
                'slug' => 'public_email',
                'value' => 'gohar.manukyan@newmag.am',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'FB link',
                'slug' => 'fb_link',
                'value' => 'facebook.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Twitter link',
                'slug' => 'twitter_link',
                'value' => 'twitter.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Instagram link',
                'slug' => 'instagram_link',
                'value' => 'instagram.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Linkedin link',
                'slug' => 'linkedin_link',
                'value' => 'linkedin.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Youtube link',
                'slug' => 'youtube_link',
                'value' => 'youtube.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Order email addresses',
                'slug' => 'order_email_addresses',
                'value' => 'youtube.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'Address',
                'slug' => 'address',
                'value' => 'Արշակունյանծ 4, Երևան 0023, ՀՀ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


    }
}
