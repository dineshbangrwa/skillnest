<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sections')->delete();

        $courses = DB::table('courses')->pluck('title', 'id');

        if ($courses->isEmpty()) {
            $this->command->warn('⚠️  first  CourseSeeder the run');

            return;
        }

        // ─── Course-specific sections ────────────────────────────────────────
        $courseSections = [

            // ── Web Development ──────────────────────────────────────────────
            'The Complete HTML & CSS Bootcamp 2025' => [
                'Getting Started',
                'Core Fundamentals',
                'Intermediate Concepts',
                'Working with Forms & Tables',
                'Building a Real Project',
                'Responsive Design & Media Queries',
                'Deployment & Conclusion',
            ],
            'JavaScript: Zero to Expert (2025 Edition)' => [
                'Getting Started',
                'Core Fundamentals',
                'Intermediate Concepts',
                'Working with APIs',

            ],
            'React – The Complete Guide (incl. Redux & Hooks)' => [
                'Getting Started',
                'Core Fundamentals',
                'Intermediate Concepts',
                'State Management with Redux',

            ],
            // 'Vue 3 – The Complete Guide (incl. Router & Vuex)' => [
            //     'Getting Started',
            //     'Core Fundamentals',
            //     'Vue Router & Navigation',
            //     'State Management with Vuex / Pinia',
            // ],
            // 'Laravel 11 – Build Real-World Apps with PHP' => [
            //     'Getting Started',
            //     'Core Fundamentals',
            //     'Intermediate Concepts',
            //     'Working with Databases & Eloquent',
            // ],
            // 'Node.js, Express, MongoDB & More: The Complete Bootcamp' => [
            //     'Getting Started',
            //     'Core Fundamentals',
            //     'Working with MongoDB & Mongoose',
            //     'Authentication & Security',
            // ],
            // 'Next.js 14 & React – The Complete Guide' => [
            //     'Getting Started',
            //     'Core Fundamentals',
            //     'Server Components & Server Actions',
            //     'Data Fetching & Caching',
            // ],
            // 'TypeScript Masterclass – The Complete TypeScript Course' => [
            //     'Getting Started',
            //     'Core Fundamentals',
            //     'Advanced Types & Generics',
            //     'TypeScript with React',
            // ],
            // 'Tailwind CSS 3 – From Scratch to Production' => [
            //     'Getting Started',
            //     'Core Utility Classes',
            //     'Layouts with Flexbox & Grid',
            //     'Responsive Design',
            // ],
            // 'GraphQL with React: The Complete Developers Guide' => [
            //     'Getting Started',
            //     'GraphQL Fundamentals',
            //     'Apollo Client with React',
            //     'Mutations & Subscriptions',

            // ],

            // // ── Mobile Development ───────────────────────────────────────────
            // 'Flutter & Dart – The Complete App Development Bootcamp' => [
            //     'Getting Started',
            //     'Dart Language Fundamentals',
            //     'Flutter Widgets & UI',
            //     'State Management',
            // ],
            // 'Android Development with Kotlin – Beginner to Advanced' => [
            //     'Getting Started',
            //     'Kotlin Language Fundamentals',
            //     'Android UI with Jetpack Compose',
            //     'Data Layer – Room & Retrofit',
            // ],
            // 'iOS 17 & Swift 5 – The Complete iOS App Development Bootcamp' => [
            //     'Getting Started',
            //     'Swift Language Fundamentals',
            //     'UIKit & SwiftUI Basics',
            //     'Data Persistence & Networking',
            // ],
            // 'React Native – The Practical Guide' => [
            //     'Getting Started',
            //     'Core Fundamentals',
            //     'Navigation & Routing',
            //     'State Management with Redux',
            // ],
            // 'Jetpack Compose for Android – Modern UI Development' => [
            //     'Getting Started',
            //     'Composable Functions & Layouts',
            //     'State & Recomposition',
            //     'Navigation in Compose',
            // ],

            // // ── Data Science & Machine Learning ──────────────────────────────
            // 'Python for Data Science and Machine Learning Bootcamp' => [
            //     'Getting Started with Python',
            //     'NumPy – Array Operations',
            //     'Pandas – Data Manipulation',
            //     'Data Visualisation',
            // ],
            // 'Machine Learning A–Z: AI, Python & R + ChatGPT Bonus' => [
            //     'Getting Started',
            //     'Data Pre-Processing',
            //     'Regression Models',
            //     'Classification Models',
            // ],
            // 'Deep Learning Specialisation with TensorFlow & Keras' => [
            //     'Getting Started',
            //     'Neural Network Fundamentals',
            //     'Convolutional Neural Networks',
            //     'Recurrent Neural Networks & LSTMs',
            // ],
            // 'Data Analysis with Python & Pandas – Complete Course' => [
            //     'Getting Started',
            //     'Python Basics for Data Analysis',
            //     'Pandas – Data Manipulation & Analysis',
            //     'Real-World Project',
            // ],
            // 'SQL & Database Design – Complete Bootcamp 2025' => [
            //     'Introduction to Databases',
            //     'SQL Basics & Queries',
            //     'Filtering, Sorting & Aggregation',
            //     'Joins & Relationships',
            // ],
            // 'Natural Language Processing with Python' => [
            //     'Getting Started',
            //     'Text Pre-Processing & NLTK',
            //     'Feature Engineering for NLP',
            //     'Sentiment Analysis & Classification',
            // ],
            // 'Power BI – Business Intelligence for Beginners' => [
            //     'Getting Started',
            //     'Connecting & Transforming Data',
            //     'DAX Fundamentals',
            //     'Building Visualisations',
            // ],

            // // ── Cloud & DevOps ────────────────────────────────────────────────
            // 'AWS Certified Solutions Architect – Associate 2025' => [
            //     'Getting Started',
            //     'IAM & Security',
            //     'Compute – EC2 & Lambda',
            //     'Storage – S3 & EBS',
            // ],
            // 'Docker & Kubernetes: The Complete Practical Guide' => [
            //     'Getting Started',
            //     'Docker Fundamentals',
            //     'Docker Compose & Networking',
            //     'Kubernetes Architecture',
            // ],
            // 'Terraform on AWS – Infrastructure as Code Masterclass' => [
            //     'Getting Started',
            //     'Terraform Core Concepts',
            //     'Provisioning AWS Resources',
            //     'Modules & Reusability',
            // ],
            // 'CI/CD with GitHub Actions – DevOps for Developers' => [
            //     'Getting Started',
            //     'GitHub Actions Fundamentals',
            //     'Building CI Pipelines',
            //     'Automated Testing',
            // ],
            // 'Linux Command Line & Shell Scripting Bible' => [
            //     'Getting Started',
            //     'Core Linux Commands',
            //     'File System & Permissions',
            //     'Bash Scripting Fundamentals',
            // ],
            // 'Kubernetes for Absolute Beginners – Hands-on' => [
            //     'Getting Started',
            //     'Core Kubernetes Objects',
            //     'Networking & Services',
            //     'Storage & Config Management',
            // ],
            // 'Google Cloud Professional Cloud Architect – Exam Prep' => [
            //     'Getting Started',
            //     'GCP Core Services',
            //     'Compute & Containers – GKE',
            //     'Data & Analytics – BigQuery',
            // ],

            // // ── Cyber Security ────────────────────────────────────────────────
            // 'The Complete Ethical Hacking Course – Beginner to Advanced' => [
            //     'Getting Started',
            //     'Networking Fundamentals',
            //     'Reconnaissance & Scanning',
            //     'Exploitation & Post-Exploitation',
            // ],
            // 'CompTIA Security+ (SY0-701) Complete Course & Practice Exam' => [
            //     'Getting Started',
            //     'Threats, Attacks & Vulnerabilities',
            //     'Cryptography & PKI',
            //     'Identity & Access Management',
            // ],
            // 'Web Application Penetration Testing – OWASP Top 10' => [
            //     'Getting Started',
            //     'Setting Up the Lab',
            //     'Injection Attacks – SQL & Command',
            //     'Authentication & Session Vulnerabilities',
            //     'XSS, CSRF & Broken Access Control',
            // ],

            // // ── Design ────────────────────────────────────────────────────────
            // 'UI/UX Design Bootcamp – Figma, Prototyping & Research' => [
            //     'Getting Started',
            //     'Design Principles & Theory',
            //     'Figma Essentials',
            //     'User Research & Information Architecture',
            // ],
            // 'Adobe Photoshop CC – The Complete Beginners Guide 2025' => [
            //     'Getting Started',
            //     'Core Tools & Interface',
            //     'Layers, Masks & Blending',
            //     'Photo Retouching & Manipulation',
            // ],
            // 'Adobe Illustrator CC – Advanced Training for Designers' => [
            //     'Getting Started',
            //     'Vector Graphics Fundamentals',
            //     'Typography & Logo Design',
            //     'Real-World Design Project',
            // ],
            // 'Motion Graphics & Video Editing with After Effects' => [
            //     'Getting Started',
            //     'After Effects Interface & Basics',
            //     'Keyframes & Animation Principles',
            //     'Motion Graphics & Text Animation',
            // ],
            // 'Canva Masterclass – Graphic Design for Non-Designers' => [
            //     'Getting Started',
            //     'Canva Interface & Essentials',
            //     'Social Media & Marketing Design',
            //     'Presentations & Documents',
            // ],

            // // ── Business & Finance ────────────────────────────────────────────
            // 'Digital Marketing Masterclass – 23 Courses in 1' => [
            //     'Getting Started',
            //     'SEO & Content Marketing',
            //     'Social Media Marketing',
            //     'Email Marketing',
            // ],
            // 'Stock Market Investing for Beginners – Crash Course' => [
            //     'Getting Started',
            //     'How the Stock Market Works',
            //     'Fundamental Analysis',
            //     'Technical Analysis Basics',
            // ],
            // 'The Complete Financial Analyst Course 2025' => [
            //     'Getting Started',
            //     'Accounting & Financial Statements',
            //     'Financial Modelling in Excel',
            //     'Valuation Methods',
            // ],
            // 'Search Engine Optimisation (SEO) 2025 – Complete Course' => [
            //     'Getting Started',
            //     'Keyword Research',
            //     'On-Page SEO',
            //     'Technical SEO',
            // ],
            // 'Entrepreneurship & Startup Launch Masterclass' => [
            //     'Getting Started',
            //     'Ideation & Validation',
            //     'Building Your MVP',
            //     'Growth Hacking & Marketing',
            // ],

            // // ── More Web Development ──────────────────────────────────────────
            // 'Python Bootcamp 2025: Zero to Hero in Python' => [
            //     'Getting Started',
            //     'Core Fundamentals',
            //     'Data Structures & Functions',
            //     'Object-Oriented Programming',
            // ],
            // 'Django 4 – Full Stack Web Development with Python' => [
            //     'Getting Started',
            //     'Core Fundamentals',
            //     'Templates & Static Files',
            //     'Models, ORM & Database',
            // ],
            // 'Spring Boot 3 & Microservices – Enterprise Java 2025' => [
            //     'Getting Started',
            //     'Spring Boot Core Concepts',
            //     'Database & JPA / Hibernate',
            //     'REST APIs & Security',
            // ],
            // 'The Complete Sass & SCSS Course: From Beginner to Advanced' => [
            //     'Getting Started',
            //     'Sass Variables & Nesting',
            //     'Mixins & Functions',
            //     'Inheritance & Partials',
            // ],
            // 'Redis: The Complete Developer\'s Guide' => [
            //     'Getting Started',
            //     'Core Data Structures',
            //     'Caching Strategies',
            // ],
            // 'WebSockets & Real-Time Apps with Socket.io & Node' => [
            //     'Getting Started',
            //     'WebSocket Fundamentals',
            //     'Socket.io Basics',
            //     'Building a Real-Time Chat App',
            // ],
            // 'Microservices with Node.js & React – The Complete Guide' => [
            //     'Getting Started',
            //     'Microservices Architecture Fundamentals',
            //     'Building Services with Node.js',
            //     'React Frontend & API Gateway',
            // ],
            // 'WordPress for Beginners: Create a Website Step by Step' => [
            //     'Getting Started',
            //     'WordPress Dashboard & Settings',
            //     'Themes & Customisation',
            //     'Plugins & Functionality',
            // ],
        ];

        $rows = [];

        foreach ($courses as $courseId => $courseTitle) {
            $sections = $courseSections[$courseTitle] ?? [
                'Getting Started',
                'Core Fundamentals',
                'Intermediate Concepts',
                'Hands-on Project Build',
                'Advanced Topics',
                'Deployment & Conclusion',
            ];

            foreach ($sections as $sectionTitle) {
                $rows[] = [
                    'course_id' => $courseId,
                    'title' => $sectionTitle,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('sections')->insert($rows);

        $this->command->info('✅ '.count($rows).' sections seeded successfully.');
    }
}
