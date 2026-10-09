<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to AskReview</title>
</head>
<body style="margin: 0; padding: 28px 12px; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #1e293b;">

    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; background: #ffffff; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 18px; overflow: hidden; box-shadow: 0 12px 30px -6px rgba(15, 23, 42, 0.08);">
        
        <!-- Header Banner -->
        <tr>
            <td style="padding: 36px 32px 28px; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%); text-align: center;">
                <div style="display: inline-block; padding: 6px 16px; background: rgba(56, 189, 248, 0.15); border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 9999px; margin-bottom: 14px;">
                    <span style="color: #38bdf8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;">
                        ✨ Account Created Successfully
                    </span>
                </div>
                <h1 style="color: #ffffff; font-size: 24px; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.02em;">
                    Welcome to AskReview!
                </h1>
                <p style="color: #cbd5e1; font-size: 14px; margin: 0; line-height: 1.5;">
                    Your 7-day free trial has been activated. Start boosting your customer reviews today!
                </p>
            </td>
        </tr>

        <!-- Main Content -->
        <tr>
            <td style="padding: 32px 30px 24px;">
                <p style="color: #0f172a; font-size: 16px; font-weight: 600; margin: 0 0 12px 0;">
                    Hello {{ $data['name'] }},
                </p>
                <p style="color: #475569; font-size: 14px; line-height: 1.6; margin: 0 0 24px 0;">
                    Thank you for signing up with <strong>AskReview</strong>! Your business profile is ready. You have received full access with a <strong>7-Day Free Trial</strong> to explore all premium features, generate custom review QR codes, and automate review requests.
                </p>

                <!-- Trial Notice Card -->
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 24px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 12px;">
                    <tr>
                        <td style="padding: 16px 20px;">
                            <div style="font-weight: 700; color: #065f46; font-size: 14px; margin-bottom: 4px;">
                                🎁 7-Day Free Trial Active
                            </div>
                            <div style="color: #047857; font-size: 13px; line-height: 1.5;">
                                Your complimentary trial is valid through <strong>{{ $data['expiry_date'] }}</strong>. No immediate payment required.
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Account Information Summary -->
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 26px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                    <tr>
                        <td colspan="2" style="padding: 12px 18px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0; font-weight: 700; font-size: 13px; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
                            Your Account Details
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; width: 38%; font-weight: 600;">Business Name:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px; font-weight: 700;">{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; font-weight: 600;">Registered Email:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px;">{{ $data['email'] }}</td>
                    </tr>
                    @if(!empty($data['phone']))
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; font-weight: 600;">Phone Number:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px;">{{ $data['phone'] }}</td>
                    </tr>
                    @endif
                    @if(!empty($data['review_url']))
                    <tr>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 13px; font-weight: 600;">Public Review URL:</td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #f1f5f9; color: #4338ca; font-size: 13px; word-break: break-all;">
                            <a href="{{ $data['review_url'] }}" target="_blank" style="color: #4338ca; text-decoration: none; font-weight: 600;">{{ $data['review_url'] }}</a>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 12px 18px; color: #64748b; font-size: 13px; font-weight: 600;">Trial Expiry Date:</td>
                        <td style="padding: 12px 18px; color: #0f172a; font-size: 13px; font-weight: 700;">{{ $data['expiry_date'] }}</td>
                    </tr>
                </table>

                <!-- Action Button -->
                <table align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 28px auto;">
                    <tr>
                        <td align="center" style="border-radius: 12px; background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);">
                            <a href="{{ $data['login_url'] }}" target="_blank" style="display: inline-block; padding: 15px 36px; font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 12px; letter-spacing: 0.02em;">
                                Log In to Your Dashboard →
                            </a>
                        </td>
                    </tr>
                </table>

                <!-- Next Steps / Tips -->
                <div style="background: #faf5ff; border: 1px solid #f3e8ff; border-radius: 12px; padding: 18px 20px; margin-bottom: 20px;">
                    <div style="font-weight: 700; color: #6b21a8; font-size: 13px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.05em;">
                        🚀 Quick Steps to Get Started:
                    </div>
                    <ol style="margin: 0; padding-left: 18px; color: #581c87; font-size: 13px; line-height: 1.8;">
                        <li><strong>Log in</strong> to your account with your registered email and password.</li>
                        <li><strong>Add your links</strong>: connect Google Reviews, Facebook, Justdial, and more.</li>
                        <li><strong>Download your QR Code</strong> to place at your counter or share directly with clients!</li>
                    </ol>
                </div>

                <p style="color: #64748b; font-size: 13px; line-height: 1.6; margin: 0;">
                    Need assistance setting up? Reply directly to this email or reach out to our team anytime.
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding: 24px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center;">
                <p style="color: #94a3b8; font-size: 12px; margin: 0 0 6px 0;">
                    © {{ date('Y') }} AskReview. All rights reserved.
                </p>
                <p style="color: #cbd5e1; font-size: 11px; margin: 0;">
                    You received this email because you signed up for an account on AskReview.
                </p>
            </td>
        </tr>

    </table>

</body>
</html>
