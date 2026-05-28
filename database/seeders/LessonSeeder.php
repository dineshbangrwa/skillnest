<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lessons')->delete();

        $sections = DB::table('sections')
            ->join('courses', 'sections.course_id', '=', 'courses.id')
            ->select('sections.id as section_id', 'sections.title as section_title', 'courses.title as course_title')
            ->get();

        if ($sections->isEmpty()) {
            $this->command->warn('⚠️  Pehle SectionSeeder run karo!');

            return;
        }

        // ─── Course-specific lessons (section title → lessons array) ─────────
        $courseLessons = [

            // ════════════════════════════════════════════════════════════════
            // WEB DEVELOPMENT
            // ════════════════════════════════════════════════════════════════

            'The Complete HTML & CSS Bootcamp 2025' => [
                'Getting Started' => [
                    ['title' => 'Course Introduction & What You Will Build', 'duration' => 5,  'is_preview' => 1, 'content' => 'Overview of projects we will build and how to use this course effectively.'],
                    ['title' => 'Setting Up VS Code & Live Server',           'duration' => 7,  'is_preview' => 1, 'content' => 'Install VS Code, Live Server extension and create your first HTML file.'],
                ],
                'Core Fundamentals' => [
                    ['title' => 'HTML Document Structure & Semantic Tags',   'duration' => 18, 'is_preview' => 0, 'content' => 'DOCTYPE, html, head, body, header, main, footer and semantic HTML5 elements.'],
                    ['title' => 'Text, Links, Images & Lists',               'duration' => 15, 'is_preview' => 0, 'content' => 'Headings, paragraphs, anchor tags, img elements and ordered/unordered lists.'],
                    ['title' => 'CSS Selectors, Box Model & Colors',         'duration' => 20, 'is_preview' => 0, 'content' => 'Class, ID, element selectors, margin, padding, border and color values.'],
                ],
                'Intermediate Concepts' => [
                    ['title' => 'CSS Flexbox – Complete Guide',              'duration' => 25, 'is_preview' => 0, 'content' => 'flex-direction, justify-content, align-items and building real layouts.'],
                    ['title' => 'CSS Grid – Complete Guide',                 'duration' => 24, 'is_preview' => 0, 'content' => 'grid-template-columns, rows, areas, gap and two-dimensional layouts.'],
                    ['title' => 'CSS Animations & Transitions',              'duration' => 18, 'is_preview' => 0, 'content' => 'Keyframe animations, transition timing and hover effects.'],
                ],
                'Working with Forms & Tables' => [
                    ['title' => 'HTML Forms – Inputs, Labels & Validation',  'duration' => 16, 'is_preview' => 0, 'content' => 'Input types, required attributes, placeholders and native HTML validation.'],
                    ['title' => 'Styling Forms with CSS',                    'duration' => 14, 'is_preview' => 0, 'content' => 'Custom checkboxes, select menus, focus states and accessible forms.'],
                    ['title' => 'HTML Tables & Styling',                     'duration' => 12, 'is_preview' => 0, 'content' => 'thead, tbody, tfoot, colspan, rowspan and CSS table styles.'],
                ],
                'Building a Real Project' => [
                    ['title' => 'Project: Portfolio – Setup & Global Styles', 'duration' => 10, 'is_preview' => 1, 'content' => 'Plan layout, create file structure and add CSS resets and custom properties.'],
                    ['title' => 'Project: Navigation & Hero Section',        'duration' => 18, 'is_preview' => 0, 'content' => 'Build a responsive navbar and full-screen hero with Flexbox.'],
                    ['title' => 'Project: Projects Grid & Contact Form',     'duration' => 20, 'is_preview' => 0, 'content' => 'CSS Grid projects section and a styled contact form.'],
                ],
                'Responsive Design & Media Queries' => [
                    ['title' => 'Media Queries & Breakpoints',               'duration' => 16, 'is_preview' => 0, 'content' => 'Mobile-first approach, common breakpoints and responsive typography.'],
                    ['title' => 'Responsive Images & Fluid Layouts',         'duration' => 14, 'is_preview' => 0, 'content' => 'srcset, picture element, max-width and fluid grid techniques.'],
                ],
                'Deployment & Conclusion' => [
                    ['title' => 'Deploying to Netlify for Free',             'duration' => 10, 'is_preview' => 0, 'content' => 'Push to GitHub and deploy your portfolio with Netlify in minutes.'],
                    ['title' => 'Course Wrap-up & Next Steps',               'duration' => 5,  'is_preview' => 0, 'content' => 'Everything covered and your recommended learning roadmap.'],
                ],
            ],

            'JavaScript: Zero to Expert (2025 Edition)' => [
                'Getting Started' => [
                    ['title' => 'JavaScript Introduction & Dev Setup',       'duration' => 6,  'is_preview' => 1, 'content' => 'What JS is, where it runs and setting up VS Code with extensions.'],
                    ['title' => 'How JavaScript Engines Work',               'duration' => 8,  'is_preview' => 1, 'content' => 'V8 engine, call stack, memory heap and the event loop overview.'],
                ],
                'Core Fundamentals' => [
                    ['title' => 'Variables – var, let & const',              'duration' => 14, 'is_preview' => 0, 'content' => 'Differences, scope, hoisting and best practices.'],
                    ['title' => 'Data Types & Type Coercion',                'duration' => 18, 'is_preview' => 0, 'content' => 'Primitive types, typeof operator and implicit type conversion.'],
                    ['title' => 'Operators, Conditionals & Loops',           'duration' => 20, 'is_preview' => 0, 'content' => 'Arithmetic, comparison, logical operators, if/else, switch, for and while loops.'],
                    ['title' => 'Functions – Declarations, Expressions & Arrows', 'duration' => 22, 'is_preview' => 0, 'content' => 'Function types, default params, rest params and arrow functions.'],
                ],
                'Intermediate Concepts' => [
                    ['title' => 'The DOM – Selecting & Manipulating Elements', 'duration' => 24, 'is_preview' => 0, 'content' => 'querySelector, innerHTML, classList and creating elements dynamically.'],
                    ['title' => 'Events & Event Delegation',                 'duration' => 20, 'is_preview' => 0, 'content' => 'addEventListener, event object, bubbling and event delegation.'],
                    ['title' => 'Arrays – Methods & Functional Patterns',    'duration' => 24, 'is_preview' => 0, 'content' => 'map, filter, reduce, find, sort and chaining methods.'],
                    ['title' => 'Closures, Scope & the this Keyword',        'duration' => 22, 'is_preview' => 0, 'content' => 'Lexical scope, closure use cases and this in different contexts.'],
                ],
                'Working with APIs' => [
                    ['title' => 'Fetch API & JSON',                         'duration' => 20, 'is_preview' => 0, 'content' => 'Making GET/POST requests, parsing JSON and handling errors.'],
                    ['title' => 'Working with REST APIs',                   'duration' => 18, 'is_preview' => 0, 'content' => 'CRUD operations, query parameters and API keys.'],
                ],
                'Asynchronous JavaScript' => [
                    ['title' => 'Callbacks & the Event Loop',               'duration' => 18, 'is_preview' => 0, 'content' => 'Async nature of JS, callback pattern and callback hell.'],
                    ['title' => 'Promises – then, catch & chaining',        'duration' => 20, 'is_preview' => 0, 'content' => 'Promise states, chaining, Promise.all and error handling.'],
                    ['title' => 'Async/Await – Clean Asynchronous Code',    'duration' => 18, 'is_preview' => 0, 'content' => 'Writing async functions, try/catch and combining with Promises.'],
                ],
                'Object-Oriented Programming' => [
                    ['title' => 'OOP with Classes & Inheritance',           'duration' => 24, 'is_preview' => 0, 'content' => 'ES6 classes, constructor, extends, super and polymorphism.'],
                    ['title' => 'Prototypes & the Prototype Chain',         'duration' => 18, 'is_preview' => 0, 'content' => 'Prototype-based inheritance and how classes work under the hood.'],
                ],
                'Building a Real Project' => [
                    ['title' => 'Project: Bankist App – Setup',             'duration' => 10, 'is_preview' => 1, 'content' => 'Plan the project architecture and set up HTML/CSS structure.'],
                    ['title' => 'Project: Login, Transfers & Loans',        'duration' => 28, 'is_preview' => 0, 'content' => 'Implement authentication, money transfer and loan features.'],
                    ['title' => 'Project: Timer, Sorting & Final Touches',  'duration' => 20, 'is_preview' => 0, 'content' => 'Logout timer, sorting transactions and polishing the app.'],
                ],
                'Advanced Topics' => [
                    ['title' => 'ES2022+ Modern JavaScript Features',       'duration' => 16, 'is_preview' => 0, 'content' => 'Optional chaining, nullish coalescing, top-level await and more.'],
                    ['title' => 'Modules & Bundling with Vite',             'duration' => 14, 'is_preview' => 0, 'content' => 'ES modules, import/export and building with Vite.'],
                ],
                'Deployment & Conclusion' => [
                    ['title' => 'Deploying JavaScript Apps',               'duration' => 10, 'is_preview' => 0, 'content' => 'Deploy to Netlify/Vercel from GitHub.'],
                    ['title' => 'Course Summary & What to Learn Next',     'duration' => 6,  'is_preview' => 0, 'content' => 'Recap of everything and your personalised learning roadmap.'],
                ],
            ],

            'React – The Complete Guide (incl. Redux & Hooks)' => [
                'Getting Started' => [
                    ['title' => 'What is React & Why Use It?',              'duration' => 7,  'is_preview' => 1, 'content' => 'React philosophy, virtual DOM and when to use React.'],
                    ['title' => 'Create React App & Project Structure',     'duration' => 8,  'is_preview' => 1, 'content' => 'Bootstrapping a React app with Vite and understanding the folder structure.'],
                ],
                'Core Fundamentals' => [
                    ['title' => 'JSX – JavaScript XML Syntax',             'duration' => 14, 'is_preview' => 0, 'content' => 'Writing JSX, embedding expressions and how JSX compiles to JS.'],
                    ['title' => 'Components, Props & Composition',         'duration' => 18, 'is_preview' => 0, 'content' => 'Functional components, passing props and composing UIs.'],
                    ['title' => 'useState – Managing Local State',         'duration' => 16, 'is_preview' => 0, 'content' => 'State declaration, updating state and re-rendering.'],
                    ['title' => 'Handling Events & Conditional Rendering', 'duration' => 14, 'is_preview' => 0, 'content' => 'onClick, onChange, ternary rendering and short-circuit evaluation.'],
                ],
                'Intermediate Concepts' => [
                    ['title' => 'useEffect – Side Effects & Data Fetching', 'duration' => 22, 'is_preview' => 0, 'content' => 'Fetching data, subscriptions, cleanup and dependency array.'],
                    ['title' => 'useRef, useMemo & useCallback',           'duration' => 18, 'is_preview' => 0, 'content' => 'Performance hooks and accessing DOM with useRef.'],
                    ['title' => 'Custom Hooks',                            'duration' => 16, 'is_preview' => 0, 'content' => 'Extracting reusable stateful logic into custom hooks.'],
                    ['title' => 'Context API – Avoiding Prop Drilling',    'duration' => 18, 'is_preview' => 0, 'content' => 'createContext, Provider, useContext and when to use Context.'],
                ],
                'State Management with Redux' => [
                    ['title' => 'Redux Core Concepts',                     'duration' => 20, 'is_preview' => 0, 'content' => 'Store, actions, reducers and the Redux data flow.'],
                    ['title' => 'Redux Toolkit – Modern Redux',            'duration' => 22, 'is_preview' => 0, 'content' => 'createSlice, createAsyncThunk and RTK Query basics.'],
                ],
                'React Router & Navigation' => [
                    ['title' => 'React Router v6 – Setup & Basics',        'duration' => 16, 'is_preview' => 0, 'content' => 'BrowserRouter, Routes, Route, Link and NavLink.'],
                    ['title' => 'Dynamic Routes, Params & Nested Routes',  'duration' => 18, 'is_preview' => 0, 'content' => 'useParams, useNavigate, nested layouts and protected routes.'],
                ],
                'Working with APIs' => [
                    ['title' => 'Fetching Data with useEffect & Axios',    'duration' => 18, 'is_preview' => 0, 'content' => 'Axios vs fetch, loading/error states and cleanup.'],
                    ['title' => 'React Query – Server State Management',   'duration' => 20, 'is_preview' => 0, 'content' => 'useQuery, useMutation, caching and background refetching.'],
                ],
                'Building a Real Project' => [
                    ['title' => 'Project: Full-Stack App – Architecture',  'duration' => 10, 'is_preview' => 1, 'content' => 'Plan components, routes and state structure.'],
                    ['title' => 'Project: Authentication & Dashboard',     'duration' => 28, 'is_preview' => 0, 'content' => 'Login, protected routes and a data dashboard.'],
                    ['title' => 'Project: CRUD Features & Polish',         'duration' => 24, 'is_preview' => 0, 'content' => 'Create, edit, delete operations and final UI polish.'],
                ],
                'Advanced Topics' => [
                    ['title' => 'Performance Optimisation – React.memo & lazy', 'duration' => 18, 'is_preview' => 0, 'content' => 'Memoisation, code splitting with React.lazy and Suspense.'],
                    ['title' => 'Testing React with Vitest & Testing Library', 'duration' => 20, 'is_preview' => 0, 'content' => 'Unit tests, component tests and best practices.'],
                ],
                'Deployment & Conclusion' => [
                    ['title' => 'Deploying React Apps to Vercel',          'duration' => 8,  'is_preview' => 0, 'content' => 'Build and deploy to Vercel with environment variables.'],
                    ['title' => 'Course Summary & Next Steps',             'duration' => 5,  'is_preview' => 0, 'content' => 'Everything covered and what to learn next.'],
                ],
            ],

            'Laravel 11 – Build Real-World Apps with PHP' => [
                'Getting Started' => [
                    ['title' => 'Introduction to Laravel & MVC',           'duration' => 8,  'is_preview' => 1, 'content' => 'What is Laravel, MVC architecture and why developers love it.'],
                    ['title' => 'Installation with Composer & Artisan CLI', 'duration' => 10, 'is_preview' => 1, 'content' => 'Setting up Laravel 11 locally with Herd or XAMPP.'],
                ],
                'Core Fundamentals' => [
                    ['title' => 'Routing – Web, API & Named Routes',       'duration' => 18, 'is_preview' => 0, 'content' => 'Route definitions, parameters, groups, middleware and naming.'],
                    ['title' => 'Blade Templating Engine',                 'duration' => 20, 'is_preview' => 0, 'content' => 'Blade syntax, layouts, components, directives and inheritance.'],
                    ['title' => 'Controllers & Request Lifecycle',         'duration' => 16, 'is_preview' => 0, 'content' => 'Resource controllers, invokable controllers and request handling.'],
                ],
                'Intermediate Concepts' => [
                    ['title' => 'Authentication with Laravel Breeze',      'duration' => 18, 'is_preview' => 0, 'content' => 'Scaffolding login, register and password reset.'],
                    ['title' => 'Form Validation & Form Requests',         'duration' => 16, 'is_preview' => 0, 'content' => 'Validation rules, error messages and Form Request classes.'],
                    ['title' => 'File Storage & Image Upload',             'duration' => 14, 'is_preview' => 0, 'content' => 'Storing files, S3 driver and handling image uploads.'],
                ],
                'Working with Databases & Eloquent' => [
                    ['title' => 'Migrations & Schema Builder',             'duration' => 16, 'is_preview' => 0, 'content' => 'Creating tables, columns, indexes and foreign keys.'],
                    ['title' => 'Eloquent ORM – Models & Relationships',   'duration' => 24, 'is_preview' => 0, 'content' => 'hasMany, belongsTo, many-to-many and eager loading.'],
                    ['title' => 'Seeders & Factories',                     'duration' => 12, 'is_preview' => 0, 'content' => 'Generating fake data with Faker and running seeders.'],
                ],
                'Authentication & Authorization' => [
                    ['title' => 'Policies & Gates',                        'duration' => 16, 'is_preview' => 0, 'content' => 'Defining authorization policies and registering gates.'],
                    ['title' => 'Roles & Permissions with Spatie',         'duration' => 18, 'is_preview' => 0, 'content' => 'Installing and using the spatie/laravel-permission package.'],
                ],
                'Building a Real Project' => [
                    ['title' => 'Project: Blog – Posts, Categories & Tags', 'duration' => 25, 'is_preview' => 1, 'content' => 'Full CRUD blog with categories and tagging system.'],
                    ['title' => 'Project: Auth, Roles & Admin Panel',      'duration' => 28, 'is_preview' => 0, 'content' => 'Spatie roles, admin middleware and policy authorization.'],
                    ['title' => 'Project: Comments & Notifications',       'duration' => 20, 'is_preview' => 0, 'content' => 'Polymorphic comments and database notifications.'],
                ],
                'APIs & Testing' => [
                    ['title' => 'Building RESTful APIs with Sanctum',      'duration' => 22, 'is_preview' => 0, 'content' => 'API token auth, resources and API versioning.'],
                    ['title' => 'Testing with PHPUnit & Pest',             'duration' => 18, 'is_preview' => 0, 'content' => 'Feature tests, unit tests and database testing.'],
                ],
                'Deployment & Conclusion' => [
                    ['title' => 'Deploying Laravel to DigitalOcean',       'duration' => 18, 'is_preview' => 0, 'content' => 'Server setup, Nginx, SSL and deployment workflow.'],
                    ['title' => 'Course Summary & Next Steps',             'duration' => 5,  'is_preview' => 0, 'content' => 'Recap and your Laravel learning roadmap.'],
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // DATA SCIENCE
            // ════════════════════════════════════════════════════════════════

            'Python for Data Science and Machine Learning Bootcamp' => [
                'Getting Started with Python' => [
                    ['title' => 'Intro to Data Science & Python Setup',    'duration' => 7,  'is_preview' => 1, 'content' => 'Data science workflow and installing Anaconda with Jupyter.'],
                    ['title' => 'Python Basics – Variables, Loops & Functions', 'duration' => 14, 'is_preview' => 0, 'content' => 'Quick Python refresher covering all essentials for data science.'],
                ],
                'NumPy – Array Operations' => [
                    ['title' => 'NumPy Arrays & Indexing',                 'duration' => 22, 'is_preview' => 0, 'content' => 'ndarray, indexing, slicing and broadcasting.'],
                    ['title' => 'NumPy Math & Statistical Operations',     'duration' => 16, 'is_preview' => 0, 'content' => 'Math operations, aggregate functions and random module.'],
                ],
                'Pandas – Data Manipulation' => [
                    ['title' => 'Pandas DataFrames & Series',              'duration' => 25, 'is_preview' => 0, 'content' => 'DataFrames, reading CSV/Excel, selecting and filtering data.'],
                    ['title' => 'Grouping, Merging & Reshaping Data',      'duration' => 20, 'is_preview' => 0, 'content' => 'groupby, merge, pivot_table and melt.'],
                    ['title' => 'Handling Missing Data',                   'duration' => 14, 'is_preview' => 0, 'content' => 'Detecting, dropping and imputing missing values.'],
                ],
                'Data Visualisation' => [
                    ['title' => 'Matplotlib – Data Visualisation',         'duration' => 18, 'is_preview' => 0, 'content' => 'Line plots, bar charts, histograms and scatter plots.'],
                    ['title' => 'Seaborn – Statistical Visualisation',     'duration' => 16, 'is_preview' => 0, 'content' => 'Heatmaps, pairplots, boxplots and distribution plots.'],
                ],
                'Machine Learning with Scikit-Learn' => [
                    ['title' => 'ML Workflow & Data Pre-Processing',       'duration' => 20, 'is_preview' => 0, 'content' => 'Train/test split, feature scaling and encoding.'],
                    ['title' => 'Regression & Classification Models',      'duration' => 24, 'is_preview' => 0, 'content' => 'Linear regression, logistic regression, decision trees.'],
                    ['title' => 'Model Evaluation & Cross Validation',     'duration' => 18, 'is_preview' => 0, 'content' => 'Accuracy, confusion matrix, ROC curve and k-fold CV.'],
                ],
                'Deep Learning with TensorFlow' => [
                    ['title' => 'Neural Networks with Keras',              'duration' => 22, 'is_preview' => 0, 'content' => 'Dense layers, activation functions, compile and fit.'],
                    ['title' => 'CNNs for Image Classification',           'duration' => 24, 'is_preview' => 0, 'content' => 'Conv2D, MaxPooling, dropout and image data generators.'],
                ],
                'Real-World Project' => [
                    ['title' => 'Capstone: End-to-End ML Pipeline',        'duration' => 30, 'is_preview' => 1, 'content' => 'Data collection, EDA, model training and evaluation.'],
                    ['title' => 'Capstone: Deployment with Flask',         'duration' => 20, 'is_preview' => 0, 'content' => 'Serving a trained model as a REST API with Flask.'],
                ],
                'Conclusion & Wrap-up' => [
                    ['title' => 'Course Summary & Career Paths',           'duration' => 6,  'is_preview' => 0, 'content' => 'Recap of all topics and career options in data science.'],
                ],
            ],

            'SQL & Database Design – Complete Bootcamp 2025' => [
                'Introduction to Databases' => [
                    ['title' => 'What is a Database & Why SQL?',           'duration' => 8,  'is_preview' => 1, 'content' => 'RDBMS concepts, SQL vs NoSQL and popular databases.'],
                    ['title' => 'Installing MySQL & MySQL Workbench',      'duration' => 10, 'is_preview' => 1, 'content' => 'Setup MySQL and Workbench for local development.'],
                ],
                'SQL Basics & Queries' => [
                    ['title' => 'CREATE, INSERT, SELECT & Data Types',     'duration' => 18, 'is_preview' => 0, 'content' => 'Creating tables, inserting rows and basic SELECT queries.'],
                    ['title' => 'UPDATE, DELETE & Constraints',            'duration' => 14, 'is_preview' => 0, 'content' => 'Updating records, deleting rows, NOT NULL and UNIQUE.'],
                ],
                'Filtering, Sorting & Aggregation' => [
                    ['title' => 'WHERE, AND, OR, NOT & LIKE',              'duration' => 16, 'is_preview' => 0, 'content' => 'Filtering rows with conditions and pattern matching.'],
                    ['title' => 'ORDER BY, LIMIT & GROUP BY',              'duration' => 14, 'is_preview' => 0, 'content' => 'Sorting results, limiting output and grouping data.'],
                    ['title' => 'Aggregate Functions – COUNT, SUM, AVG',   'duration' => 14, 'is_preview' => 0, 'content' => 'Calculating totals, averages and counts with HAVING.'],
                ],
                'Joins & Relationships' => [
                    ['title' => 'INNER, LEFT, RIGHT & FULL JOINs',        'duration' => 20, 'is_preview' => 0, 'content' => 'Combining data from multiple tables with all join types.'],
                    ['title' => 'Self Joins & UNION',                      'duration' => 14, 'is_preview' => 0, 'content' => 'Self-referencing queries and combining result sets.'],
                ],
                'Advanced SQL Concepts' => [
                    ['title' => 'Subqueries & Correlated Subqueries',      'duration' => 18, 'is_preview' => 0, 'content' => 'Nested queries and correlated subquery patterns.'],
                    ['title' => 'Views, Stored Procedures & Triggers',     'duration' => 20, 'is_preview' => 0, 'content' => 'Creating reusable database objects and triggers.'],
                    ['title' => 'Indexes & Query Optimisation',            'duration' => 16, 'is_preview' => 0, 'content' => 'Index types, EXPLAIN plan and query performance.'],
                ],
                'Database Design & Normalization' => [
                    ['title' => 'ER Diagrams & Relationships',             'duration' => 16, 'is_preview' => 0, 'content' => 'One-to-one, one-to-many, many-to-many and ER modelling.'],
                    ['title' => '1NF, 2NF & 3NF Normalization',           'duration' => 18, 'is_preview' => 0, 'content' => 'Normalization theory and applying it to real schemas.'],
                ],
                'Hands-on Project' => [
                    ['title' => 'Project: E-Commerce Database Design',     'duration' => 20, 'is_preview' => 1, 'content' => 'Design the schema for a full e-commerce platform.'],
                    ['title' => 'Project: Complex Queries & Reports',      'duration' => 22, 'is_preview' => 0, 'content' => 'Write advanced queries to generate business reports.'],
                ],
                'Conclusion & Next Steps' => [
                    ['title' => 'PostgreSQL vs MySQL Differences',         'duration' => 10, 'is_preview' => 0, 'content' => 'Key differences and when to choose each database.'],
                    ['title' => 'Course Summary & Career Resources',       'duration' => 5,  'is_preview' => 0, 'content' => 'Recap and resources to continue your SQL journey.'],
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // CLOUD & DEVOPS
            // ════════════════════════════════════════════════════════════════

            'AWS Certified Solutions Architect – Associate 2025' => [
                'Getting Started' => [
                    ['title' => 'AWS Overview & Free Tier Account Setup',  'duration' => 10, 'is_preview' => 1, 'content' => 'Create account, billing alerts, IAM admin user and AWS CLI.'],
                    ['title' => 'AWS Global Infrastructure',               'duration' => 12, 'is_preview' => 1, 'content' => 'Regions, Availability Zones and Edge Locations explained.'],
                ],
                'IAM & Security' => [
                    ['title' => 'IAM – Users, Groups, Policies & Roles',  'duration' => 22, 'is_preview' => 0, 'content' => 'IAM best practices, policy JSON, service roles and cross-account.'],
                    ['title' => 'AWS Security – KMS, CloudTrail & Config', 'duration' => 18, 'is_preview' => 0, 'content' => 'Key Management Service, audit logging and compliance.'],
                ],
                'Compute – EC2 & Lambda' => [
                    ['title' => 'EC2 – Instances, AMIs & Security Groups', 'duration' => 24, 'is_preview' => 0, 'content' => 'Launch instances, instance types, key pairs and security groups.'],
                    ['title' => 'Auto Scaling & Elastic Load Balancing',   'duration' => 20, 'is_preview' => 0, 'content' => 'Launch templates, target groups and ALB/NLB.'],
                    ['title' => 'Lambda & Serverless Architecture',        'duration' => 20, 'is_preview' => 0, 'content' => 'Triggers, execution roles, cold starts and Lambda layers.'],
                ],
                'Storage – S3 & EBS' => [
                    ['title' => 'S3 – Buckets, Objects & Storage Classes', 'duration' => 20, 'is_preview' => 0, 'content' => 'Creating buckets, lifecycle policies and storage class tiers.'],
                    ['title' => 'EBS, EFS & Storage Gateway',             'duration' => 16, 'is_preview' => 0, 'content' => 'Block vs file storage and hybrid storage solutions.'],
                ],
                'Databases – RDS & DynamoDB' => [
                    ['title' => 'RDS & Aurora – Managed Databases',       'duration' => 18, 'is_preview' => 0, 'content' => 'Multi-AZ, read replicas, automated backups, Aurora serverless.'],
                    ['title' => 'DynamoDB – NoSQL at Scale',              'duration' => 18, 'is_preview' => 0, 'content' => 'Tables, indexes, capacity modes and DynamoDB Streams.'],
                ],
                'Networking – VPC & Route 53' => [
                    ['title' => 'VPC – Subnets, Route Tables & Gateways', 'duration' => 22, 'is_preview' => 0, 'content' => 'Building a custom VPC with public/private subnets.'],
                    ['title' => 'Route 53, CloudFront & API Gateway',     'duration' => 18, 'is_preview' => 0, 'content' => 'DNS routing policies, CDN caching and API management.'],
                ],
                'Exam Prep & Practice Tests' => [
                    ['title' => 'Exam Tips & Key Service Summary',        'duration' => 14, 'is_preview' => 0, 'content' => 'High-frequency exam topics and must-know service limits.'],
                    ['title' => 'Practice Exam 1 – Walkthrough',          'duration' => 30, 'is_preview' => 1, 'content' => '65-question practice exam with answer explanations.'],
                    ['title' => 'Practice Exam 2 – Walkthrough',          'duration' => 30, 'is_preview' => 0, 'content' => 'Second full practice test with detailed breakdown.'],
                ],
            ],

            'Docker & Kubernetes: The Complete Practical Guide' => [
                'Getting Started' => [
                    ['title' => 'What are Containers & Why Docker?',      'duration' => 8,  'is_preview' => 1, 'content' => 'VMs vs containers, Docker daemon, CLI and Desktop setup.'],
                    ['title' => 'Running Your First Container',            'duration' => 10, 'is_preview' => 1, 'content' => 'docker run, docker ps, docker images and basic commands.'],
                ],
                'Docker Fundamentals' => [
                    ['title' => 'Dockerfile – Building Custom Images',    'duration' => 18, 'is_preview' => 0, 'content' => 'FROM, RUN, COPY, WORKDIR, EXPOSE, CMD and image layers.'],
                    ['title' => 'Volumes & Bind Mounts',                  'duration' => 16, 'is_preview' => 0, 'content' => 'Persisting data with named volumes and bind mounts.'],
                    ['title' => 'Docker Networking',                      'duration' => 14, 'is_preview' => 0, 'content' => 'Bridge, host and custom networks for container communication.'],
                ],
                'Docker Compose & Networking' => [
                    ['title' => 'Docker Compose – Multi-Container Apps',  'duration' => 20, 'is_preview' => 0, 'content' => 'Writing docker-compose.yml, services, depends_on and env files.'],
                    ['title' => 'Docker Compose – Production Patterns',   'duration' => 16, 'is_preview' => 0, 'content' => 'Overrides, environment-specific configs and health checks.'],
                ],
                'Kubernetes Architecture' => [
                    ['title' => 'Kubernetes Architecture & Core Concepts', 'duration' => 22, 'is_preview' => 0, 'content' => 'Cluster, control plane, nodes, Pods and services.'],
                    ['title' => 'kubectl – Managing the Cluster',         'duration' => 18, 'is_preview' => 0, 'content' => 'apply, get, describe, logs, exec and port-forward.'],
                ],
                'Kubernetes in Practice' => [
                    ['title' => 'Deployments, ReplicaSets & Rolling Updates', 'duration' => 20, 'is_preview' => 0, 'content' => 'Scaling, rolling updates and rollback strategies.'],
                    ['title' => 'Services, Ingress & Load Balancing',     'duration' => 18, 'is_preview' => 0, 'content' => 'ClusterIP, NodePort, LoadBalancer and Ingress controllers.'],
                    ['title' => 'ConfigMaps, Secrets & Persistent Volumes', 'duration' => 16, 'is_preview' => 0, 'content' => 'Externalising configuration and handling secrets securely.'],
                ],
                'Production Deployment' => [
                    ['title' => 'Deploying to AWS EKS',                   'duration' => 20, 'is_preview' => 0, 'content' => 'Provisioning and deploying to Amazon Elastic Kubernetes Service.'],
                    ['title' => 'Monitoring with Prometheus & Grafana',   'duration' => 16, 'is_preview' => 0, 'content' => 'Installing Prometheus, scraping metrics and Grafana dashboards.'],
                ],
                'Conclusion & Next Steps' => [
                    ['title' => 'Course Summary & Resources',             'duration' => 5,  'is_preview' => 0, 'content' => 'Recap and recommended next steps for Docker/K8s mastery.'],
                ],
            ],

            'CI/CD with GitHub Actions – DevOps for Developers' => [
                'Getting Started' => [
                    ['title' => 'What is CI/CD & Why GitHub Actions?',    'duration' => 8,  'is_preview' => 1, 'content' => 'CI/CD concepts, GitHub Actions vs Jenkins/CircleCI.'],
                    ['title' => 'Your First Workflow',                     'duration' => 10, 'is_preview' => 1, 'content' => 'Creating .github/workflows/main.yml and understanding YAML syntax.'],
                ],
                'GitHub Actions Fundamentals' => [
                    ['title' => 'Triggers – Events, Schedules & Manual',  'duration' => 14, 'is_preview' => 0, 'content' => 'push, pull_request, schedule and workflow_dispatch triggers.'],
                    ['title' => 'Jobs, Steps & Runners',                  'duration' => 16, 'is_preview' => 0, 'content' => 'Job structure, ubuntu/windows/mac runners and matrix builds.'],
                    ['title' => 'Using Actions from the Marketplace',     'duration' => 12, 'is_preview' => 0, 'content' => 'Popular actions, checkout, setup-node and caching dependencies.'],
                ],
                'Building CI Pipelines' => [
                    ['title' => 'Linting & Code Quality Checks',          'duration' => 14, 'is_preview' => 0, 'content' => 'ESLint, Prettier and running linters in CI.'],
                    ['title' => 'Running Tests Automatically',            'duration' => 16, 'is_preview' => 0, 'content' => 'Running Jest, PHPUnit and other test suites in workflows.'],
                ],
                'Automated Testing' => [
                    ['title' => 'Test Reports & Code Coverage',           'duration' => 14, 'is_preview' => 0, 'content' => 'Generating coverage reports and uploading to Codecov.'],
                    ['title' => 'Environment Variables & Secrets',        'duration' => 12, 'is_preview' => 0, 'content' => 'Managing secrets securely in GitHub Actions.'],
                ],
                'CD – Deploying to AWS & Docker' => [
                    ['title' => 'Build & Push Docker Images',             'duration' => 18, 'is_preview' => 0, 'content' => 'Build Docker images and push to Docker Hub or ECR.'],
                    ['title' => 'Deploy to AWS EC2 via SSH',              'duration' => 20, 'is_preview' => 0, 'content' => 'SSH-based deployment with rollback on failure.'],
                    ['title' => 'Deploy to AWS ECS / App Runner',         'duration' => 18, 'is_preview' => 0, 'content' => 'Container-based deployment to managed AWS services.'],
                ],
                'Advanced Workflows' => [
                    ['title' => 'Reusable Workflows & Composite Actions', 'duration' => 16, 'is_preview' => 0, 'content' => 'Sharing workflow logic across repositories.'],
                    ['title' => 'Monorepo CI Strategies',                 'duration' => 14, 'is_preview' => 0, 'content' => 'Path-based triggers and affected package detection.'],
                    ['title' => 'Course Summary & Next Steps',            'duration' => 5,  'is_preview' => 0, 'content' => 'Recap and what to explore next in DevOps.'],
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // CYBER SECURITY
            // ════════════════════════════════════════════════════════════════

            'The Complete Ethical Hacking Course – Beginner to Advanced' => [
                'Getting Started' => [
                    ['title' => 'Intro to Ethical Hacking & Pen Testing',  'duration' => 8,  'is_preview' => 1, 'content' => 'Bug bounty, pen testing phases, legal framework and ethics.'],
                    ['title' => 'Setting Up Kali Linux Lab',               'duration' => 12, 'is_preview' => 1, 'content' => 'Installing Kali Linux on VirtualBox/VMware and lab setup.'],
                ],
                'Networking Fundamentals' => [
                    ['title' => 'Networking Fundamentals for Hackers',     'duration' => 20, 'is_preview' => 0, 'content' => 'OSI model, TCP/IP, common ports and Wireshark analysis.'],
                    ['title' => 'Reconnaissance – Passive & Active',       'duration' => 18, 'is_preview' => 0, 'content' => 'OSINT, Google dorks, Shodan and Nmap scanning.'],
                ],
                'Reconnaissance & Scanning' => [
                    ['title' => 'Nmap Advanced Scanning Techniques',       'duration' => 18, 'is_preview' => 0, 'content' => 'Port scanning, service detection and NSE scripts.'],
                    ['title' => 'Vulnerability Scanning with Nessus',      'duration' => 16, 'is_preview' => 0, 'content' => 'Setting up Nessus, running scans and interpreting results.'],
                ],
                'Exploitation & Post-Exploitation' => [
                    ['title' => 'Exploitation with Metasploit Framework',  'duration' => 24, 'is_preview' => 0, 'content' => 'Modules, payloads, sessions and post-exploitation.'],
                    ['title' => 'Password Cracking – Hashcat & John',      'duration' => 18, 'is_preview' => 0, 'content' => 'Hash cracking, brute force, wordlists and rainbow tables.'],
                    ['title' => 'Privilege Escalation – Linux & Windows',  'duration' => 20, 'is_preview' => 0, 'content' => 'SUID, sudo misconfigs, Windows token impersonation.'],
                ],
                'Web Application Hacking' => [
                    ['title' => 'OWASP Top 10 Overview',                  'duration' => 14, 'is_preview' => 0, 'content' => 'Understanding the most critical web vulnerabilities.'],
                    ['title' => 'SQL Injection & XSS Hands-on',           'duration' => 22, 'is_preview' => 0, 'content' => 'Exploiting injection and scripting vulns in DVWA.'],
                ],
                'Wi-Fi & Wireless Attacks' => [
                    ['title' => 'WPA2 Cracking & Evil Twin Attacks',      'duration' => 18, 'is_preview' => 0, 'content' => 'Capturing handshakes and setting up rogue APs.'],
                    ['title' => 'Bluetooth & RFID Security',              'duration' => 14, 'is_preview' => 0, 'content' => 'Bluetooth sniffing and RFID cloning basics.'],
                ],
                'Reporting & Conclusion' => [
                    ['title' => 'Writing Professional Pen Test Reports',  'duration' => 14, 'is_preview' => 0, 'content' => 'Report structure, severity ratings and recommendations.'],
                    ['title' => 'Bug Bounty Hunting Tips & Platforms',    'duration' => 10, 'is_preview' => 0, 'content' => 'HackerOne, Bugcrowd and maximizing bounty earnings.'],
                    ['title' => 'Course Summary & Certifications Guide',  'duration' => 6,  'is_preview' => 0, 'content' => 'CEH, OSCP and other certifications to pursue.'],
                ],
            ],

            'Web Application Penetration Testing – OWASP Top 10' => [
                'Getting Started' => [
                    ['title' => 'Web Pen Testing Intro & Methodology',    'duration' => 8,  'is_preview' => 1, 'content' => 'Pen testing methodology, scope, rules of engagement.'],
                ],
                'Setting Up the Lab' => [
                    ['title' => 'Installing Burp Suite & Configuring Proxy', 'duration' => 14, 'is_preview' => 1, 'content' => 'Setting up Burp Suite Community Edition and browser proxy.'],
                    ['title' => 'Vulnerable Apps – DVWA & Juice Shop',   'duration' => 12, 'is_preview' => 0, 'content' => 'Installing DVWA and OWASP Juice Shop for practice.'],
                ],
                'Injection Attacks – SQL & Command' => [
                    ['title' => 'SQL Injection – Detection & Exploitation', 'duration' => 24, 'is_preview' => 0, 'content' => 'Manual SQLi, error-based, blind and time-based injection.'],
                    ['title' => 'Command Injection & Path Traversal',      'duration' => 18, 'is_preview' => 0, 'content' => 'OS command injection and directory traversal attacks.'],
                ],
                'Authentication & Session Vulnerabilities' => [
                    ['title' => 'Broken Authentication & Session Hijacking', 'duration' => 20, 'is_preview' => 0, 'content' => 'Weak credentials, session fixation and cookie theft.'],
                    ['title' => 'Brute Forcing with Burp Intruder',       'duration' => 16, 'is_preview' => 0, 'content' => 'Credential stuffing and rate limiting bypass.'],
                ],
                'XSS, CSRF & Broken Access Control' => [
                    ['title' => 'XSS – Reflected, Stored & DOM-Based',   'duration' => 22, 'is_preview' => 0, 'content' => 'All XSS types, payload crafting and CSP bypass.'],
                    ['title' => 'CSRF & Clickjacking Attacks',            'duration' => 16, 'is_preview' => 0, 'content' => 'CSRF tokens, SameSite cookies and frame busting.'],
                    ['title' => 'Broken Access Control & IDOR',          'duration' => 18, 'is_preview' => 0, 'content' => 'Insecure direct object references and privilege escalation.'],
                ],
                'Advanced Testing with Burp Suite' => [
                    ['title' => 'Burp Scanner & Active Scanning',         'duration' => 16, 'is_preview' => 0, 'content' => 'Configuring and running Burp Suite active scanner.'],
                    ['title' => 'API Security Testing',                   'duration' => 18, 'is_preview' => 0, 'content' => 'Testing REST and GraphQL APIs for vulnerabilities.'],
                ],
                'Reporting & Conclusion' => [
                    ['title' => 'Writing Web Pen Test Reports',           'duration' => 12, 'is_preview' => 0, 'content' => 'Executive summary, findings, CVSS scores and remediations.'],
                    ['title' => 'Course Wrap-up & Next Steps',            'duration' => 5,  'is_preview' => 0, 'content' => 'OSCP, eWPT and other certifications to consider.'],
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // DESIGN
            // ════════════════════════════════════════════════════════════════

            'UI/UX Design Bootcamp – Figma, Prototyping & Research' => [
                'Getting Started' => [
                    ['title' => 'What is UX Design? The Design Process',  'duration' => 7,  'is_preview' => 1, 'content' => 'User-centred design, double diamond and the 5-stage design process.'],
                    ['title' => 'Setting Up Figma – Interface Tour',      'duration' => 10, 'is_preview' => 1, 'content' => 'Figma workspace, frames, layers, assets and shortcuts.'],
                ],
                'Design Principles & Theory' => [
                    ['title' => 'Design Principles – Color, Type & Space', 'duration' => 18, 'is_preview' => 0, 'content' => 'Colour theory, type hierarchy, whitespace and visual rhythm.'],
                    ['title' => 'Gestalt Principles & Visual Hierarchy',  'duration' => 14, 'is_preview' => 0, 'content' => 'Proximity, similarity, contrast and visual flow.'],
                ],
                'Figma Essentials' => [
                    ['title' => 'Figma Basics – Shapes, Text & Images',   'duration' => 16, 'is_preview' => 0, 'content' => 'Vector tools, Boolean operations, fills and masks.'],
                    ['title' => 'Components, Variants & Auto Layout',     'duration' => 20, 'is_preview' => 0, 'content' => 'Reusable components, responsive auto layout and variants.'],
                    ['title' => 'Design Systems & Style Guides',           'duration' => 18, 'is_preview' => 0, 'content' => 'Building a cohesive design system with tokens.'],
                ],
                'User Research & Information Architecture' => [
                    ['title' => 'User Research – Interviews & Surveys',   'duration' => 18, 'is_preview' => 0, 'content' => 'Research methods, interview scripts and affinity mapping.'],
                    ['title' => 'Information Architecture & User Flows',  'duration' => 16, 'is_preview' => 0, 'content' => 'Site maps, user flow diagrams and journey mapping.'],
                ],
                'Wireframing & Prototyping' => [
                    ['title' => 'Wireframing – Lo-Fi to Hi-Fi',           'duration' => 18, 'is_preview' => 0, 'content' => 'Paper sketches, wireframes and moving to high-fidelity.'],
                    ['title' => 'Interactive Prototyping in Figma',       'duration' => 20, 'is_preview' => 0, 'content' => 'Links, overlays, smart animate and prototype flows.'],
                    ['title' => 'Usability Testing & Iteration',          'duration' => 16, 'is_preview' => 0, 'content' => 'Running tests, analysing feedback and iterating designs.'],
                ],
                'Real-World Design Project' => [
                    ['title' => 'Project: Mobile App – Research & Wireframes', 'duration' => 20, 'is_preview' => 1, 'content' => 'Research phase and wireframes for a mobile app.'],
                    ['title' => 'Project: Hi-Fi Design & Prototype',      'duration' => 25, 'is_preview' => 0, 'content' => 'Complete high-fidelity design with interactive prototype.'],
                ],
                'Conclusion & Career Tips' => [
                    ['title' => 'Building Your UX Portfolio',             'duration' => 12, 'is_preview' => 0, 'content' => 'Portfolio structure, case studies and Behance/Dribbble.'],
                    ['title' => 'Course Summary & Job Search Tips',       'duration' => 6,  'is_preview' => 0, 'content' => 'Landing your first UX design role.'],
                ],
            ],

            'Adobe Photoshop CC – The Complete Beginners Guide 2025' => [
                'Getting Started' => [
                    ['title' => 'Photoshop Interface Tour',               'duration' => 8,  'is_preview' => 1, 'content' => 'Workspace, panels, toolbar and document setup.'],
                    ['title' => 'Opening, Saving & File Formats',        'duration' => 6,  'is_preview' => 1, 'content' => 'PSD, JPEG, PNG, TIFF and export options.'],
                ],
                'Core Tools & Interface' => [
                    ['title' => 'Selection Tools – Quick Select & Lasso', 'duration' => 18, 'is_preview' => 0, 'content' => 'Making precise selections and refining edges.'],
                    ['title' => 'Transform, Crop & Warp',                 'duration' => 14, 'is_preview' => 0, 'content' => 'Resizing, rotating, perspective and warp transforms.'],
                ],
                'Layers, Masks & Blending' => [
                    ['title' => 'Layers Panel – Stacking, Groups & Lock', 'duration' => 16, 'is_preview' => 0, 'content' => 'Layer stacking, groups, locking and naming.'],
                    ['title' => 'Layer Masks & Clipping Masks',           'duration' => 18, 'is_preview' => 0, 'content' => 'Non-destructive masking for compositing.'],
                    ['title' => 'Blend Modes & Adjustment Layers',       'duration' => 20, 'is_preview' => 0, 'content' => 'Multiply, Screen, Overlay and hue/saturation adjustments.'],
                ],
                'Photo Retouching & Manipulation' => [
                    ['title' => 'Healing Brush, Clone Stamp & Spot Heal', 'duration' => 16, 'is_preview' => 0, 'content' => 'Removing blemishes, objects and background cleanup.'],
                    ['title' => 'Frequency Separation & Skin Retouching', 'duration' => 18, 'is_preview' => 0, 'content' => 'Professional skin retouching technique.'],
                    ['title' => 'Background Removal & Compositing',      'duration' => 16, 'is_preview' => 0, 'content' => 'Removing backgrounds and combining multiple images.'],
                ],
                'Typography & Graphic Design' => [
                    ['title' => 'Text Layers, Fonts & Paragraph Styles', 'duration' => 14, 'is_preview' => 0, 'content' => 'Adding and styling text, font pairing and hierarchy.'],
                    ['title' => 'Creating Social Media Graphics',        'duration' => 16, 'is_preview' => 0, 'content' => 'Instagram posts, thumbnails and banner design.'],
                ],
                'Real-World Project' => [
                    ['title' => 'Project: Product Photo Retouching',     'duration' => 20, 'is_preview' => 1, 'content' => 'Professional e-commerce product photo editing.'],
                    ['title' => 'Project: Digital Art Composition',      'duration' => 22, 'is_preview' => 0, 'content' => 'Create a cinematic photo manipulation from multiple images.'],
                ],
                'Exporting & Conclusion' => [
                    ['title' => 'Exporting for Web, Print & Social',     'duration' => 8,  'is_preview' => 0, 'content' => 'Export As, Save for Web and correct colour profiles.'],
                    ['title' => 'Course Summary & Next Steps',           'duration' => 5,  'is_preview' => 0, 'content' => 'Recap and your recommended Photoshop learning path.'],
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // BUSINESS & FINANCE
            // ════════════════════════════════════════════════════════════════

            'Digital Marketing Masterclass – 23 Courses in 1' => [
                'Getting Started' => [
                    ['title' => 'Digital Marketing Overview & Strategy',  'duration' => 8,  'is_preview' => 1, 'content' => 'Key channels, customer journey and building a marketing plan.'],
                ],
                'SEO & Content Marketing' => [
                    ['title' => 'SEO Fundamentals & Keyword Research',   'duration' => 20, 'is_preview' => 0, 'content' => 'On-page SEO, meta tags, keyword intent and ranking factors.'],
                    ['title' => 'Content Marketing Strategy & Blogging', 'duration' => 16, 'is_preview' => 0, 'content' => 'Creating valuable content, editorial calendar and distribution.'],
                ],
                'Social Media Marketing' => [
                    ['title' => 'Instagram & TikTok Growth Strategy',    'duration' => 18, 'is_preview' => 0, 'content' => 'Reels, hashtags, content strategy and algorithm tips.'],
                    ['title' => 'LinkedIn & Twitter for Business',        'duration' => 14, 'is_preview' => 0, 'content' => 'B2B strategy, thought leadership and community building.'],
                ],
                'Email Marketing' => [
                    ['title' => 'Email Marketing with Mailchimp',        'duration' => 16, 'is_preview' => 0, 'content' => 'Building lists, designing campaigns and automation sequences.'],
                    ['title' => 'Email Copywriting & A/B Testing',       'duration' => 14, 'is_preview' => 0, 'content' => 'Subject lines, CTAs, open rates and split testing.'],
                ],
                'Google Ads & PPC' => [
                    ['title' => 'Google Ads – Search Campaigns',         'duration' => 22, 'is_preview' => 0, 'content' => 'Campaign structure, bidding strategies and ad copy.'],
                    ['title' => 'Google Ads – Display & Shopping Ads',  'duration' => 18, 'is_preview' => 0, 'content' => 'Display targeting, remarketing and Shopping campaigns.'],
                ],
                'Facebook & Instagram Ads' => [
                    ['title' => 'Facebook Ads Manager – Setup & Basics', 'duration' => 16, 'is_preview' => 0, 'content' => 'Campaign, ad set and ad structure with audience targeting.'],
                    ['title' => 'Scaling & Retargeting Campaigns',       'duration' => 18, 'is_preview' => 0, 'content' => 'Lookalike audiences, pixel events and scaling budgets.'],
                ],
                'Analytics & Reporting' => [
                    ['title' => 'Google Analytics 4 – Complete Guide',   'duration' => 20, 'is_preview' => 0, 'content' => 'GA4 setup, events, conversions and exploration reports.'],
                    ['title' => 'Data-Driven Marketing Decisions',        'duration' => 14, 'is_preview' => 0, 'content' => 'KPIs, attribution models and building dashboards.'],
                ],
                'Conclusion & Strategy' => [
                    ['title' => 'Building Your Full Digital Marketing Plan', 'duration' => 12, 'is_preview' => 0, 'content' => 'Integrate all channels into a cohesive marketing strategy.'],
                    ['title' => 'Course Summary & Certification Tips',   'duration' => 5,  'is_preview' => 0, 'content' => 'Google, Meta and HubSpot certifications guide.'],
                ],
            ],

            'The Complete Financial Analyst Course 2025' => [
                'Getting Started' => [
                    ['title' => 'What Do Financial Analysts Do?',         'duration' => 8,  'is_preview' => 1, 'content' => 'Roles in investment banking, equity research and FP&A.'],
                ],
                'Accounting & Financial Statements' => [
                    ['title' => 'Income Statement & Revenue Recognition', 'duration' => 18, 'is_preview' => 0, 'content' => 'Reading income statements, EBITDA and margins.'],
                    ['title' => 'Balance Sheet & Cash Flow Statement',   'duration' => 20, 'is_preview' => 0, 'content' => 'Assets, liabilities, equity and cash flow from operations.'],
                ],
                'Financial Modelling in Excel' => [
                    ['title' => 'Excel for Finance – Essential Functions', 'duration' => 20, 'is_preview' => 0, 'content' => 'IF, VLOOKUP, INDEX/MATCH, NPV, IRR and pivot tables.'],
                    ['title' => 'Building a 3-Statement Model',           'duration' => 28, 'is_preview' => 0, 'content' => 'Linking income statement, balance sheet and cash flow model.'],
                ],
                'Valuation Methods' => [
                    ['title' => 'DCF Valuation – Discounted Cash Flow',   'duration' => 24, 'is_preview' => 0, 'content' => 'Free cash flow, WACC, terminal value and sensitivity analysis.'],
                    ['title' => 'Comparable Companies & Precedent Transactions', 'duration' => 20, 'is_preview' => 0, 'content' => 'EV/EBITDA multiples, comps analysis and M&A multiples.'],
                ],
                'Investment Banking Basics' => [
                    ['title' => 'M&A Process & LBO Modelling',           'duration' => 22, 'is_preview' => 0, 'content' => 'Deal structure, accretion/dilution and LBO waterfall.'],
                    ['title' => 'Pitch Books & Presentations',            'duration' => 14, 'is_preview' => 0, 'content' => 'Building investment banking pitch decks in PowerPoint.'],
                ],
                'Real-World Case Study' => [
                    ['title' => 'Case Study: Valuing a Real Company',    'duration' => 28, 'is_preview' => 1, 'content' => 'End-to-end valuation of a publicly traded company.'],
                ],
                'Conclusion & Career Tips' => [
                    ['title' => 'CFA & Financial Certifications Guide',  'duration' => 10, 'is_preview' => 0, 'content' => 'CFA, CPA, CMA and other credentials explained.'],
                    ['title' => 'Course Summary & Interview Prep',       'duration' => 8,  'is_preview' => 0, 'content' => 'Technical interview questions and how to answer them.'],
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // MORE WEB DEVELOPMENT
            // ════════════════════════════════════════════════════════════════

            'Python Bootcamp 2025: Zero to Hero in Python' => [
                'Getting Started' => [
                    ['title' => 'Python Introduction & Installation',     'duration' => 6,  'is_preview' => 1, 'content' => 'Why Python, installing Python 3.12 and using IDLE/VS Code.'],
                    ['title' => 'Running Your First Python Script',      'duration' => 7,  'is_preview' => 1, 'content' => 'Hello World, print() function and code execution.'],
                ],
                'Core Fundamentals' => [
                    ['title' => 'Variables, Data Types & String Methods', 'duration' => 16, 'is_preview' => 0, 'content' => 'int, float, str, bool and essential string operations.'],
                    ['title' => 'Conditional Statements & Loops',        'duration' => 18, 'is_preview' => 0, 'content' => 'if/elif/else, for loops, while loops and break/continue.'],
                    ['title' => 'Functions, Arguments & Return Values',  'duration' => 20, 'is_preview' => 0, 'content' => 'Defining functions, *args, **kwargs and lambda.'],
                ],
                'Data Structures & Functions' => [
                    ['title' => 'Lists, Tuples & List Comprehensions',   'duration' => 18, 'is_preview' => 0, 'content' => 'Creating, slicing, iterating and list comprehensions.'],
                    ['title' => 'Dictionaries & Sets',                   'duration' => 16, 'is_preview' => 0, 'content' => 'Key-value pairs, dict methods, sets and set operations.'],
                ],
                'Object-Oriented Programming' => [
                    ['title' => 'Classes, Objects & the __init__ Method', 'duration' => 20, 'is_preview' => 0, 'content' => 'Defining classes, instance variables and methods.'],
                    ['title' => 'Inheritance & Polymorphism',            'duration' => 18, 'is_preview' => 0, 'content' => 'Extending classes, super(), method overriding and duck typing.'],
                ],
                'File Handling & Modules' => [
                    ['title' => 'Reading & Writing Files',               'duration' => 14, 'is_preview' => 0, 'content' => 'open(), read/write/append modes, with statement and JSON files.'],
                    ['title' => 'Python Standard Library & pip',         'duration' => 12, 'is_preview' => 0, 'content' => 'os, datetime, random modules and installing third-party packages.'],
                ],
                'Building Real Projects' => [
                    ['title' => 'Project: Contact Book CLI App',         'duration' => 20, 'is_preview' => 1, 'content' => 'Build a command-line contact manager with file persistence.'],
                    ['title' => 'Project: Web Scraper with Requests & BeautifulSoup', 'duration' => 22, 'is_preview' => 0, 'content' => 'Scrape a website and save structured data to CSV.'],
                    ['title' => 'Project: REST API with FastAPI',        'duration' => 24, 'is_preview' => 0, 'content' => 'Build a simple REST API with FastAPI and deploy it.'],
                ],
                'Conclusion & Next Steps' => [
                    ['title' => 'Course Summary & Learning Paths',       'duration' => 6,  'is_preview' => 0, 'content' => 'Recap and recommended paths: data science, web dev, automation.'],
                ],
            ],

            'Django 4 – Full Stack Web Development with Python' => [
                'Getting Started' => [
                    ['title' => 'Django Introduction & Project Setup',   'duration' => 8,  'is_preview' => 1, 'content' => 'Django MTV pattern and creating your first project.'],
                    ['title' => 'Apps, URLs & Views',                    'duration' => 12, 'is_preview' => 1, 'content' => 'Creating apps, URL routing and function-based views.'],
                ],
                'Core Fundamentals' => [
                    ['title' => 'URL Patterns, Parameters & Namespacing', 'duration' => 16, 'is_preview' => 0, 'content' => 'URL conf, dynamic URLs and app namespacing.'],
                    ['title' => 'Class-Based Views (CBVs)',               'duration' => 18, 'is_preview' => 0, 'content' => 'ListView, DetailView, CreateView and mixins.'],
                ],
                'Templates & Static Files' => [
                    ['title' => 'Django Templates & Template Inheritance', 'duration' => 16, 'is_preview' => 0, 'content' => 'Template tags, filters, extends and include.'],
                    ['title' => 'Static & Media Files',                   'duration' => 12, 'is_preview' => 0, 'content' => 'Serving CSS/JS and handling uploaded media files.'],
                ],
                'Models, ORM & Database' => [
                    ['title' => 'Django Models & Migrations',             'duration' => 18, 'is_preview' => 0, 'content' => 'Defining models, field types and running migrations.'],
                    ['title' => 'ORM Queries – Filter, Annotate & Select', 'duration' => 20, 'is_preview' => 0, 'content' => 'Querying the database with the Django ORM.'],
                    ['title' => 'Django Admin Panel Customisation',       'duration' => 14, 'is_preview' => 0, 'content' => 'Registering models and customising the admin interface.'],
                ],
                'Authentication & Authorization' => [
                    ['title' => 'Django Auth – Login, Logout & Register', 'duration' => 18, 'is_preview' => 0, 'content' => 'Built-in auth views, forms and user model.'],
                    ['title' => 'Custom User Model & Permissions',        'duration' => 16, 'is_preview' => 0, 'content' => 'Extending the user model and assigning permissions.'],
                ],
                'REST APIs with Django REST Framework' => [
                    ['title' => 'DRF Serializers & ViewSets',            'duration' => 20, 'is_preview' => 0, 'content' => 'ModelSerializer, ViewSet and router registration.'],
                    ['title' => 'DRF Authentication & Permissions',      'duration' => 16, 'is_preview' => 0, 'content' => 'JWT auth with SimpleJWT and custom permission classes.'],
                ],
                'Building a Real Project' => [
                    ['title' => 'Project: E-Commerce Store – Models & Views', 'duration' => 28, 'is_preview' => 1, 'content' => 'Products, cart, orders and admin dashboard.'],
                    ['title' => 'Project: Payment Integration & Checkout', 'duration' => 24, 'is_preview' => 0, 'content' => 'Stripe integration, webhooks and order confirmation.'],
                ],
                'Deployment & Conclusion' => [
                    ['title' => 'Deploying Django to Railway / Render',  'duration' => 18, 'is_preview' => 0, 'content' => 'Environment variables, WhiteNoise and PostgreSQL in production.'],
                    ['title' => 'Course Summary & Next Steps',           'duration' => 5,  'is_preview' => 0, 'content' => 'Recap and what to build next with Django.'],
                ],
            ],

            'WordPress for Beginners: Create a Website Step by Step' => [
                'Getting Started' => [
                    ['title' => 'WordPress.com vs WordPress.org',        'duration' => 6,  'is_preview' => 1, 'content' => 'Differences, hosting options and choosing the right setup.'],
                    ['title' => 'Hosting Setup & WordPress Installation', 'duration' => 10, 'is_preview' => 1, 'content' => 'Buying hosting, domain setup and one-click install.'],
                ],
                'WordPress Dashboard & Settings' => [
                    ['title' => 'Dashboard Overview & General Settings', 'duration' => 10, 'is_preview' => 0, 'content' => 'Navigation, reading settings, permalinks and user accounts.'],
                    ['title' => 'Posts vs Pages & Menu Setup',           'duration' => 12, 'is_preview' => 0, 'content' => 'Creating content, categories, tags and navigation menus.'],
                ],
                'Themes & Customisation' => [
                    ['title' => 'Choosing & Installing Themes',          'duration' => 12, 'is_preview' => 0, 'content' => 'Free and premium themes from the repository and ThemeForest.'],
                    ['title' => 'Customising with Elementor Page Builder', 'duration' => 20, 'is_preview' => 0, 'content' => 'Drag-and-drop page building with Elementor widgets.'],
                    ['title' => 'Full Site Editing with Gutenberg',      'duration' => 16, 'is_preview' => 0, 'content' => 'Block editor, site editor and theme.json basics.'],
                ],
                'Plugins & Functionality' => [
                    ['title' => 'Essential Plugins for Every Website',   'duration' => 14, 'is_preview' => 0, 'content' => 'Yoast SEO, Wordfence, WP Rocket and Contact Form 7.'],
                    ['title' => 'Forms, Backups & Performance Plugins',  'duration' => 12, 'is_preview' => 0, 'content' => 'UpdraftPlus, caching plugins and image optimisation.'],
                ],
                'WooCommerce & E-Commerce' => [
                    ['title' => 'Setting Up WooCommerce',               'duration' => 14, 'is_preview' => 0, 'content' => 'Installing WooCommerce, shop settings and tax configuration.'],
                    ['title' => 'Products, Categories & Payment Gateways', 'duration' => 18, 'is_preview' => 0, 'content' => 'Adding products, variations and connecting Stripe/PayPal.'],
                ],
                'SEO & Maintenance' => [
                    ['title' => 'WordPress SEO with Yoast',              'duration' => 14, 'is_preview' => 0, 'content' => 'Sitemaps, meta descriptions, schema and readability.'],
                    ['title' => 'Security & Regular Maintenance',        'duration' => 12, 'is_preview' => 0, 'content' => 'Backups, updates, malware scanning and hardening.'],
                ],
                'Launching Your Website' => [
                    ['title' => 'Pre-Launch Checklist & Going Live',     'duration' => 10, 'is_preview' => 0, 'content' => 'Final checks, speed test, SSL certificate and launch.'],
                    ['title' => 'Course Summary & Next Steps',           'duration' => 5,  'is_preview' => 0, 'content' => 'What to learn next to grow your WordPress skills.'],
                ],
            ],
        ];

        // ─── Generic fallback lessons per common section titles ──────────────
        $generic = [
            'Getting Started' => [
                ['title' => 'Course Introduction & Overview',            'duration' => 6,  'is_preview' => 1, 'content' => 'Welcome! Topics covered, prerequisites and how to use this course.'],
                ['title' => 'Environment Setup & Installation',          'duration' => 10, 'is_preview' => 1, 'content' => 'Installing tools, IDE setup and creating your first project.'],
            ],
            'Core Fundamentals' => [
                ['title' => 'Core Concepts – Part 1',                   'duration' => 18, 'is_preview' => 0, 'content' => 'Foundational concepts and theory you need before going further.'],
                ['title' => 'Core Concepts – Part 2',                   'duration' => 20, 'is_preview' => 0, 'content' => 'Continuing with essential fundamentals and hands-on practice.'],
                ['title' => 'Practical Exercises & Recap',              'duration' => 14, 'is_preview' => 0, 'content' => 'Hands-on exercises to solidify the core fundamentals.'],
            ],
            'Intermediate Concepts' => [
                ['title' => 'Intermediate Topic 1 – Deep Dive',         'duration' => 20, 'is_preview' => 0, 'content' => 'Advancing with intermediate-level concepts and scenarios.'],
                ['title' => 'Intermediate Topic 2 – Real-World Usage',  'duration' => 18, 'is_preview' => 0, 'content' => 'Complex scenarios and integrations with other tools.'],
            ],
            'Advanced Topics' => [
                ['title' => 'Advanced Patterns & Best Practices',       'duration' => 22, 'is_preview' => 0, 'content' => 'Production-level patterns and architectural best practices.'],
                ['title' => 'Performance & Optimisation',               'duration' => 18, 'is_preview' => 0, 'content' => 'Optimise for speed, memory usage and scalability.'],
            ],
            'Working with APIs' => [
                ['title' => 'REST API Fundamentals',                    'duration' => 16, 'is_preview' => 0, 'content' => 'HTTP methods, status codes, request/response structure.'],
                ['title' => 'Fetching Data & Error Handling',           'duration' => 18, 'is_preview' => 0, 'content' => 'Making API calls, handling errors and loading states.'],
            ],
            'Building a Real Project' => [
                ['title' => 'Project Setup & Architecture Planning',    'duration' => 8,  'is_preview' => 1, 'content' => 'Define requirements and plan the project architecture.'],
                ['title' => 'Building Core Features – Part 1',         'duration' => 25, 'is_preview' => 0, 'content' => 'Implement main features step by step with explanations.'],
                ['title' => 'Building Core Features – Part 2',         'duration' => 22, 'is_preview' => 0, 'content' => 'Continue building and adding more functionality.'],
                ['title' => 'Testing, Debugging & Final Polish',        'duration' => 16, 'is_preview' => 0, 'content' => 'Write tests, fix bugs and polish the final result.'],
            ],
            'Real-World Project' => [
                ['title' => 'Project Planning & Setup',                 'duration' => 8,  'is_preview' => 1, 'content' => 'Plan the project, set up the environment and scaffold the structure.'],
                ['title' => 'Implementing Core Functionality',          'duration' => 28, 'is_preview' => 0, 'content' => 'Build out the main features with clean, documented code.'],
                ['title' => 'Final Touches & Deployment',              'duration' => 18, 'is_preview' => 0, 'content' => 'Polish the project and deploy it to a live environment.'],
            ],
            'Deployment & Conclusion' => [
                ['title' => 'Deploying to Production',                  'duration' => 16, 'is_preview' => 0, 'content' => 'Step-by-step production deployment guide.'],
                ['title' => 'Monitoring & Maintenance',                 'duration' => 10, 'is_preview' => 0, 'content' => 'Logging, monitoring and maintenance strategies.'],
                ['title' => 'Course Summary & Next Steps',              'duration' => 5,  'is_preview' => 0, 'content' => 'Everything covered and your recommended learning roadmap.'],
            ],
            'Conclusion & Next Steps' => [
                ['title' => 'Course Summary & Key Takeaways',          'duration' => 6,  'is_preview' => 0, 'content' => 'Recap of everything covered in the course.'],
                ['title' => 'What to Learn Next & Resources',          'duration' => 5,  'is_preview' => 0, 'content' => 'Recommended resources, books and next steps.'],
            ],
            'Hands-on Project Build' => [
                ['title' => 'Project Setup & Requirements',             'duration' => 8,  'is_preview' => 1, 'content' => 'Gather requirements and scaffold the project.'],
                ['title' => 'Building Core Features',                   'duration' => 28, 'is_preview' => 0, 'content' => 'Implement the main features step by step.'],
                ['title' => 'Testing & Deployment',                     'duration' => 16, 'is_preview' => 0, 'content' => 'Test the project and deploy to a live server.'],
            ],
            'Publication & Conclusion' => [
                ['title' => 'Preparing for Release',                    'duration' => 12, 'is_preview' => 0, 'content' => 'Pre-release checklist, screenshots and store listing.'],
                ['title' => 'Publishing & Post-Launch',                 'duration' => 10, 'is_preview' => 0, 'content' => 'Submitting to stores and monitoring after launch.'],
            ],
        ];

        // ─── Build rows ───────────────────────────────────────────────────────
        $rows = [];

        foreach ($sections as $section) {
            $courseTitle = $section->course_title;
            $sectionTitle = $section->section_title;

            if (isset($courseLessons[$courseTitle][$sectionTitle])) {
                $lessons = $courseLessons[$courseTitle][$sectionTitle];
            } elseif (isset($generic[$sectionTitle])) {
                $lessons = $generic[$sectionTitle];
            } else {
                // Intelligent keyword-based fallback
                $lower = strtolower($sectionTitle);
                if (str_contains($lower, 'getting') || str_contains($lower, 'intro') || str_contains($lower, 'overview') || str_contains($lower, 'started')) {
                    $lessons = $generic['Getting Started'];
                } elseif (str_contains($lower, 'advanced') || str_contains($lower, 'expert')) {
                    $lessons = $generic['Advanced Topics'];
                } elseif (str_contains($lower, 'project') || str_contains($lower, 'build') || str_contains($lower, 'hands') || str_contains($lower, 'real-world') || str_contains($lower, 'capstone')) {
                    $lessons = $generic['Building a Real Project'];
                } elseif (str_contains($lower, 'deploy') || str_contains($lower, 'conclusion') || str_contains($lower, 'wrap') || str_contains($lower, 'summary')) {
                    $lessons = $generic['Deployment & Conclusion'];
                } elseif (str_contains($lower, 'api') || str_contains($lower, 'rest') || str_contains($lower, 'http')) {
                    $lessons = $generic['Working with APIs'];
                } elseif (str_contains($lower, 'intermediate')) {
                    $lessons = $generic['Intermediate Concepts'];
                } elseif (str_contains($lower, 'publish') || str_contains($lower, 'launch') || str_contains($lower, 'release')) {
                    $lessons = $generic['Publication & Conclusion'];
                } else {
                    $lessons = $generic['Core Fundamentals'];
                }
            }

            foreach ($lessons as $order => $lesson) {
                $rows[] = [
                    'section_id' => $section->section_id,
                    'title' => $lesson['title'],
                    'slug' => Str::slug($lesson['title']).'-s'.$section->section_id.'-'.($order + 1),
                    'content' => $lesson['content'],
                    'duration' => $lesson['duration'],
                    'order' => $order + 1,
                    'is_preview' => $lesson['is_preview'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('lessons')->insert($chunk);
        }

        $this->command->info('✅ '.count($rows).' lessons seeded successfully!');
    }
}
