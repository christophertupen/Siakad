<!DOCTYPE html>
<html class="light" lang="id" x-data="{ darkMode: false }" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>EduPremium - Premium Teacher Dashboard 2026</title>
    
    <!-- Material and Fonts -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&amp;display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary": "#2563eb",
                    "on-primary": "#ffffff",
                    "surface": "#FFFFFF",
                    "background": "#f7f9fb",
                    "on-background": "#191c1e",
                    "surface-container": "#eceef0",
                    "surface-container-low": "#f2f4f6",
                    "surface-container-high": "#e6e8ea",
                    "outline-variant": "#c3c6d7",
                    "on-surface-variant": "#434655",
                    "success": "#22C55E",
                    "error": "#ba1a1a",
                    "tertiary": "#784b00",
                    "glass-fill": "rgba(255, 255, 255, 0.7)",
                    "glass-stroke": "rgba(255, 255, 255, 0.4)",
                    "dark-bg": "#0B0F19",
                    "dark-surface": "rgba(20, 26, 45, 0.85)"
            },
            "borderRadius": {
                    "bento": "20px",
                    "xl": "12px",
                    "full": "9999px"
            },
            "fontFamily": {
                    "sans": ["Plus Jakarta Sans", "sans-serif"]
            }
          },
        },
      }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f7f9fb; transition: background-color 0.3s ease; }
        .bento-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dark .bento-card {
            background: rgba(20, 26, 45, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
        }
        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px -4px rgba(0, 0, 0, 0.08);
            border-color: rgba(37, 99, 235, 0.2);
        }
        .sidebar-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(24px);
            border-right: 1px solid rgba(255, 255, 255, 0.5);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e0e3e5; border-radius: 10px; }
        
        .progress-ring__circle {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
        
        .sparkline {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: dash 2s ease-in-out forwards;
        }
        @keyframes dash { to { stroke-dashoffset: 0; } }
    </style>
</head>
<body class="text-on-background dark:text-slate-200 dark:bg-dark-bg min-h-screen flex relative">
    {{ $slot }}
</body>
</html>
