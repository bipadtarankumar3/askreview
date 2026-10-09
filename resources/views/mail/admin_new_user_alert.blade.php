<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Registration Alert - AskReview</title>
</head>
<body style="margin: 0; padding: 28px 12px; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #1e293b;">

    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; background: #ffffff; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 18px; overflow: hidden; box-shadow: 0 12px 30px -6px rgba(15, 23, 42, 0.08);">
        
        <!-- Header Banner -->
        <tr>
            <td style="padding: 36px 32px 28px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); text-align: center;">
                <div style="display: inline-block; padding: 6px 16px; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.35); border-radius: 9999px; margin-bottom: 14px;">
                    <span style="color: #34d399; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;">
                        🔔 New Registration Alert
                    </span>
                </div>
                <h1 style="color: #ffffff; font-size: 24px; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.02em;">
                    New User Signed Up!
                </h1>
                <p style="color: #94a3b8; font-size: 14px; margin: 0; line-height: 1.5;">
                    A new business account has just been registered on AskReview under your administration.
                </p>
            </td>
        </tr>

        <!-- Main Content -->
        <tr>
            <td style="padding: 32px 30px 24px;">
                <p style="color: #0f172a; font-size: 16px; font-weight: 600; margin: 0 0 12px 0;">
                    Hello {{ $data['admin_name'] ?? 'Admin' }},
                </p>
                <p style="color: #475569; font-size: 14px; line-height: 1.6; margin: 0 0 24px 0;">
                    A new customer just completed registration on <strong>AskReview</strong>. Their account is active with a default <strong>7-Day Free Trial</strong>. Here are the full registration details:
                </p>

                <!-- Registered User Details Card -->
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 26px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                    <tr>
                        <td colspan="2" style="padding: 12px 18px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0; font-weight: 700; font-size: 13px; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
                            New User Profile
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; width: 38%; font-weight: 600;">Business Name:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px; font-weight: 700;">{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; font-weight: 600;">Registered Email:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px;">
                            <a href="mailto:{{ $data['email'] }}" style="color: #4338ca; text-decoration: none; font-weight: 600;">{{ $data['email'] }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; font-weight: 600;">Phone Number:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px;">{{ $data['phone'] ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; font-weight: 600;">Username / Slug:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px; font-family: monospace;">{{ $data['name_url'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; font-weight: 600;">Registered At:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px;">{{ $data['created_at'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; font-weight: 600;">Trial Expiry Date:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #047857; font-size: 13px; font-weight: 700;">{{ $data['expiry_date'] }} (7 Days)</td>
                    </tr>
                    @if(!empty($data['review_url']))
                    <tr>
                        <td style="padding: 12px 18px; color: #64748b; font-size: 13px; font-weight: 600;">Review Portal:</td>
                        <td style="padding: 12px 18px; color: #4338ca; font-size: 13px; word-break: break-all;">
                            <a href="{{ $data['review_url'] }}" target="_blank" style="color: #4338ca; text-decoration: none;">{{ $data['review_url'] }}</a>
                        </td>
                    </tr>
                    @endif
                </table>

                <!-- Action Button -->
                <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 24px auto;">
                    <tr>
                        <td align="center" style="border-radius: 12px; background: #0f172a;">
                            <a href="{{ $data['admin_user_list_url'] }}" target="_blank" style="display: inline-block; padding: 14px 34px; font-size: 14px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 12px; letter-spacing: 0.02em;">
                                View User List in Admin Panel →
                            </a>
                        </td>
                    </tr>
                </table>

                <p style="color: #64748b; font-size: 13px; line-height: 1.6; margin: 0; text-align: center;">
                    You can manage this user, extend their trial, or update their expiry date anytime from your admin dashboard.
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding: 24px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center;">
                <p style="color: #94a3b8; font-size: 12px; margin: 0 0 6px 0;">
                    © {{ date('Y') }} AskReview Admin System.
                </p>
                <p style="color: #cbd5e1; font-size: 11px; margin: 0;">
                    This is an automated administrative notification.
                </p>
            </td>
        </tr>

    </table>

</body>
</html>
