<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Request Received</title>
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
                            <p style="margin:4px 0 0;color:#9ca3af;font-size:12px;letter-spacing:1px;">& LOGISTICS</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">
                            <h2 style="margin:0 0 8px;color:#111827;font-size:20px;font-weight:800;">Thanks, {{ $quote->name }}!</h2>
                            <p style="margin:0 0 24px;color:#374151;font-size:15px;line-height:1.7;">
                                We've received your quote request and will get back to you as soon as possible. Our team typically responds within a few hours.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border-radius:8px;border:1px solid #e5e7eb;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #e5e7eb;">
                                        <span style="color:#6b7280;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Your Details</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 20px;border-bottom:1px solid #e5e7eb;">
                                        <span style="color:#6b7280;font-size:12px;">Name:</span>
                                        <span style="color:#111827;font-size:14px;font-weight:600;margin-left:8px;">{{ $quote->name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 20px;border-bottom:1px solid #e5e7eb;">
                                        <span style="color:#6b7280;font-size:12px;">Phone:</span>
                                        <span style="color:#111827;font-size:14px;font-weight:600;margin-left:8px;">{{ $quote->phone }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 20px;border-bottom:1px solid #e5e7eb;">
                                        <span style="color:#6b7280;font-size:12px;">Suburb:</span>
                                        <span style="color:#111827;font-size:14px;font-weight:600;margin-left:8px;">{{ $quote->suburb }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 20px;">
                                        <span style="color:#6b7280;font-size:12px;">Job Details:</span><br>
                                        <span style="color:#111827;font-size:14px;line-height:1.6;">{{ $quote->job_details }}</span>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 8px;color:#374151;font-size:15px;line-height:1.7;">
                                Need it done urgently? Give us a call:
                            </p>
                            <a href="tel:+61456155078" style="display:inline-block;background:#8ac507;color:#0a0a0a;font-weight:800;font-size:14px;padding:12px 28px;border-radius:8px;text-decoration:none;letter-spacing:0.3px;">
                                CALL 0456 155 078
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb;padding:20px 32px;text-align:center;border-top:1px solid #e5e7eb;">
                            <p style="margin:0 0 4px;color:#6b7280;font-size:13px;font-weight:600;">Senzu Transport & Logistics</p>
                            <p style="margin:0;color:#9ca3af;font-size:12px;">Brisbane's Trusted Delivery Specialists</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
