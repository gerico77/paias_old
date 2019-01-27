<?php

use Illuminate\Database\Seeder;
use App\Course;

class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Course::class, 6)->create()->each(function ($course) {
            $course->professors()->sync([1]);
            $course->lessons()->saveMany(factory(Lesson::class, 10)->create());
        });
    }
}
