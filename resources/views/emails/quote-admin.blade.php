<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Quote Request</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f5;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f5;padding:40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                    <!-- Header -->
                    <tr>
                        <td style="background:#0a0a0a;padding:28px 32px;text-align:center;">
                            <h1 style="margin:0;color:#8ac507;font-size:20px;font-weight:800;letter-spacing:0.5px;">SENZU TRANSPORT</h1>
                            <p style="margin:4px 0 0;color:#9ca3af;font-size:12px;letter-spacing:1px;">NEW QUOTE REQUEST</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 20px;color:#374151;font-size:15px;line-height:1.6;">
                                A new quote request has been submitted on the website.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border-radius:8px;border:1px solid #e5e7eb;">
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #e5e7eb;">
                                        <span style="color:#6b7280;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Name</span><br>
                                        <span style="color:#111827;font-size:15px;font-weight:600;">{{ $quote->name }}</span>
                                    </td>
                                </tr>
                                @if($quote->email)
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #e5e7eb;">
                                        <span style="color:#6b7280;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Email</span><br>
                                        <a href="mailto:{{ $quote->email }}" style="color:#8ac507;font-size:15px;font-weight:600;text-decoration:none;">{{ $quote->email }}</a>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #e5e7eb;">
                                        <span style="color:#6b7280;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Phone</span><br>
                                        <a href="tel:{{ $quote->phone }}" style="color:#8ac507;font-size:15px;font-weight:600;text-decoration:none;">{{ $quote->phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #e5e7eb;">
                                        <span style="color:#6b7280;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Suburb</span><br>
                                        <span style="color:#111827;font-size:15px;font-weight:600;">{{ $quote->suburb }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <span style="color:#6b7280;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Job Details</span><br>
                                        <span style="color:#111827;font-size:14px;line-height:1.6;">{{ $quote->job_details }}</span>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:24px 0 0;color:#6b7280;font-size:13px;">
                                Submitted {{ $quote->created_at->format('d M Y \a\t g:ia') }}
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb;padding:20px 32px;text-align:center;border-top:1px solid #e5e7eb;">
                            <p style="margin:0;color:#9ca3af;font-size:12px;">Senzu Transport & Logistics &mdash; Brisbane</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
