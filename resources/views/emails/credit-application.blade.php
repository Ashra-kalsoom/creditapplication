{{-- File: resources/views/emails/credit-application.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Credit Application Submission</title>
</head>
<body>
    <p>Dear Supplier,</p>
    <p>Please find attached the credit application for <strong>{{ $application->pharmacy_name }}</strong>.</p>
    <p>Details:</p>
    <ul>
        <li><strong>Pharmacy Name:</strong> {{ $application->pharmacy_name }}</li>
        <li><strong>Contact Email:</strong> {{ $application->contact_email }}</li>
        <li><strong>DEA License:</strong> {{ $application->dea_license }}</li>
        <li><strong>State License:</strong> {{ $application->state_license }}</li>
        <li><strong>Bank Information:</strong> {{ $application->bank_info }}</li>
        <li><strong>Credit References:</strong> {{ implode(', ', json_decode($application->credit_references)) }}</li>
    </ul>
    <p>The completed application is attached to this email.</p>
    <p>Best regards,</p>
    <p><strong>Resource Rx Team</strong></p>
</body>
</html>
