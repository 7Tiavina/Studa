<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{ asset('faviconStuda.png') }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Studa | Live - {{ $meeting->course->title }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#adc6ff",
                        "background": "#0c1322",
                        "surface": "#0c1322",
                        "surface-container": "#191f2f",
                        "surface-container-high": "#232a3a",
                        "surface-container-low": "#141b2b",
                        "on-background": "#dce2f7",
                        "on-surface": "#dce2f7",
                        "on-surface-variant": "#c2c6d6",
                        "outline": "#8c909f",
                        "outline-variant": "#424754",
                        "secondary": "#4edea3",
                        "tertiary": "#ffb95f",
                        "error": "#ffb4ab",
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        html, body { height: 100%; margin: 0; padding: 0; overflow: hidden; }
    </style>
</head>
<body class="bg-background text-on-background font-sans antialiased flex flex-col h-full">

    <!-- Header bar -->
    <header class="bg-surface-container-low border-b border-outline-variant/30 px-6 py-4 flex items-center justify-between shadow-md text-on-surface">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">video_camera_front</span>
            </div>
            <div class="min-w-0">
                <h1 class="font-bold text-base text-white truncate">{{ $meeting->course->title }}</h1>
                <p class="text-xs text-outline truncate">
                    {{ $meeting->course->subject->name }} • {{ $meeting->course->level->name }} | 
                    Professeur : <span class="text-primary font-semibold">{{ $meeting->teacher->name }}</span>
                    @if($meeting->student)
                        • Élève : <span class="text-secondary font-semibold">{{ $meeting->student->name }}</span>
                    @endif
                </p>
            </div>
        </div>
        <div>
            <button onclick="window.close()" class="bg-slate-800 border border-slate-700 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-700 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">close</span> Quitter la visioconférence
            </button>
        </div>
    </header>

    <!-- Jitsi Container -->
    <main id="jitsi-container" class="flex-1 w-full bg-slate-950"></main>

    <!-- Jitsi Meet API -->
    <script src="https://{{ config('services.jitsi.domain') }}/external_api.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const domain = "{{ config('services.jitsi.domain') }}";
            const options = {
                roomName: "{{ $meeting->jitsi_room }}",
                width: "100%",
                height: "100%",
                parentNode: document.querySelector('#jitsi-container'),
                userInfo: {
                    displayName: "{{ auth()->user()->name }}",
                    email: "{{ auth()->user()->email }}"
                },
                interfaceConfigOverwrite: {
                    DEFAULT_BACKGROUND: '#0c1322',
                    SHOW_JITSI_WATERMARK: false,
                    SHOW_BRAND_WATERMARK: false,
                    SHOW_WATERMARK_FOR_GUESTS: false,
                    TOOLBAR_BUTTONS: [
                        'microphone', 'camera', 'closedcaptions', 'desktop', 'embedmeeting', 'fullscreen',
                        'fodeviceselection', 'hangup', 'profile', 'chat', 'recording',
                        'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
                        'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts',
                        'tileview', 'videobackgroundblur', 'download', 'help', 'mute-everyone',
                        'security'
                    ]
                },
                configOverwrite: {
                    startWithAudioMuted: false,
                    startWithVideoMuted: false,
                    prejoinPageEnabled: false
                }
            };
            const api = new JitsiMeetExternalAPI(domain, options);
            
            api.addEventListener('videoConferenceLeft', () => {
                window.close();
            });
        });
    </script>
</body>
</html>
