<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $getsubject ?? 'Review Notification' }}</title>
</head>
<body style="margin: 0; padding: 20px; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

    @if ($type == 'ADMIN')
        <table style="width: 100%; max-width: 600px; background: #ffffff; margin: 0 auto; border-spacing: 0px; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <tr>
                <td style="text-align: center; padding: 30px 20px; background: #ffffff; border-bottom: 3px solid #2563eb;">
                    <h2 style="font-weight: 700; color: #1e293b; margin: 0; font-size: 22px;">{{ $getData['title'] ?? 'New Customer Submission' }}</h2>
                </td>
            </tr>
            <tr>
                <td style="padding: 25px 30px; background: #ffffff;">
                    <table style="width: 100%; border-spacing: 0px;">
                        <tr>
                            <td style="padding: 10px 0; color: #64748b; font-size: 14px; width: 110px;"><b>Date:</b></td>
                            <td style="padding: 10px 0; color: #0f172a; font-size: 14px;">{{ date('d M Y, h:i A') }}</td>
                        </tr>
                        @if (isset($getData['name']) && !empty($getData['name']))
                        <tr>
                            <td style="padding: 10px 0; color: #64748b; font-size: 14px;"><b>Name:</b></td>
                            <td style="padding: 10px 0; color: #0f172a; font-size: 14px; font-weight: 600;">{{ $getData['name'] }}</td>
                        </tr>
                        @endif
                        @if (isset($getData['email']) && !empty($getData['email']))
                        <tr>
                            <td style="padding: 10px 0; color: #64748b; font-size: 14px;"><b>Email:</b></td>
                            <td style="padding: 10px 0; color: #0f172a; font-size: 14px;">
                                <a href="mailto:{{ $getData['email'] }}" style="color: #2563eb; text-decoration: none;">{{ $getData['email'] }}</a>
                            </td>
                        </tr>
                        @endif
                        @if (isset($getData['phone']) && !empty($getData['phone']))
                        <tr>
                            <td style="padding: 10px 0; color: #64748b; font-size: 14px;"><b>Phone:</b></td>
                            <td style="padding: 10px 0; color: #0f172a; font-size: 14px;">
                                <a href="tel:{{ $getData['phone'] }}" style="color: #2563eb; text-decoration: none;">{{ $getData['phone'] }}</a>
                            </td>
                        </tr>
                        @endif
                        @if (isset($getData['rating']) && !empty($getData['rating']))
                        <tr>
                            <td style="padding: 10px 0; color: #64748b; font-size: 14px;"><b>Rating:</b></td>
                            <td style="padding: 10px 0; color: #f59e0b; font-size: 18px;">
                                @for($i = 0; $i < (int)$getData['rating']; $i++)★@endfor 
                                <span style="font-size: 14px; color: #64748b;">({{ $getData['rating'] }}/5)</span>
                            </td>
                        </tr>
                        @endif
                        @if (isset($getData['message']) && !empty($getData['message']))
                        <tr>
                            <td style="padding: 10px 0; color: #64748b; font-size: 14px; vertical-align: top;"><b>Message:</b></td>
                            <td style="padding: 10px 0; color: #0f172a; font-size: 14px; line-height: 1.6; background: #f8fafc; border-radius: 8px; padding: 12px; border: 1px solid #e2e8f0;">
                                {{ $getData['message'] }}
                            </td>
                        </tr>
                        @endif
                    </table>

                    @if (isset($getData['video_url']) && !empty($getData['video_url']))
                    <div style="margin-top: 30px; text-align: center; padding: 20px; background: #f0fdf4; border-radius: 8px; border: 1px solid #bbf7d0;">
                        <p style="margin: 0 0 12px 0; color: #166534; font-size: 14px; font-weight: 600;">Customer video testimonial is ready:</p>
                        <a href="{{ $getData['video_url'] }}" target="_blank" download style="background-color: #16a34a; color: #ffffff; padding: 12px 28px; text-decoration: none; border-radius: 6px; font-weight: 600; display: inline-block; font-size: 15px; box-shadow: 0 2px 4px rgba(22, 163, 74, 0.25);">
                            📥 Download Video Testimonial
                        </a>
                    </div>
                    @endif

                    @if (isset($getData['admin_url']) && !empty($getData['admin_url']))
                    <div style="margin-top: 20px; text-align: center;">
                        <a href="{{ $getData['admin_url'] }}" target="_blank" style="color: #2563eb; font-size: 13px; font-weight: 500; text-decoration: underline;">
                            Open in AskReview Dashboard &rarr;
                        </a>
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding: 16px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center; color: #94a3b8; font-size: 12px;">
                    This email was sent automatically by your AskReview platform.
                </td>
            </tr>
        </table>
    @else
        <table style="width: 100%; max-width: 600px; background: #ffffff; margin: 0 auto; border-spacing: 0px; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <tr>
                <td style="text-align: center; padding: 30px 20px; background: #ffffff; border-bottom: 3px solid #16a34a;">
                    <h2 style="font-weight: 700; color: #1e293b; margin: 0; font-size: 22px;">Thank You for Your Feedback!</h2>
                </td>
            </tr>
            <tr>
                <td style="padding: 30px 25px; background: #ffffff; text-align: center;">
                    <p style="color: #334155; font-size: 16px; line-height: 1.6; margin: 0 0 12px 0;">
                        Hello <b>{{ $getData['name'] ?? 'Valued Customer' }}</b>,
                    </p>
                    <p style="color: #475569; font-size: 14px; line-height: 1.6; margin: 0;">
                        Thank you for taking the time to share your feedback with us. We have received your message and our team will get back to you shortly.
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding: 16px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center; color: #94a3b8; font-size: 12px;">
                    Thank you for choosing us!
                </td>
            </tr>
        </table>
    @endif

</body>
</html>
