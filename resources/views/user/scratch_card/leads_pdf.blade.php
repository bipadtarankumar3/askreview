<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Leads - {{ $card->title ?? 'Scratch Card' }}</title>
    <style>
        @page {
            margin: 24px 28px;
            size: a4 landscape;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 11px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
            margin: 0;
        }
        .brand-sub {
            font-size: 10px;
            color: #64748b;
            margin-top: 2px;
        }
        .card-info-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 14px;
        }
        .metrics-table {
            width: 100%;
            margin-bottom: 14px;
        }
        .metric-cell {
            padding: 8px 12px;
            text-align: center;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        .metric-label {
            font-size: 9px;
            text-transform: uppercase;
            font-weight: bold;
            color: #64748b;
        }
        .metric-value {
            font-size: 18px;
            font-weight: bold;
            margin-top: 2px;
        }
        .leads-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        .leads-table th {
            background-color: #1e293b;
            color: #ffffff;
            font-size: 9.5px;
            text-transform: uppercase;
            font-weight: bold;
            padding: 7px 8px;
            text-align: left;
            border: 1px solid #1e293b;
        }
        .leads-table td {
            padding: 6px 8px;
            border: 1px solid #e2e8f0;
            font-size: 10px;
            vertical-align: middle;
        }
        .leads-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .badge {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 8.5px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-claimed {
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        .badge-redeemed {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .badge-code {
            font-family: monospace;
            background-color: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            padding: 2px 5px;
            border-radius: 4px;
            font-weight: bold;
        }
        .footer {
            margin-top: 16px;
            border-top: 1px solid #cbd5e1;
            padding-top: 8px;
            font-size: 9px;
            color: #94a3b8;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <!-- <table class="header-table" cellpadding="0" cellspacing="0">
        <tr>
            <td style="vertical-align: top;">
                <div class="brand-title">AskReview &mdash; Scratch Card Leads Report</div>
                <div class="brand-sub">Business: {{ $user->name ?? 'Store Owner' }} ({{ $user->email ?? '' }})</div>
            </td>
            <td style="text-align: right; vertical-align: top;">
                <div style="font-weight: bold; font-size: 11px; color: #334155;">Generated on:</div>
                <div style="font-size: 10px; color: #64748b;">{{ $generatedAt ?? date('d M Y, h:i A') }} (IST)</div>
                @if(!empty($fromDate) || !empty($toDate))
                    <div style="font-size: 9.5px; color: #2563eb; margin-top: 3px; font-weight: bold;">
                        Filter: {{ $fromDate ?: 'Start' }} to {{ $toDate ?: 'Today' }}
                    </div>
                @endif
            </td>
        </tr>
    </table> -->

    <!-- Card Metadata -->
    <!-- <div class="card-info-box">
        <table style="width: 100%;" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width: 60%; vertical-align: middle;">
                    <div style="font-size: 14px; font-weight: bold; color: #0f172a;">
                        Card: {{ $card->title ?? 'Scratch Card' }}
                        @if($card->card_theme)
                            <span style="font-size: 9px; background: #e0e7ff; color: #3730a3; padding: 2px 6px; border-radius: 4px; text-transform: uppercase;">{{ $card->card_theme }} Theme</span>
                        @endif
                    </div>
                    @if($card->offer_text)
                        <div style="font-size: 11px; color: #475569; margin-top: 2px;">
                            <strong>Offer:</strong> {{ $card->offer_text }}
                        </div>
                    @endif
                    @if($card->coupon_code)
                        <div style="font-size: 10.5px; margin-top: 2px;">
                            <strong>Default Coupon:</strong> <span class="badge-code">{{ $card->coupon_code }}</span>
                        </div>
                    @endif
                </td>
                <td style="width: 40%; text-align: right; vertical-align: middle;">
                    <div style="font-size: 10px; color: #64748b;">Status: <strong>{{ strtoupper($card->status ?? 'ACTIVE') }}</strong></div>
                    <div style="font-size: 9.5px; color: #94a3b8;">Created: {{ $card->created_at ? $card->created_at->timezone('Asia/Kolkata')->format('d M Y') : 'N/A' }}</div>
                </td>
            </tr>
        </table>
    </div> -->

    <!-- Summary Metrics -->
    <!-- <table class="metrics-table" cellpadding="0" cellspacing="6">
        <tr>
            <td class="metric-cell" style="background-color: #fffbeb; width: 25%;">
                <div class="metric-label">Total Scratches</div>
                <div class="metric-value" style="color: #d97706;">{{ $card->scratch_count ?? count($leads) }}</div>
            </td>
            <td class="metric-cell" style="background-color: #eff6ff; width: 25%;">
                <div class="metric-label">Report Leads</div>
                <div class="metric-value" style="color: #2563eb;">{{ count($leads) }}</div>
            </td>
            <td class="metric-cell" style="background-color: #ecfdf5; width: 25%;">
                <div class="metric-label">Claimed</div>
                <div class="metric-value" style="color: #059669;">{{ $leads->where('status', 'claimed')->count() }}</div>
            </td>
            <td class="metric-cell" style="background-color: #faf5ff; width: 25%;">
                <div class="metric-label">Redeemed</div>
                <div class="metric-value" style="color: #7c3aed;">{{ $leads->where('status', 'redeemed')->count() }}</div>
            </td>
        </tr>
    </table> -->

    <!-- Leads Table -->
    <table class="leads-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 35px; text-align: center;">#</th>
                <th style="width: 140px;">Customer Name</th>
                <th style="width: 110px;">Phone Number</th>
                <th style="width: 140px;">Email</th>
                <th>Offer Won</th>
                <th style="width: 85px;">Coupon Code</th>
                <th style="width: 125px;">Date &amp; Time (IST)</th>
                <th style="width: 80px; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leads as $index => $lead)
                <tr>
                    <td style="text-align: center; color: #64748b; font-weight: bold;">{{ $index + 1 }}</td>
                    <td><strong>{{ $lead->customer_name }}</strong></td>
                    <td>{{ $lead->customer_phone }}</td>
                    <td style="color: #475569;">{{ $lead->customer_email ?: '-' }}</td>
                    <td style="color: #0f172a;">{{ $lead->offer_won ?: ($card->offer_text ?: '-') }}</td>
                    <td>
                        @if($lead->coupon_code)
                            <span class="badge-code">{{ $lead->coupon_code }}</span>
                        @else
                            <span style="color: #94a3b8;">-</span>
                        @endif
                    </td>
                    <td>{{ $lead->created_at ? $lead->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : 'N/A' }}</td>
                    <td style="text-align: center;">
                        @if($lead->status === 'redeemed')
                            <span class="badge badge-redeemed">Redeemed</span>
                        @else
                            <span class="badge badge-claimed">Claimed</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 20px; color: #64748b;">
                        No customer leads match the selected criteria.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer -->
    <table class="footer" cellpadding="0" cellspacing="0">
        <tr>
            <td>AskReview Customer Leads Export &bull; Confidential Business Document</td>
            <td style="text-align: right;">Total Records: {{ count($leads) }}</td>
        </tr>
    </table>

</body>
</html>
