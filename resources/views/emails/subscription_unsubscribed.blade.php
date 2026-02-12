<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Berhenti Berlangganan</title>
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
                            <h2 style="margin: 0 0 12px; color: #1f2937;">Kami menyesal mengetahui bahwa Anda tidak lagi tertarik untuk berlangganan notifikasi kami</h2>
                            <p style="margin: 0 0 16px; color: #4b5563;">
                                Anda telah berhenti berlangganan notifikasi laporan. Jika Anda berubah pikiran, Anda dapat berlangganan kembali melalui tombol di bawah ini.
                            </p>
                            <div style="margin: 20px 0;">
                                <a href="{{ $resubscribeUrl }}" style="display: inline-block; background-color: #2e3192; color: #ffffff; text-decoration: none; padding: 12px 18px; border-radius: 6px;">
                                    Berlangganan Kembali
                                </a>
                            </div>
                            <p style="margin: 0; color: #6b7280; font-size: 13px;">
                                Terima kasih atas perhatian Anda.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
