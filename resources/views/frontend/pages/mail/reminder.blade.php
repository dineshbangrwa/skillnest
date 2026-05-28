<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Don't Forget Your Course</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
        }

        .header {
            background: #f59e0b;
            padding: 32px 40px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            color: #fff;
            font-size: 24px;
        }

        .header p {
            margin: 6px 0 0;
            color: #fef3c7;
            font-size: 14px;
        }

        .body {
            padding: 32px 40px;
        }

        .greeting {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .info-box {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            padding: 16px 20px;
            margin: 24px 0;
        }

        .info-box p {
            margin: 4px 0;
            font-size: 14px;
        }

        .info-box strong {
            display: inline-block;
            width: 110px;
            color: #555;
        }

        .progress-wrap {
            margin: 20px 0;
        }

        .progress-wrap p {
            font-size: 13px;
            color: #777;
            margin-bottom: 6px;
        }

        .progress-bar-bg {
            background: #e5e7eb;
            border-radius: 999px;
            height: 10px;
        }

        .progress-bar-fill {
            background: #f59e0b;
            height: 10px;
            border-radius: 999px;
            width: {{ $progress }}%;
        }

        .btn {
            display: inline-block;
            margin-top: 24px;
            padding: 13px 32px;
            background: #f59e0b;
            color: #fff !important;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
        }

        .motivation {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 6px;
            padding: 16px 20px;
            margin-top: 28px;
            font-size: 14px;
            color: #166534;
        }

        .footer {
            background: #f8fafc;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #e5e7eb;
        }

        .footer a {
            color: #f59e0b;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <div class="header">
            <h1>⏰ You Haven't Started Yet!</h1>
            <p>Your course is waiting — jump in today.</p>
        </div>

        <div class="body">
            <p class="greeting">Hi {{ $user_name }},</p>

            <p>
                We noticed you enrolled in <strong>{{ $course->title }}</strong> on {{ $enrolled_at }},
                but haven't started yet. Don't let it slip away!
            </p>

            <div class="info-box">
                <p><strong>Course:</strong> {{ $course->title }}</p>
                <p><strong>Enrolled On:</strong> {{ $enrolled_at }}</p>
                @if ($course->instructor ?? null)
                    <p><strong>Instructor:</strong> {{ $course->instructor->name }}</p>
                @endif
            </div>

            <div class="progress-wrap">
                <p>Your current progress: <strong>{{ $progress }}%</strong></p>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill"></div>
                </div>
            </div>

            <a href="{{ route('courses.show', $course->slug) }}" class="btn">Continue to My Course →</a>

            <div class="motivation">
                🌱 <strong>Did you know?</strong> Learning just <strong>15–20 minutes a day</strong>
                is enough to finish most courses within a few weeks. Start small — start today!
            </div>

            <p style="margin-top:28px; font-size:14px; color:#555;">
                Want to explore other courses too?
                <a href="{{ $explore_url }}" style="color:#f59e0b;">Browse the catalog →</a>
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br />
            You received this reminder because you enrolled but haven't started the course yet.
        </div>

    </div>
</body>

</html>
