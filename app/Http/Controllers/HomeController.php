<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Models\Blog;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $activities = Activity::with('category')->get();
        $blog = Blog::with('category')->get();
        
         $media = Gallery::with('category')
            ->latest()
            ->paginate(6); // Adjust pagination as needed

        // Add additional data to each media item
        $media->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'filename' => $item->filename,
                'original_name' => $item->original_name,
                'path' => $item->path,
                'caption' => $item->caption,
                'url' => Storage::url($item->path),
                'thumbnail_url' => Storage::url($item->path), // You can create thumbnails later
                'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $item->updated_at->format('Y-m-d H:i:s'),
               
        
            ];
        });

        return Inertia::render('Home', [
            'activities'  => $activities,  
            'blog'  => $blog,  
            'media' => $media,
            
        ]);
    }
}