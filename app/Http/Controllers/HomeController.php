<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'activities' => [
                [
                    'id' => 1,
                    'title' => 'আস-সুন্নাহ স্কিল ডেভেলপমেন্ট ইনস্টিটিউট',
                    'description' => 'জাতীয় দক্ষতা উন্নয়ন কর্তৃপক্ষ কর্তৃক নিবন্ধিত একটি আত্ম-উন্নয়ন ও দক্ষতা বৃদ্ধিমূলক প্রতিষ্ঠান।',
                    'image' => 'storage/images/1.jpeg',
                    'tag' => 'Regular Projects',
                    'link' => '/activities/skill-development'
                ],
                [
                    'id' => 2,
                    'title' => 'দুর্যোগে ত্রাণ ও পুনর্বাসন',
                    'description' => 'বন্যা, ঘূর্ণিঝড়, অগ্নিকাণ্ড—প্রতিটি দুর্যোগে অসহায় মানুষের পাশে আছে আস-সুন্নাহ ফাউন্ডেশন।',
                    'image' => 'storage/images/3.jpeg',
                    'tag' => 'Emergency Projects',
                    'link' => '/activities/relief-rehabilitation'
                ],
                [
                    'id' => 3,
                    'title' => 'দক্ষতাভিত্তিক উদ্যোক্তা তৈরি',
                    'description' => 'দক্ষতা থাকা সত্ত্বেও শুধু পুঁজির অভাবে যারা উদ্যোগ নিতে পারছেন না, তাদের পাশে দাঁড়ানোর একটি মানবিক প্রয়াস।',
                    'image' => 'storage/images/4.jpeg',
                    'tag' => 'Empowerment Projects',
                    'link' => '/activities/entrepreneurship'
                ],
                [
                    'id' => 4,
                    'title' => 'মাদ্রাসা শিক্ষা কার্যক্রম',
                    'description' => 'ধর্মীয় ও সাধারণ শিক্ষার সমন্বয়ে একটি আদর্শ শিক্ষা ব্যবস্থা গড়ে তোলার লক্ষ্যে কাজ করছে আমাদের মাদ্রাসা।',
                    'image' => 'storage/images/5.jpeg',
                    'tag' => 'Education Projects',
                    'link' => '/activities/madrasa-education'
                ],
                [
                    'id' => 5,
                    'title' => 'স্বাস্থ্য সেবা কার্যক্রম',
                    'description' => 'মেডিকেল ক্যাম্প, বিনামূল্যে চিকিৎসা সেবা ও ওষুধ বিতরণের মাধ্যমে সমাজের দরিদ্র মানুষের পাশে দাঁড়ানো।',
                    'image' => 'storage/images/6.jpeg',
                    'tag' => 'Healthcare Projects',
                    'link' => '/activities/healthcare'
                ],
                [
                    'id' => 6,
                    'title' => 'পরিবেশ সংরক্ষণ',
                    'description' => 'গাছ লাগানো, প্লাস্টিক দূষণ রোধ এবং পরিবেশবান্ধব কার্যক্রমের মাধ্যমে একটি সবুজ পৃথিবী গড়ার লক্ষ্যে কাজ করা।',
                    'image' => 'storage/images/7.jpeg',
                    'tag' => 'Environment Projects',
                    'link' => '/activities/environment'
                ]
            ],
            'blogPosts' => [
                [
                    'id' => 1,
                    'title' => 'মাসব্যাপী দাওয়াহ প্রশিক্ষণ-২০২৫ সম্পন্ন',
                    'excerpt' => 'সম্পন্ন হয়েছে আস-সুন্নাহ দাওয়াহ অ্যান্ড রিসার্চ ইনস্টিটিউটের অধীনে পরিচালিত দাওয়াহ প্রশিক্ষণ-২০২৫। মাসব্যাপী এই প্রশিক্ষণ কর্মশালা...',
                    'content' => 'Full content here...',
                    'slug' => 'dawah-training-2025-completed',
                    'featured_image' => '/images/blog/dawah-training.jpg',
                    'category' => 'Activities',
                    'published_at' => '2024-10-19',
                    'read_time' => '5 min read',
                    'views' => 1247,
                    'comments_count' => 23,
                    'author' => [
                        'name' => 'ড. মোঃ আব্দুল্লাহ',
                        'avatar' => '/images/authors/author1.jpg'
                    ]
                ],
                [
                    'id' => 2,
                    'title' => '১০৯ এতিমসহ ৩০০ শহীদ পরিবারের পাশে আস-সুন্নাহ ফাউন্ডেশন',
                    'excerpt' => 'বৈষম্য বিরোধী ছাত্র আন্দোলেন শহীদ হওয়া ৩০০ পরিবারকে ১ লক্ষ করে টাকা সহায়তা করল আস-সুন্নাহ ফাউন্ডেশন। এর মধ্যে ১০৯ জন এতিমও রয়েছেন।',
                    'content' => 'Full content here...',
                    'slug' => 'support-for-martyrs-families',
                    'featured_image' => '/images/blog/martyrs-support.jpg',
                    'category' => 'News',
                    'published_at' => '2024-10-18',
                    'read_time' => '4 min read',
                    'views' => 892,
                    'comments_count' => 15,
                    'author' => [
                        'name' => 'প্রফেসর আহমেদ হাসান',
                        'avatar' => '/images/authors/author2.jpg'
                    ]
                ],
                [
                    'id' => 3,
                    'title' => 'কুরআন প্রতিযোগিতার ২য় ও ৩য় ধাপের পুরস্কার বিতরণ',
                    'excerpt' => 'বিজয়ীদের আনন্দঘন উপস্থিতিতে সম্পন্ন হয়েছে কুরআন পাঠ ও প্রতিযোগিতার দ্বিতীয় ও তৃতীয় ধাপের পুরস্কার বিতরণী অনুষ্ঠান।',
                    'content' => 'Full content here...',
                    'slug' => 'quran-competition-prize-distribution',
                    'featured_image' => '/images/blog/quran-competition.jpg',
                    'category' => 'Events',
                    'published_at' => '2024-10-15',
                    'read_time' => '3 min read',
                    'views' => 567,
                    'comments_count' => 8,
                    'author' => [
                        'name' => 'মুফতি ইব্রাহিম আলী',
                        'avatar' => '/images/authors/author3.jpg'
                    ]
                ],
                [
                    'id' => 4,
                    'title' => 'গ্রামীণ মহিলাদের জন্য নতুন কারিগরি প্রশিক্ষণ কেন্দ্র উদ্বোধন',
                    'excerpt' => 'পটুয়াখালীর প্রত্যন্ত অঞ্চলের মহিলাদের জন্য একটি আধুনিক কারিগরি প্রশিক্ষণ কেন্দ্রের আনুষ্ঠানিক উদ্বোধন সম্পন্ন হয়েছে।',
                    'content' => 'Full content here...',
                    'slug' => 'technical-training-center-inauguration',
                    'featured_image' => '/images/blog/training-center.jpg',
                    'category' => 'Updates',
                    'published_at' => '2024-10-12',
                    'read_time' => '6 min read',
                    'views' => 723,
                    'comments_count' => 12,
                    'author' => [
                        'name' => 'ড. ফাতেমা বেগম',
                        'avatar' => '/images/authors/author4.jpg'
                    ]
                ],
                [
                    'id' => 5,
                    'title' => 'বন্যা কবলিত এলাকায় ত্রাণ কার্যক্রমের বিশেষ প্রতিবেদন',
                    'excerpt' => 'গত মাসের বন্যায় ক্ষতিগ্রস্ত পরিবারগুলোর মধ্যে আমাদের ত্রাণ বিতরণ কার্যক্রমের বিশেষ প্রতিবেদন এবং ভবিষ্যৎ পরিকল্পনা।',
                    'content' => 'Full content here...',
                    'slug' => 'flood-relief-special-report',
                    'featured_image' => '/images/blog/flood-relief.jpg',
                    'category' => 'Stories',
                    'published_at' => '2024-10-08',
                    'read_time' => '7 min read',
                    'views' => 945,
                    'comments_count' => 18,
                    'author' => [
                        'name' => 'শামীম আহমেদ',
                        'avatar' => '/images/authors/author5.jpg'
                    ]
                ],
                [
                    'id' => 6,
                    'title' => 'শিশু শিক্ষা কার্যক্রমের নতুন পর্যায়ের সূচনা',
                    'excerpt' => 'আমাদের শিশু শিক্ষা উন্নয়ন প্রোগ্রামের নতুন পর্যায় শুরু হয়েছে, যেখানে আরও ৫০০ শিশুকে বিনামূল্যে শিক্ষা সহায়তা প্রদান করা হবে।',
                    'content' => 'Full content here...',
                    'slug' => 'child-education-new-phase',
                    'featured_image' => '/images/blog/child-education.jpg',
                    'category' => 'Activities',
                    'published_at' => '2024-10-05',
                    'read_time' => '4 min read',
                    'views' => 634,
                    'comments_count' => 9,
                    'author' => [
                        'name' => 'আয়েশা সিদ্দিকা',
                        'avatar' => '/images/authors/author6.jpg'
                    ]
                ]
            ],
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