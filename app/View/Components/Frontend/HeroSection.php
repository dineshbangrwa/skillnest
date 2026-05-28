<?php

namespace App\View\Components\Frontend;

use App\Models\Course;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $topInstructors;

    public $totalCourses;

    public $totalStudents;

    public $totalInstructor;

    public function __construct()
    {
        $this->topInstructors = User::withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->take(5)
            ->get();
        $this->totalCourses = Course::count();
        $this->totalStudents = User::students()->count();
        $this->totalInstructor = User::instructors()->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('frontend.components.hero-section');
    }
}
