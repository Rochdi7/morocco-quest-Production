<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Activity Inquiry - {{ config('app.name') }}</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #2c2c2c;
            background-color: #f8f8f8;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a {
            color: #bb5e2a;
            text-decoration: none;
        }

        .wrapper {
            width: 100%;
            background-color: #f8f8f8;
            padding: 40px 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .header {
            padding: 48px 48px 32px 48px;
            text-align: center;
            background-color: #ffffff;
            border-bottom: 1px solid #e8e8e8;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 3px;
            color: #2c2c2c;
            margin: 0;
            text-transform: uppercase;
        }

        .tagline {
            font-size: 13px;
            color: #bb5e2a;
            margin: 8px 0 0 0;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 400;
        }

        .status-bar {
            background-color: #06202B;
            padding: 14px 48px;
            text-align: center;
        }

        .status-text {
            margin: 0;
            font-size: 12px;
            color: #ffffff;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
        }

        .content {
            padding: 48px 48px 32px 48px;
        }

        .section {
            margin-bottom: 48px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #bb5e2a;
            margin: 0 0 20px 0;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .activity-card {
            border: 1px solid #e0e0e0;
            margin-bottom: 24px;
            background-color: #ffffff;
            overflow: hidden;
        }

        .activity-img {
            width: 100%;
            height: auto;
            display: block;
            max-height: 300px;
            object-fit: cover;
        }

        .activity-info {
            padding: 32px;
        }

        .activity-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c2c2c;
            margin: 0 0 16px 0;
            line-height: 1.4;
        }

        .activity-desc {
            font-size: 15px;
            color: #4a4a4a;
            line-height: 1.7;
            margin: 0 0 20px 0;
        }

        .activity-btn {
            display: inline-block;
            padding: 12px 32px;
            background-color: #bb5e2a;
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .tour-example {
            border: 1px solid #e0e0e0;
            background-color: #fafafa;
            padding: 28px 32px;
            margin-bottom: 24px;
        }

        .tour-title {
            font-size: 16px;
            font-weight: 600;
            color: #06202B;
            margin: 0 0 16px 0;
            letter-spacing: 0.5px;
        }

        .tour-desc {
            font-size: 14px;
            color: #4a4a4a;
            line-height: 1.8;
        }

        .tour-desc ul {
            padding-left: 18px;
            margin: 0;
        }

        .tour-desc li {
            margin-bottom: 8px;
        }

        .button {
            display: inline-block;
            padding: 14px 40px;
            background-color: #bb5e2a;
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #9a4d22;
        }

        .info-grid {
            border: 1px solid #e0e0e0;
            background-color: #ffffff;
        }

        .info-table {
            width: 100%;
        }

        .info-row {
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row td {
            padding: 18px 24px;
            vertical-align: top;
        }

        .info-label {
            font-weight: 500;
            color: #bb5e2a;
            width: 140px;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #2c2c2c;
            font-size: 15px;
        }

        .info-value a {
            color: #bb5e2a;
            text-decoration: none;
            border-bottom: 1px solid #e8b8a1;
        }

        .message-container {
            background-color: #faf9f7;
            border-left: 3px solid #bb5e2a;
            padding: 28px;
            margin-top: 16px;
        }

        .message-label {
            font-size: 12px;
            font-weight: 600;
            color: #bb5e2a;
            margin: 0 0 12px 0;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .message-text {
            color: #4a4a4a;
            font-size: 15px;
            line-height: 1.8;
            margin: 0;
            font-style: italic;
        }

        .divider {
            height: 1px;
            background-color: #e8e8e8;
            margin: 40px 0;
        }

        .footer {
            background-color: #06202B;
            padding: 40px 48px;
        }

        .action-box {
            background-color: #0a2d3d;
            border-left: 3px solid #bb5e2a;
            padding: 24px;
            margin-bottom: 32px;
        }

        .action-title {
            color: #bb5e2a;
            font-weight: 600;
            font-size: 14px;
            margin: 0 0 8px 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .action-text {
            color: #c4c4c4;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        .signature {
            text-align: center;
            padding-top: 28px;
            border-top: 1px solid #0a2d3d;
        }

        .signature-name {
            font-weight: 600;
            color: #ffffff;
            font-size: 18px;
            margin: 0 0 8px 0;
            letter-spacing: 2px;
        }

        .signature-tagline {
            color: #8b8b8b;
            font-size: 13px;
            margin: 0;
            letter-spacing: 1px;
        }

        .accent-pattern {
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #06202B 0%, #bb5e2a 50%, #06202B 100%);
        }

        @media only screen and (max-width: 600px) {
            .wrapper {
                padding: 0 !important;
            }

            .header {
                padding: 32px 24px 24px 24px !important;
            }

            .content {
                padding: 32px 24px 24px 24px !important;
            }

            .status-bar {
                padding: 12px 24px !important;
            }

            .logo-text {
                font-size: 24px !important;
                letter-spacing: 2px !important;
            }

            .activity-info {
                padding: 24px !important;
            }

            .activity-title {
                font-size: 20px !important;
            }

            .activity-desc {
                font-size: 14px !important;
            }

            .activity-btn {
                display: block;
                text-align: center;
                padding: 12px 24px !important;
            }

            .tour-example {
                padding: 20px 24px !important;
            }

            .info-label {
                display: block;
                width: 100% !important;
                padding-bottom: 6px !important;
                font-weight: 600;
            }

            .info-value {
                display: block;
                width: 100% !important;
            }

            .info-row td {
                padding: 16px 20px !important;
            }

            .button {
                display: block;
                text-align: center;
                padding: 14px 28px !important;
            }

            .message-container {
                padding: 20px !important;
            }

            .footer {
                padding: 32px 24px !important;
            }

            .action-box {
                padding: 20px !important;
            }
        }
    </style>
</head>

<body>
    <table role="presentation" class="wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table role="presentation" class="container" width="600" cellpadding="0" cellspacing="0">

                    <tr>
                        <td class="accent-pattern"></td>
                    </tr>

                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <img src="https://morocco-quest.com/assets/img/logo-bg-wide.webp"
                                alt="{{ config('app.name') }} Logo" width="150" height="45">
                            <p class="tagline">Authentic Journeys</p>
                        </td>
                    </tr>

                    <!-- Status -->
                    <tr>
                        <td class="status-bar">
                            <p class="status-text">New Inquiry Received</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td class="content">

                            <!-- Activity Section -->
                            <div class="section">
                                <h2 class="section-title">Requested Experience</h2>
                                <div class="activity-card">
                                    @php
                                        $image = $activity->images->first();
                                    @endphp
                                    <img src="{{ $image?->image_url ?? asset('assets/img/placeholder-image.webp') }}"
                                        alt="{{ $activity->title }}" class="activity-img">

                                    <div class="activity-info">
                                        <div class="activity-title">{{ $activity->title }}</div>
                                        <div class="activity-desc">
                                            {!! Str::limit(strip_tags($activity->overview), 350) !!}
                                            <br><br>
                                            <span style="color:#bb5e2a; font-weight: 500;">Duration:</span>
                                            {{ $activity->duration_days ? $activity->duration_days . ' day(s)' : $activity->duration ?? 'N/A' }}
                                            &nbsp;|&nbsp;
                                            <span style="color:#06202B; font-weight: 500;">Location:</span>
                                            {{ $activity->departure ?? 'On request' }}
                                        </div>
                                        <a href="{{ route('activities.show', ['slug' => $activity->slug]) }}"
                                            target="_blank">
                                            View Activity Page »
                                        </a>


                                    </div>
                                </div>

                                <!-- Dynamic Itinerary -->
                                @if (isset($activity->itineraryDays) && $activity->itineraryDays->count() > 0)
                                    <div class="tour-example">
                                        <div class="tour-title">Itinerary Highlights</div>
                                        <div class="tour-desc">
                                            <ul style="padding-left:18px; margin:0;">
                                                @foreach ($activity->itineraryDays as $day)
                                                    <li>
                                                        <strong>
                                                            {{ $day->day_number ? 'Hour ' . sprintf('%02d', $day->day_number) : 'Itinerary' }}:
                                                        </strong>
                                                        {!! $day->title ?? '' !!}
                                                        <br>
                                                        {!! $day->description !!}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif


                                <div class="divider"></div>

                                <!-- Traveler Info -->
                                <div class="section">
                                    <h2 class="section-title">Traveler Information</h2>
                                    <div class="info-grid">
                                        <table role="presentation" class="info-table">
                                            <tr class="info-row">
                                                <td class="info-label">Name</td>
                                                <td class="info-value">{{ $formData['name'] ?? 'N/A' }}</td>
                                            </tr>
                                            <tr class="info-row">
                                                <td class="info-label">Email</td>
                                                <td class="info-value">
                                                    <a
                                                        href="mailto:{{ $formData['email'] ?? '' }}">{{ $formData['email'] ?? 'N/A' }}</a>
                                                </td>
                                            </tr>
                                            @if (!empty($formData['phone']))
                                                <tr class="info-row">
                                                    <td class="info-label">Phone</td>
                                                    <td class="info-value">{{ $formData['phone'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($formData['nationality']))
                                                <tr class="info-row">
                                                    <td class="info-label">Nationality</td>
                                                    <td class="info-value">{{ $formData['nationality'] }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>

                                <!-- Journey Details -->
                                <div class="section">
                                    <h2 class="section-title">Journey Details</h2>
                                    <div class="info-grid">
                                        <table role="presentation" class="info-table">
                                            @if (!empty($formData['arrival_date']))
                                                <tr class="info-row">
                                                    <td class="info-label">Arrival Date</td>
                                                    <td class="info-value">
                                                        {{ \Carbon\Carbon::parse($formData['arrival_date'])->format('F j, Y') }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($formData['duration_days']))
                                                <tr class="info-row">
                                                    <td class="info-label">Duration</td>
                                                    <td class="info-value">{{ $formData['duration_days'] }} day(s)</td>
                                                </tr>
                                            @endif
                                            <tr class="info-row">
                                                <td class="info-label">Party Size</td>
                                                <td class="info-value">
                                                    {{ $formData['adults'] ?? 0 }} adult(s)
                                                    @if (!empty($formData['children']) && $formData['children'] > 0)
                                                        , {{ $formData['children'] }} child(ren)
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="section">
                                    <h2 class="section-title">Inquiry Message</h2>
                                    <div class="message-container">
                                        <p class="message-label">From the Traveler</p>
                                        <p class="message-text">
                                            {{ $formData['inquiry_message'] ?? 'No message provided.' }}</p>
                                    </div>
                                </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <div class="action-box">
                                <p class="action-title">Action Required</p>
                                <p class="action-text">
                                    Please respond within 24 hours with availability confirmation, detailed itinerary
                                    options, and pricing.
                                </p>
                            </div>
                            <div class="signature">
                                <img src="https://morocco-quest.com/assets/img/logo-bg-wide-white.webp"
                                    alt="{{ config('app.name') }} Logo" width="150" height="45">
                                <p class="signature-tagline">Crafting Extraordinary Journeys Since 2010</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="accent-pattern"></td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
