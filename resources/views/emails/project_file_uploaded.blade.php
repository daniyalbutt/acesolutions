<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project File Uploaded</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            text-align: center;
            padding: 25px 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 30px 25px;
            line-height: 1.7;
            color: #444;
        }

        .content p {
            margin-bottom: 15px;
        }

        .highlight {
            color: #007bff;
            font-weight: 600;
        }

        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin: 20px 0;
            transition: background 0.2s ease-in-out;
        }

        .btn:hover {
            background: #0056b3;
        }

        .footer {
            background-color: #f1f3f5;
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #777;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>📁 New File Uploaded</h1>
        </div>

        <div class="content">
            <p>Hello,</p>

            <p>
                <strong class="highlight">{{ $uploadedBy->name }}</strong> has uploaded a new file to the project:
                <strong class="highlight">{{ $project->name }}</strong>.
            </p>

            <p>
                You can log in to your dashboard to review the uploaded file.
            </p>

            @isset($projectUrl)
            <p style="text-align: center;">
                <a href="{{ $projectUrl }}" class="btn" target="_blank">View Project</a>
            </p>
            @endisset

            <p>Best regards,<br><strong>{{ config('app.name') }}</strong></p>
        </div>

        <div class="footer">
            <p>This is an automated message — please do not reply.</p>
        </div>

    </div>
</body>
</html>
