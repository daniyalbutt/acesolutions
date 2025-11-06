<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>New Project Created</title>
        <style>
            /* For dark mode support in some clients */
            @media (prefers-color-scheme: dark) {
            body { background: #1a1a1a !important; color: #fff !important; }
            .container { background: #2b2b2b !important; }
            .btn { background: #4b8df8 !important; color:#fff !important; }
            }
        </style>
    </head>
    <body style="margin:0;padding:0;background:#f5f6fa;font-family:Arial,Helvetica,sans-serif;">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center" style="padding:20px;">
                    <!-- Email Container -->
                    <table width="600" cellpadding="0" cellspacing="0" class="container" style="background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                        <!-- Header -->
                        <tr>
                            <td style="background:#007bff;padding:15px 25px;color:#fff;font-size:20px;font-weight:bold;">
                                New Project Submitted 🚀
                            </td>
                        </tr>
                        <!-- Body -->
                        <tr>
                            <td style="padding:25px;color:#333;font-size:14px;line-height:1.6;">
                                <p>Hello Admin,</p>
                                <p>A new project has been created. Below are the details:</p>
                                <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;margin-top:10px;">
                                    <tr>
                                        <td style="background:#f0f4ff;font-weight:bold;width:180px;">Company Name</td>
                                        <td>{{ $project->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background:#f0f4ff;font-weight:bold;">Client Name</td>
                                        <td>{{ $project->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background:#f0f4ff;font-weight:bold;">Phone</td>
                                        <td>{{ $project->company_phone }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background:#f0f4ff;font-weight:bold;">Email</td>
                                        <td>{{ $project->company_email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background:#f0f4ff;font-weight:bold;">Address</td>
                                        <td>{{ $project->company_address }}</td>
                                    </tr>
                                    @if(!empty($project->description))
                                    <tr>
                                        <td style="background:#f0f4ff;font-weight:bold;">Description</td>
                                        <td>{{ $project->description }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($project->additional_notes))
                                    <tr>
                                        <td style="background:#f0f4ff;font-weight:bold;">Additional Notes</td>
                                        <td>{{ $project->additional_notes }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="background:#f0f4ff;font-weight:bold;">Submitted By</td>
                                        <td>{{ $project->user->name }} ({{ $project->user->email }})</td>
                                    </tr>
                                </table>
                                <!-- Button -->
                                <p style="margin-top:25px;text-align:center;">
                                    <a href="{{ route('projects.show', $project->id) }}"
                                        class="btn"
                                        style="background:#007bff;color:#fff;padding:12px 25px;border-radius:5px;text-decoration:none;display:inline-block;font-weight:bold;">
                                    View Project
                                    </a>
                                </p>
                                <p style="margin-top:25px;">Regards,<br><strong>{{ config('app.name') }}</strong></p>
                            </td>
                        </tr>
                        <!-- Footer -->
                        <tr>
                            <td style="background:#f8f9fa;padding:15px;text-align:center;font-size:12px;color:#777;">
                                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>