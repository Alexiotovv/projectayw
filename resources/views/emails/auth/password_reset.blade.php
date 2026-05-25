<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AYW Password Reset</title>
</head>
<body style="margin:0;padding:0;background:#f4f6fb;font-family:Arial,sans-serif;color:#1f2937;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:620px;background:#ffffff;border-radius:10px;overflow:hidden;border:1px solid #e5e7eb;">
                    <tr>
                        <td style="background:#0f766e;padding:20px 24px;color:#ffffff;">
                            <h1 style="margin:0;font-size:22px;">AYW Solution</h1>
                            <p style="margin:6px 0 0 0;font-size:14px;opacity:0.95;">Password Recovery</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <p style="margin:0 0 12px 0;">Hi {{ $user->name ?? 'User' }},</p>
                            <p style="margin:0 0 16px 0;line-height:1.6;">
                                We received a request to reset the password for your AYW account.
                                Click the button below to create a new password.
                            </p>
                            <p style="margin:0 0 20px 0;text-align:center;">
                                <a href="{{ $resetUrl }}" style="display:inline-block;background:#0f766e;color:#ffffff;text-decoration:none;padding:12px 22px;border-radius:8px;font-weight:700;">
                                    Reset Password
                                </a>
                            </p>
                            <p style="margin:0 0 12px 0;line-height:1.6;">
                                This link expires in {{ $expireMinutes }} minutes.
                                If you did not request this change, you can ignore this email.
                            </p>
                            <p style="margin:0 0 8px 0;font-size:12px;color:#6b7280;word-break:break-all;">
                                If the button does not work, copy and paste this URL in your browser:<br>
                                {{ $resetUrl }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f9fafb;padding:14px 24px;font-size:12px;color:#6b7280;">
                            AYW Solution - Automated message, please do not reply.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
