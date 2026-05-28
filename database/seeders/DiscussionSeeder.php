<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscussionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('discussion_replies')->delete();
        DB::table('discussions')->delete();

        $users = DB::table('users')->pluck('id')->toArray();
        $lessons = DB::table('lessons')
            ->join('sections', 'lessons.section_id', '=', 'sections.id')
            ->select('lessons.id as lesson_id', 'sections.course_id')
            ->get();

        if ($lessons->isEmpty()) {
            $this->command->warn('⚠️  Pehle LessonSeeder run karo!');

            return;
        }

        if (empty($users)) {
            $this->command->warn('⚠️  Koi user nahi mila!');

            return;
        }

        // ─── Discussion Templates ─────────────────────────────────────────────
        $discussionTemplates = [

            // ── Concept related ───────────────────────────────────────────────
            [
                'title' => 'Can someone explain the difference between == and === ?',
                'message' => 'Hi everyone, I am confused about when to use == vs ===. The lecture covered this briefly but I still don\'t fully understand when strict equality matters. Can anyone give a practical example?',
            ],
            [
                'title' => 'Why does async/await need a try/catch block?',
                'message' => 'I noticed the instructor always wraps async/await in try/catch. Is this always required? What happens if we don\'t use it? I tried without it and got an unhandled promise rejection warning.',
            ],
            [
                'title' => 'Difference between props and state in this context?',
                'message' => 'I\'m struggling to understand when to use props vs state. The lecture explained it but I am still confused about which one to use when building a real application. Any help appreciated!',
            ],
            [
                'title' => 'Getting a 404 error when following along',
                'message' => 'I followed the instructor exactly but I keep getting a 404 error. My route seems correct. Here is what I have done so far — can anyone spot the mistake? I have been stuck on this for 2 hours.',
            ],
            [
                'title' => 'What is the purpose of the index in this loop?',
                'message' => 'In the lecture the instructor used the index parameter in the loop but did not explain why. What is it used for and when do we actually need it? Thanks in advance.',
            ],
            [
                'title' => 'Is it okay to skip the optional sections?',
                'message' => 'There are some sections marked as optional in this course. If I am short on time, is it safe to skip them or will I miss important concepts that are needed later in the course?',
            ],
            [
                'title' => 'My output does not match the instructor\'s output',
                'message' => 'I have typed the exact same code as the instructor but my output is different. I double checked everything. Could this be a version issue? I am using the latest version.',
            ],
            [
                'title' => 'Can we use this concept in a real production project?',
                'message' => 'The technique shown in this lecture looks good for learning but is it actually used in real production projects? I want to make sure I\'m learning industry-standard approaches.',
            ],
            [
                'title' => 'Best way to practice this topic?',
                'message' => 'I understood the lecture well but I want to practice this concept more. What are the best exercises or mini-projects you recommend to really master this topic before moving on?',
            ],
            [
                'title' => 'Error: Cannot read properties of undefined',
                'message' => 'I keep getting "Cannot read properties of undefined" error at this step. I have checked my code multiple times and it looks identical to the instructor\'s. What could be causing this?',
            ],
            [
                'title' => 'What happens if we reverse the order here?',
                'message' => 'I was curious what would happen if we reverse the order of these two operations. I tried it and got unexpected results. Can someone explain why the order matters in this case?',
            ],
            [
                'title' => 'Is there a shorthand way to write this?',
                'message' => 'The code in this lecture works fine but it seems quite verbose. Is there a shorter or more elegant way to achieve the same result? I have seen some developers write this differently.',
            ],
            [
                'title' => 'How does this relate to what we learned in section 2?',
                'message' => 'I am a bit confused about how the concept in this lecture relates to what was covered in section 2. Are they solving the same problem in different ways? What are the trade-offs?',
            ],
            [
                'title' => 'Module not found error when installing packages',
                'message' => 'I ran the install command exactly as shown but I keep getting a "module not found" error. I tried deleting node_modules and reinstalling but still the same issue. Any solutions?',
            ],
            [
                'title' => 'What is the performance difference between these two approaches?',
                'message' => 'The instructor mentioned there is a performance difference between the two approaches shown. Can someone explain in more detail when one is significantly better than the other?',
            ],
            [
                'title' => 'Does this work on Windows too?',
                'message' => 'The instructor is using a Mac and some commands look different on my Windows machine. Has anyone successfully set this up on Windows? Any specific steps I should follow?',
            ],
            [
                'title' => 'Resource recommendations for this topic?',
                'message' => 'This lecture gave me a great introduction but I want to go deeper. Can anyone recommend good books, articles or additional resources to really master this particular topic?',
            ],
            [
                'title' => 'Why are we using this library instead of the built-in solution?',
                'message' => 'I noticed the instructor is using an external library for something that seems doable with built-in features. Is there a specific reason for this choice? Is the built-in approach not recommended?',
            ],
        ];

        // ─── Reply Templates ──────────────────────────────────────────────────
        $replyTemplates = [
            // Instructor-style helpful replies
            [
                'message' => 'Great question! This is one of the most common points of confusion for beginners. The key thing to remember is that the strict version checks both value and type, while the loose version only checks value after type coercion. I always recommend using the strict version in production code.',
            ],
            [
                'message' => 'I had the exact same issue! The fix for me was to check the version number. Make sure you are using the version mentioned in the lecture resources section. Newer versions sometimes have breaking changes.',
            ],
            [
                'message' => 'This tripped me up too. After reading the documentation more carefully I understood — the order matters because the second operation depends on the result of the first. Try adding a console.log between the steps to see the intermediate values.',
            ],
            [
                'message' => 'Yes it works on Windows! You just need to use the Windows-specific command. Check the pinned resources for this section — the instructor added a note specifically for Windows users.',
            ],
            [
                'message' => 'For practice I recommend building a small clone of a simple app using only this concept. That\'s what helped me understand it properly. Start with something tiny and gradually add complexity.',
            ],
            [
                'message' => 'The external library is used because the built-in solution does not handle edge cases well and has some known bugs in older browsers. The library is battle-tested and used widely in production.',
            ],
            [
                'message' => 'I solved this by carefully re-reading the error message. The "undefined" error usually means a variable is being used before it is initialised. Add some console.log statements before the error line to debug.',
            ],
            [
                'message' => 'Yes absolutely you can skip the optional sections and come back later. The main course flow does not depend on them. They are just bonus content for those who want to go deeper.',
            ],
            [
                'message' => 'In real production projects this exact pattern is used very commonly. I use it at work daily. The instructor is teaching industry-standard practices — you are on the right track.',
            ],
            [
                'message' => 'The shorthand version uses destructuring and the spread operator together. It is more elegant but can be harder to read for beginners. Once you are comfortable with ES6+ syntax you will prefer it.',
            ],
            [
                'message' => 'I had the same module not found error. The solution was to delete the package-lock.json file along with node_modules and then run npm install again. That fixed it for me.',
            ],
            [
                'message' => 'The performance difference becomes significant at scale. For small datasets it does not matter much. But when processing thousands of items the optimised approach can be 10x faster.',
            ],
            [
                'message' => 'Welcome to the most confusing part of this topic! Once it clicks it becomes second nature. The best mental model is to think of it as... [see the pinned explanation in course resources].',
            ],
            [
                'message' => 'I recommend the official documentation as the best additional resource. It is surprisingly readable and has great examples. Also check the GitHub repository linked in the course resources.',
            ],
            [
                'message' => 'This is actually a really insightful question. Both approaches solve the same problem but the one taught here scales better and is easier to test. The other approach becomes messy in large codebases.',
            ],
        ];

        // ─── Seed Discussions ─────────────────────────────────────────────────
        $discussionRows = [];
        $replyRows = [];
        $lessonSample = $lessons->random(min(80, $lessons->count())); // pick up to 80 lessons

        foreach ($lessonSample as $lesson) {
            // Each lesson gets 1–2 discussions
            $discussionCount = rand(1, 2);

            for ($d = 0; $d < $discussionCount; $d++) {
                $template = $discussionTemplates[array_rand($discussionTemplates)];
                $userId = $users[array_rand($users)];
                $isResolved = (bool) rand(0, 1);

                $discussionRows[] = [
                    'course_id' => $lesson->course_id,
                    'lesson_id' => $lesson->lesson_id,
                    'user_id' => $userId,
                    'title' => $template['title'],
                    'message' => $template['message'],
                    'is_resolved' => $isResolved,
                    'created_at' => now()->subDays(rand(1, 120)),
                    'updated_at' => now()->subDays(rand(0, 30)),
                ];
            }
        }

        // Insert discussions in batches
        foreach (array_chunk($discussionRows, 100) as $chunk) {
            DB::table('discussions')->insert($chunk);
        }

        // ─── Seed Replies ─────────────────────────────────────────────────────
        $insertedDiscussions = DB::table('discussions')->get();

        foreach ($insertedDiscussions as $discussion) {
            // Each discussion gets 1–4 replies
            $replyCount = rand(1, 4);

            for ($r = 0; $r < $replyCount; $r++) {
                $replyTemplate = $replyTemplates[array_rand($replyTemplates)];
                $replyUserId = $users[array_rand($users)];

                $replyRows[] = [
                    'discussion_id' => $discussion->id,
                    'user_id' => $replyUserId,
                    'message' => $replyTemplate['message'],
                    'created_at' => now()->subDays(rand(0, 90)),
                    'updated_at' => now()->subDays(rand(0, 10)),
                ];
            }
        }

        // Insert replies in batches
        foreach (array_chunk($replyRows, 100) as $chunk) {
            DB::table('discussion_replies')->insert($chunk);
        }

        $this->command->info('✅ '.count($discussionRows).' discussions seeded successfully.');
        $this->command->info('✅ '.count($replyRows).' discussion replies seeded successfully.');
    }
}
