<?php

namespace App\Http\Controllers\Frontend\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CourseService;

class AllCategoryController extends Controller
{
    public function __construct(protected readonly CourseService $courseService) {}

    public function category()
    {

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->where('status', 1)
            ->get();

        return view('frontend.pages.course.all-category', compact('categories'));
    }
}
