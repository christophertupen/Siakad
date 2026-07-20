<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>SchonaNexa Staff Portal</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-background": "#191c1e",
                        "secondary-fixed-dim": "#bec6e0",
                        "secondary": "#565e74",
                        "primary-fixed-dim": "#b4c5ff",
                        "surface-container-high": "#e6e8ea",
                        "surface-bright": "#f7f9fb",
                        "on-surface-variant": "#434655",
                        "surface-container-highest": "#e0e3e5",
                        "on-primary-fixed": "#00174b",
                        "inverse-surface": "#2d3133",
                        "on-tertiary": "#ffffff",
                        "success": "#22C55E",
                        "outline": "#737686",
                        "secondary-fixed": "#dae2fd",
                        "surface-container-low": "#f2f4f6",
                        "primary-container": "#2563eb",
                        "on-tertiary-fixed": "#2a1700",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "surface-dim": "#d8dadc",
                        "on-primary-fixed-variant": "#003ea8",
                        "error": "#ba1a1a",
                        "on-secondary-container": "#5c647a",
                        "glass-stroke": "rgba(255, 255, 255, 0.4)",
                        "tertiary-container": "#996100",
                        "secondary-container": "#dae2fd",
                        "on-secondary-fixed": "#131b2e",
                        "primary": "#004ac6",
                        "on-error": "#ffffff",
                        "background": "#f7f9fb",
                        "on-tertiary-fixed-variant": "#653e00",
                        "surface-tint": "#0053db",
                        "primary-fixed": "#dbe1ff",
                        "surface": "#FFFFFF",
                        "on-tertiary-container": "#ffeedd",
                        "outline-variant": "#c3c6d7",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed": "#ffddb8",
                        "inverse-on-surface": "#eff1f3",
                        "surface-container-lowest": "#ffffff",
                        "glass-fill": "rgba(255, 255, 255, 0.7)",
                        "on-primary-container": "#eeefff",
                        "on-primary": "#ffffff",
                        "surface-container": "#eceef0",
                        "tertiary-fixed-dim": "#ffb95f",
                        "on-secondary-fixed-variant": "#3f465c",
                        "inverse-primary": "#b4c5ff",
                        "on-surface": "#191c1e",
                        "surface-variant": "#e0e3e5",
                        "tertiary": "#784b00"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "container-max": "1440px",
                        "stack-xl": "80px",
                        "margin-tablet": "32px",
                        "stack-md": "24px",
                        "gutter": "32px",
                        "stack-lg": "48px",
                        "margin-desktop": "64px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "display-lg-mobile": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "headline-lg": ["30px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "500" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "display-lg-mobile": ["32px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "display-lg": ["48px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800" }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #f7f9fb;
            color: #191c1e;
            overflow-x: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0px 10px 30px rgba(15, 23, 42, 0.04);
        }
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }
        .cubic-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .floating-object {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .schedule-grid { display: grid; grid-template-columns: 120px repeat(5, 1fr); gap: 1px; background-color: #e2e8f0; border-radius: 12px; overflow: hidden; }
        .schedule-header { background-color: #f8fafc; padding: 12px; text-align: center; font-weight: 700; border-bottom: 2px solid #e2e8f0; }
        .time-cell { background-color: #f1f5f9; padding: 12px; text-align: center; font-weight: 600; display: flex; align-items: center; justify-content: center; }
        .slot-cell { background-color: white; min-height: 100px; padding: 8px; position: relative; transition: all 0.2s ease; }
        .slot-cell:hover { background-color: #f8fafc; }
        .course-card { border-left: 4px solid #004ac6; padding: 8px; border-radius: 6px; background: #eff6ff; font-size: 12px; height: 100%; transition: transform 0.15s ease; cursor: pointer; }
        .course-card:hover { transform: scale(1.02); z-index: 10; }
        .conflict { border-left-color: #ba1a1a !important; background: #fef2f2 !important; }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .float-decoration {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .ambient-shadow {
            box-shadow: 0px 10px 30px rgba(15, 23, 42, 0.04);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, rgba(255,255,255,0.8) 0%, rgba(247,249,251,0.8) 100%);
        }
    </style>
    @livewireStyles
</head>
<body class="font-body-md text-on-surface">
    {{ $slot }}
    @livewireScripts
</body>
</html>
