<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $getsubject ?? 'Password Reset OTP - AskReview' }}</title>
</head>
<body style="margin: 0; padding: 28px 12px; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #1e293b;">

    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 580px; background: #ffffff; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08);">
        
        <!-- Header Banner -->
        <tr>
            <td style="padding: 32px 30px 26px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); text-align: center;">
                <div style="display: inline-block; padding: 6px 14px; background: rgba(225, 29, 72, 0.2); border: 1px solid rgba(225, 29, 72, 0.4); border-radius: 9999px; margin-bottom: 14px;">
                    <span style="color: #fda4af; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;">
                        🔒 Security Verification
                    </span>
                </div>
                <h1 style="color: #ffffff; font-size: 22px; font-weight: 800; margin: 0 0 6px 0; letter-spacing: -0.02em;">
                    Password Reset Request
                </h1>
                <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                    Use the OTP below to securely reset your AskReview account password.
                </p>
            </td>
        </tr>

        <!-- Content Area -->
        <tr>
            <td style="padding: 32px 30px 24px;">
                <p style="color: #334155; font-size: 15px; line-height: 1.6; margin: 0 0 16px 0;">
                    Hello,
                </p>
                <p style="color: #475569; font-size: 14px; line-height: 1.6; margin: 0 0 24px 0;">
                    We received a request to reset the password associated with this email address on <strong>AskReview</strong>. Enter the following One-Time Password (OTP) to proceed:
                </p>

                <!-- OTP Code Display Card -->
                @if(!empty($otp))
                <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 24px;">
                    <tr>
                        <td align="center">
                            <div style="background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 20px 24px; text-align: center; max-width: 360px;">
                                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px;">
                                    Your Verification OTP
                                </div>
                                <div style="font-size: 34px; font-weight: 800; letter-spacing: 10px; color: #0f172a; font-family: 'Courier New', Courier, monospace; margin: 4px 0 8px 10px;">
                                    {{ $otp }}
                                </div>
                                <div style="font-size: 12px; color: #94a3b8;">
                                    Valid for 15 minutes • Do not share with anyone
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                @endif

                <!-- Direct Action Button -->
                <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 24px auto;">
                    <tr>
                        <td align="center" style="border-radius: 10px; background: #e11d48;">
                            <a href="{{ URL::to('confirmPasswordPage/'.$getData) }}" target="_blank" style="display: inline-block; padding: 14px 32px; font-size: 14px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 10px; letter-spacing: 0.02em;">
                                Reset Your Password →
                            </a>
                        </td>
                    </tr>
                </table>

                <p style="color: #64748b; font-size: 13px; line-height: 1.5; margin: 0 0 16px 0; text-align: center;">
                    If you are having trouble with the button, copy and paste this link in your browser:<br>
                    <a href="{{ URL::to('confirmPasswordPage/'.$getData) }}" target="_blank" style="color: #2563eb; word-break: break-all; font-size: 12px;">
                        {{ URL::to('confirmPasswordPage/'.$getData) }}
                    </a>
                </p>

                <!-- Security Note Box -->
                <div style="padding: 14px 18px; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 10px; margin-top: 24px;">
                    <div style="font-size: 12px; font-weight: 700; color: #92400e; margin-bottom: 4px;">
                        ⚠️ Didn't request this?
                    </div>
                    <div style="font-size: 12px; color: #b45309; line-height: 1.5;">
                        If you did not request a password reset, you can safely ignore this email. Your password will remain unchanged and your account is secure.
                    </div>
                </div>
            </td>
        </tr>

        <!-- Footer Area -->
        <tr>
            <td style="padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center;">
                <p style="color: #94a3b8; font-size: 12px; margin: 0 0 4px 0;">
                    © {{ date('Y') }} AskReview. All rights reserved.
                </p>
                <p style="color: #cbd5e1; font-size: 11px; margin: 0;">
                    This is an automated system email. Please do not reply directly.
                </p>
            </td>
        </tr>

    </table>

</body>
</html>
