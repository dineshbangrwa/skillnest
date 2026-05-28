<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('course_reviews')->delete();

        $courses = DB::table('courses')->pluck('id');
        $users = DB::table('users')->pluck('id');

        if ($courses->isEmpty()) {
            $this->command->warn('⚠️  Pehle CourseSeeder run karo!');

            return;
        }

        if ($users->isEmpty()) {
            $this->command->warn('⚠️  Koi user nahi mila!');

            return;
        }

        // ─── Review Templates per Rating ─────────────────────────────────────
        $reviews = [

            // ── 5 Star Reviews ────────────────────────────────────────────────
            5 => [
                'Absolutely amazing course! The instructor explains everything so clearly. I went from zero knowledge to building real projects. Best investment I have ever made.',
                'This course completely changed my career. The content is up to date, projects are practical, and the instructor is incredibly knowledgeable. Highly recommended!',
                'I have tried many online courses but this one stands out. The pace is perfect, explanations are crystal clear, and the hands-on projects really solidify learning.',
                'Outstanding course! Every concept is explained with real-world examples. I landed a job within 2 months of completing this. Worth every rupee.',
                'The best structured course I have ever taken. The instructor breaks down complex topics into digestible pieces. The project sections are gold.',
                'Wow! I was a complete beginner and now I feel confident building real applications. The course quality is top-notch and the support community is great.',
                'Exceeded all my expectations. The course is very detailed without being boring. I love how every lecture builds on the previous one logically.',
                'Incredible value for money. I watched other expensive courses but this one taught me more in less time. The instructor truly cares about student success.',
                'Perfect course for anyone serious about learning this skill. The examples are relevant, the explanations are thorough, and the projects are challenging in a good way.',
                'Five stars without any hesitation. This course has everything — theory, practice, real projects, and career tips. My confidence has skyrocketed.',
            ],

            // ── 4 Star Reviews ────────────────────────────────────────────────
            4 => [
                'Really good course overall. The content is solid and well-organised. Some sections could be a bit more in depth but for the price it is excellent value.',
                'Great course! Learned a lot of practical skills. The instructor is knowledgeable and explains things well. Would love more exercises but still highly recommended.',
                'Very good course with clear explanations. The projects are practical and helped me understand concepts better. Minor improvements could make it perfect.',
                'I enjoyed this course a lot. The pace is good and the content is relevant. A few topics felt rushed but the overall experience was very positive.',
                'Solid course with quality content. The hands-on sections are the best part. The theory sections are a little dry but that is fine for learning.',
                'Good course for beginners and intermediate learners alike. Explanations are easy to follow. Would have liked more advanced topics covered.',
                'Quality course that delivers what it promises. The instructor is responsive and the community is helpful. Took away one star for a few outdated examples.',
                'Really enjoyed this course. The structure is logical and builds nicely. Some videos could be shorter but the content itself is very informative.',
                'A great learning experience. The practical projects make the concepts stick. I would recommend this to anyone looking to upskill in this area.',
                'Very helpful course. Learned things I could apply immediately at work. The only thing missing is more quiz questions for self-assessment.',
            ],

            // ── 3 Star Reviews ────────────────────────────────────────────────
            3 => [
                'Decent course but nothing groundbreaking. The basics are covered well but advanced topics are too surface level. Good starting point for beginners.',
                'Average course. The explanations are okay but I expected more depth. Some sections feel rushed and could benefit from more examples.',
                'It is okay. Some parts are excellent and others feel like they were added just to increase the course length. Worth it at a discounted price.',
                'The fundamentals section is great but the advanced section disappointed me. Still useful overall if you are just starting out.',
                'Mixed feelings. The instructor knows the subject but the delivery can be monotone at times. The projects save it from being a two-star course.',
                'Okay course for absolute beginners. If you already have some experience you might not get as much value. The projects are the highlight.',
            ],

            // ── 2 Star Reviews ────────────────────────────────────────────────
            2 => [
                'Expected more depth and quality. Some explanations are confusing and the course needs better editing. Not what I hoped for.',
                'Disappointed with this course. Too much theory not enough practice. The code examples have errors that are not addressed.',
                'Not very impressed. The content is very basic and the delivery is slow. I had to look for other resources to fill in the gaps.',
            ],

            // ── 1 Star Reviews ────────────────────────────────────────────────
            1 => [
                'Very disappointing. The content is outdated and the instructor rushes through important topics. Would not recommend.',
                'Not worth the time. Extremely basic content that you can find for free on YouTube. Very poor quality overall.',
            ],
        ];

        // Rating distribution — realistic like Udemy (mostly 4 & 5 stars)
        $ratingPool = [
            5, 5, 5, 5, 5,   // 50%
            4, 4, 4,          // 30%
            3, 3,             // 15%
            2,                //  4%
            1,                //  1%
        ];

        $rows = [];
        $usersArray = $users->toArray();
        $userCount = count($usersArray);
        $usedPairs = []; // prevent same user reviewing same course twice

        foreach ($courses as $courseId) {
            // Each course gets 6–12 reviews
            $reviewCount = rand(6, 12);

            $shuffledUsers = $usersArray;
            shuffle($shuffledUsers);

            $given = 0;
            foreach ($shuffledUsers as $userId) {
                if ($given >= $reviewCount) {
                    break;
                }

                $pairKey = $courseId.'_'.$userId;
                if (isset($usedPairs[$pairKey])) {
                    continue;
                }
                $usedPairs[$pairKey] = true;

                $rating = $ratingPool[array_rand($ratingPool)];
                $reviewText = $reviews[$rating][array_rand($reviews[$rating])];

                $rows[] = [
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'rating' => $rating,
                    'review' => $reviewText,
                    'created_at' => now()->subDays(rand(1, 180)),
                    'updated_at' => now()->subDays(rand(0, 10)),
                ];

                $given++;
            }
        }

        // Batch insert
        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('course_reviews')->insert($chunk);
        }

        $this->command->info('✅ '.count($rows).' course reviews seeded successfully.');
    }
}
