<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Course;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(20)
            ->create()
            ->each(function ($user) {
                $image = Image::factory()
                    ->user()
                    ->make();
                $user->image()->save($image);
            });

        $services = Service::factory(5)
            ->create()
            ->each(function ($service) {
                $image = Image::factory()->make();
                $service->image()->save($image);
            });

        Booking::factory(20)
            ->create()
            ->each(function ($booking) use ($services, $users) {
                $service = $services->random();
                $booking->services()->attach([
                    $service->id => ['quantity' => mt_rand(1, 3)]
                ]);
            });

        $courses = Course::factory(5)
        ->create()
        ->each(function ($course) use ($users) {
            $image = Image::factory()->make();
            $course->image()->save($image);
            $users = User::factory(5)->make();
            $course->users()->saveMany($users);
        });

        $categories = Category::factory(5)
            ->create();

        $posts = Post::factory(15)
            ->make()
            ->each(function ($post) use ($users, $categories) {
                $post->category_id = $categories->random()->id;
                $post->user_id = $users->random()->id;
                $post->save();
                $image = Image::factory()
                    ->post()
                    ->make();
                $post->image()->save($image);
            });
    }
}
