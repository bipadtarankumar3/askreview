<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $getsubject ?? 'Review Notification' }}</title>
</head>
<body style="margin: 0; padding: 24px 12px; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">

    @if ($type == 'ADMIN')
        <!-- Admin Notification Card -->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; background: #ffffff; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08);">
            
            <!-- Header Banner -->
            <tr>
                <td style="padding: 32px 30px 24px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); text-align: center;">
                    <div style="display: inline-block; padding: 6px 14px; background: rgba(225, 29, 72, 0.2); border: 1px solid rgba(225, 29, 72, 0.4); border-radius: 9999px; margin-bottom: 12px;">
                        <span style="color: #fda4af; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;">
                            ⚡ New Notification
                        </span>
                    </div>
                    <h1 style="color: #ffffff; font-size: 22px; font-weight: 800; margin: 0 0 6px 0; letter-spacing: -0.02em;">
                        {{ $getData['title'] ?? 'New Customer Submission' }}
                    </h1>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                        You have received a new response on your AskReview page.
                    </p>
                </td>
            </tr>

            <!-- Content Area -->
            <tr>
                <td style="padding: 28px 30px 20px;">
                    
                    <!-- Submission Meta Info Box -->
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 24px; border-collapse: separate; border-spacing: 0;">
                        
                        <!-- Date -->
                        <tr>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; width: 130px; vertical-align: middle;">
                                <div style="display: flex; align-items: center; color: #64748b; font-size: 13px; font-weight: 600;">
                                    <span style="display: inline-block; width: 22px; font-size: 15px; text-align: center; margin-right: 8px;">📅</span>
                                    <span>Date & Time</span>
                                </div>
                            </td>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 13px; font-weight: 600; text-align: right;">
                                {{ date('d M Y, h:i A') }}
                            </td>
                        </tr>

                        <!-- Business / Account -->
                        @if (isset($getData['business_name']) && !empty($getData['business_name']))
                        <tr>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                                <div style="display: flex; align-items: center; color: #64748b; font-size: 13px; font-weight: 600;">
                                    <span style="display: inline-block; width: 22px; font-size: 15px; text-align: center; margin-right: 8px;">🏢</span>
                                    <span>Business / Account</span>
                                </div>
                            </td>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 14px; font-weight: 700; text-align: right;">
                                {{ $getData['business_name'] }}
                            </td>
                        </tr>
                        @endif

                        <!-- Name -->
                        @if (isset($getData['name']) && !empty($getData['name']))
                        <tr>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                                <div style="display: flex; align-items: center; color: #64748b; font-size: 13px; font-weight: 600;">
                                    <span style="display: inline-block; width: 22px; font-size: 15px; text-align: center; margin-right: 8px;">👤</span>
                                    <span>Full Name</span>
                                </div>
                            </td>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; color: #0f172a; font-size: 14px; font-weight: 700; text-align: right;">
                                {{ $getData['name'] }}
                            </td>
                        </tr>
                        @endif

                        <!-- Email -->
                        @if (isset($getData['email']) && !empty($getData['email']))
                        <tr>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                                <div style="display: flex; align-items: center; color: #64748b; font-size: 13px; font-weight: 600;">
                                    <span style="display: inline-block; width: 22px; font-size: 15px; text-align: center; margin-right: 8px;">✉️</span>
                                    <span>Email Address</span>
                                </div>
                            </td>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; text-align: right;">
                                <a href="mailto:{{ $getData['email'] }}" style="color: #2563eb; font-size: 13px; font-weight: 600; text-decoration: none; word-break: break-all;">
                                    {{ $getData['email'] }}
                                </a>
                            </td>
                        </tr>
                        @endif

                        <!-- Phone -->
                        @if (isset($getData['phone']) && !empty($getData['phone']))
                        <tr>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                                <div style="display: flex; align-items: center; color: #64748b; font-size: 13px; font-weight: 600;">
                                    <span style="display: inline-block; width: 22px; font-size: 15px; text-align: center; margin-right: 8px;">📞</span>
                                    <span>Phone Number</span>
                                </div>
                            </td>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; text-align: right;">
                                <a href="tel:{{ $getData['phone'] }}" style="color: #2563eb; font-size: 13px; font-weight: 600; text-decoration: none;">
                                    {{ $getData['phone'] }}
                                </a>
                            </td>
                        </tr>
                        @endif

                        <!-- Rating -->
                        @if (isset($getData['rating']) && !empty($getData['rating']))
                        <tr>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                                <div style="display: flex; align-items: center; color: #64748b; font-size: 13px; font-weight: 600;">
                                    <span style="display: inline-block; width: 22px; font-size: 15px; text-align: center; margin-right: 8px;">⭐</span>
                                    <span>Star Rating</span>
                                </div>
                            </td>
                            <td style="padding: 12px 14px; border-bottom: 1px solid #f1f5f9; text-align: right;">
                                <span style="color: #f59e0b; font-size: 18px; letter-spacing: 2px;">
                                    @for($i = 0; $i < (int)$getData['rating']; $i++)★@endfor
                                </span>
                                <span style="display: inline-block; margin-left: 6px; padding: 2px 8px; background: #fef3c7; color: #b45309; border-radius: 9999px; font-size: 11px; font-weight: 700;">
                                    {{ $getData['rating'] }} / 5
                                </span>
                            </td>
                        </tr>
                        @endif

                    </table>

                    <!-- Customer Message Card -->
                    @if (isset($getData['message']) && !empty($getData['message']))
                    <div style="margin-bottom: 24px; padding: 18px 20px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #475569; letter-spacing: 0.05em; margin-bottom: 8px; display: flex; align-items: center;">
                            <span style="margin-right: 6px;">💬</span> Message Content
                        </div>
                        <div style="color: #1e293b; font-size: 14px; line-height: 1.6; word-break: break-word; white-space: pre-wrap;">{{ $getData['message'] }}</div>
                    </div>
                    @endif

                    <!-- Video Testimonial Action Box -->
                    @if (isset($getData['video_url']) && !empty($getData['video_url']))
                    <div style="margin-bottom: 24px; padding: 22px; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 14px; border: 1px solid #bbf7d0; text-align: center;">
                        <div style="font-size: 24px; margin-bottom: 6px;">🎥</div>
                        <h3 style="color: #14532d; font-size: 16px; font-weight: 800; margin: 0 0 6px 0;">Customer Video Testimonial</h3>
                        <p style="color: #166534; font-size: 13px; margin: 0 0 16px 0;">The customer has submitted a video review. You can download and stream it below.</p>
                        <a href="{{ $getData['video_url'] }}" target="_blank" download style="display: inline-block; background-color: #16a34a; color: #ffffff; padding: 12px 28px; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);">
                            📥 Download Video File
                        </a>
                    </div>
                    @endif

                    <!-- Admin Dashboard Quick Link -->
                    @if (isset($getData['admin_url']) && !empty($getData['admin_url']))
                    <div style="text-align: center; margin-bottom: 12px;">
                        <a href="{{ $getData['admin_url'] }}" target="_blank" style="display: inline-block; color: #2563eb; font-size: 13px; font-weight: 700; text-decoration: none; padding: 8px 16px; background: #eff6ff; border-radius: 8px; border: 1px solid #bfdbfe;">
                            Open in AskReview Dashboard &rarr;
                        </a>
                    </div>
                    @endif

                </td>
            </tr>

            <!-- Footer Area -->
            <tr>
                <td style="padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center;">
                    <p style="color: #64748b; font-size: 12px; margin: 0 0 6px 0;">
                        Need assistance? Contact our team at <a href="mailto:info@digitalvyapari.online" style="color: #2563eb; text-decoration: none;">info@digitalvyapari.online</a> or call <a href="tel:+919087868584" style="color: #2563eb; text-decoration: none;">+91 90878 68584</a>
                    </p>
                    <p style="color: #94a3b8; font-size: 11px; margin: 0;">
                        © {{ date('Y') }} AskReview. All rights reserved.
                    </p>
                </td>
            </tr>

        </table>
    @else
        <!-- Customer Confirmation Card -->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; background: #ffffff; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08);">
            
            <!-- Header Banner -->
            <tr>
                <td style="padding: 36px 30px 28px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); text-align: center;">
                    <div style="width: 52px; height: 52px; border-radius: 16px; background: linear-gradient(135deg, #22c55e, #16a34a); display: inline-flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; margin-bottom: 14px; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);">
                        ✓
                    </div>
                    <h1 style="color: #ffffff; font-size: 22px; font-weight: 800; margin: 0 0 6px 0; letter-spacing: -0.02em;">
                        Thank You for Your Feedback!
                    </h1>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                        We appreciate you taking the time to connect with us.
                    </p>
                </td>
            </tr>

            <!-- Content Area -->
            <tr>
                <td style="padding: 32px 30px 24px; text-align: center;">
                    <p style="color: #334155; font-size: 16px; font-weight: 600; line-height: 1.6; margin: 0 0 12px 0;">
                        Hello <b>{{ $getData['name'] ?? 'Valued Customer' }}</b>,
                    </p>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0 0 24px 0;">
                        We have successfully received your feedback. Our team is reviewing it and will get back to you shortly if required.
                    </p>

                    <div style="padding: 16px 20px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; display: inline-block; max-width: 450px; text-align: left;">
                        <div style="font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 6px;">Questions or Follow-ups?</div>
                        <div style="font-size: 13px; color: #64748b;">
                            Feel free to reach us directly at <a href="mailto:info@digitalvyapari.online" style="color: #2563eb; text-decoration: none; font-weight: 600;">info@digitalvyapari.online</a> or call <a href="tel:+919087868584" style="color: #2563eb; text-decoration: none; font-weight: 600;">+91 90878 68584</a>.
                        </div>
                    </div>
                </td>
            </tr>

            <!-- Footer Area -->
            <tr>
                <td style="padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center;">
                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                        © {{ date('Y') }} AskReview. All rights reserved.
                    </p>
                </td>
            </tr>

        </table>
    @endif

</body>
</html>
