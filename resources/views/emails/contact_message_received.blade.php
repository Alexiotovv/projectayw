<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New contact request</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.5;">
    <h2 style="margin-bottom: 8px;">New contact request from website</h2>
    <p style="margin-top: 0; margin-bottom: 20px;">A client submitted the contact form.</p>

    <table cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; width: 100%; max-width: 680px; border-color: #d1d5db;">
        <tr>
            <th align="left" style="background: #f3f4f6;">Name</th>
            <td>{{ $contacto->name }}</td>
        </tr>
        <tr>
            <th align="left" style="background: #f3f4f6;">Email</th>
            <td>{{ $contacto->email }}</td>
        </tr>
        <tr>
            <th align="left" style="background: #f3f4f6;">Phone</th>
            <td>{{ $contacto->phone }}</td>
        </tr>
        <tr>
            <th align="left" style="background: #f3f4f6;">Subject</th>
            <td>{{ $contacto->subject }}</td>
        </tr>
        <tr>
            <th align="left" style="background: #f3f4f6;">Message</th>
            <td>{!! nl2br(e($contacto->message)) !!}</td>
        </tr>
        <tr>
            <th align="left" style="background: #f3f4f6;">Language</th>
            <td>{{ strtoupper($contacto->locale ?? 'en') }}</td>
        </tr>
        <tr>
            <th align="left" style="background: #f3f4f6;">Date</th>
            <td>{{ optional($contacto->created_at)->format('d/m/Y H:i') }}</td>
        </tr>
    </table>
</body>
</html>
