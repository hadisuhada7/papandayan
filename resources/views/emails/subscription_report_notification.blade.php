<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Laporan Baru</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f7f7f7; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                    <tr>
                        <td style="padding: 24px;">
                            <div style="margin-bottom: 16px;">
                                <img src="{{ $logoSrc }}" alt="Papandayan" style="height: 48px;">
                            </div>
                            <h2 style="margin: 0 0 12px; color: #1f2937;">Notifikasi Laporan Baru</h2>
                            <p style="margin: 0 0 16px; color: #4b5563;">Laporan terbaru telah dipublikasikan.</p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 16px;">
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280; width: 160px;">Nama Laporan</td>
                                    <td style="padding: 8px 0; color: #111827;">{{ $payload['report_name'] }} ({{ $payload['report_type'] }})</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280;">Nama File</td>
                                    <td style="padding: 8px 0; color: #111827;">{{ $payload['file_name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; color: #6b7280;">Tanggal Publish</td>
                                    <td style="padding: 8px 0; color: #111827;">{{ $payload['publish_date_label'] }}</td>
                                </tr>
                            </table>

                            <div style="margin: 20px 0;">
                                <a href="{{ $payload['list_url'] }}" style="display: inline-block; background-color: #2e3192; color: #ffffff; text-decoration: none; padding: 12px 18px; border-radius: 6px;">
                                    Lihat Laporan
                                </a>
                            </div>

                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 24px 0;">

                            <p style="margin: 0 0 12px; color: #6b7280; font-size: 13px;">
                                Jika Anda tidak ingin menerima email ini, silakan berhenti berlangganan.
                            </p>
                            <a href="{{ $unsubscribeUrl }}" style="display: inline-block; background-color: #ef4444; color: #ffffff; text-decoration: none; padding: 10px 16px; border-radius: 6px; font-size: 13px;">
                                Unsubscribe
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
