<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Models\Blog;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $activities = Activity::with('category')->get();
        $blog = Blog::with('category')->get();
        return Inertia::render('Home', [
            'activities'  => $activities,  
            'blog'  => $blog,  
            'galleryImages' => [
                [
                    'id' => 1,
                    'url' => 'storage/images/1.jpeg',
                    'alt' => 'Community Education Program',
                    'caption' => 'Community Education Program 2024',
                    'date' => 'January 15, 2024'
                ],
                [
                    'id' => 2,
                    'url' => 'storage/images/3.jpeg',
                    'alt' => 'Flood Relief Distribution',
                    'caption' => 'Flood Relief Distribution in Patuakhali',
                    'date' => 'March 22, 2024'
                ],
                [
                    'id' => 3,
                    'url' => 'storage/images/4.jpeg',
                    'alt' => 'Women Empowerment Workshop',
                    'caption' => 'Women Empowerment Workshop',
                    'date' => 'February 10, 2024'
                ],
                [
                    'id' => 4,
                    'url' => 'storage/images/5.jpeg',
                    'alt' => 'Tree Plantation Drive',
                    'caption' => 'Annual Tree Plantation Drive',
                    'date' => 'June 5, 2024'
                ],
                [
                    'id' => 5,
                    'url' => 'storage/images/6.jpeg',
                    'alt' => 'Medical Camp',
                    'caption' => 'Free Medical Camp for Rural Community',
                    'date' => 'April 18, 2024'
                ],
                
                [
                    'id' => 7,
                    'url' => 'storage/images/7.jpeg',
                    'alt' => 'Winter Clothes Distribution',
                    'caption' => 'Winter Clothes Distribution Program',
                    'date' => 'December 12, 2023'
                ],
                [
                    'id' => 8,
                    'url' => 'storage/images/8.jpeg',
                    'alt' => 'Child Education Program',
                    'caption' => 'Child Education Support Program',
                    'date' => 'November 5, 2023'
                ],
                [
                    'id' => 9,
                    'url' => 'storage/images/9.jpeg',
                    'alt' => 'Eid Celebration',
                    'caption' => 'Eid Celebration with Underprivileged Children',
                    'date' => 'July 20, 2023'
                ],
            ],
        ]);
    }
}