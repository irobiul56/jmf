<?php
// app/Http/Controllers/GalleryController.php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Gallery::with('category')
            ->latest()
            ->paginate(24); // Adjust pagination as needed

        // Add additional data to each media item
        $media->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'filename' => $item->filename,
                'original_name' => $item->original_name,
                'path' => $item->path,
                'caption' => $item->caption,
                'category_id' => $item->category_id,
                'category' => $item->category,
                'url' => Storage::url($item->path),
                'thumbnail_url' => Storage::url($item->path), // You can create thumbnails later
                'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $item->updated_at->format('Y-m-d H:i:s'),
               
        
            ];
        });

        $categories = Category::all();

        return Inertia::render('Dashboard/Gallery/Index', [
            'media' => $media,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $filename = Str::random(20) . '.' . $extension;
                
                // Store in storage/app/public/gallery
                $path = $image->storeAs('gallery', $filename, 'public');

                $gallery = Gallery::create([
                    'category_id' => $request->category_id,
                    'filename' => $filename,
                    'original_name' => $originalName,
                    'path' => $path,
                    'caption' => pathinfo($originalName, PATHINFO_FILENAME),
                ]);

                $uploadedImages[] = $gallery;
            }
        }

        return redirect()->back()->with('message', count($uploadedImages) . ' images uploaded successfully!');
    }

     /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255'
        ]);

        $gallery = Gallery::findOrFail($id);
        
        $gallery->update([
            'caption' => $request->caption
        ]);

        return redirect()->back()->with('success', 'Caption updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $gallery = Gallery::findOrFail($id);
        
        // Delete associated image
        if ($gallery->path) {
            Storage::disk('public')->delete($gallery->path);
        }
        

        $gallery->delete();

        return redirect()->back()->with('message', 'Image deleted successfully!');
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}