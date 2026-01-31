<div>
    <div class="custom-login-wrapper">
        {{-- Animated Background Blobs --}}
        <div class="custom-bg-blobs">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
            <div class="bg-noise"></div>
        </div>

        {{-- Login Card --}}
        <div class="custom-login-card">
            
            {{-- Green Accent Bar --}}
            <div class="card-accent-bar"></div>

            {{-- Logo & Branding --}}
            <div class="card-branding">
                <div class="logo-container">
                    <img src="{{ asset('assets/images/logo/kemenag-logo.webp') }}" alt="Kemenag Logo" class="logo-img">
                </div>
                <h2 class="brand-title">
                    FLASH PTSP <span class="brand-highlight"><br>Kemenag Surabaya</span>
                </h2>
                <p class="brand-subtitle">
                    Pelayanan Terpadu Satu Pintu
                </p>
                {{-- Debug Indicator to confirm file load --}}
                {{-- <p style="font-size: 10px; color: #aaa; margin-top: 5px;">Custom Login Loaded</p> --}}
            </div>

            {{-- Login Form --}}
            <div class="form-container">
                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

                <x-filament-panels::form wire:submit="authenticate">
                    {{ $this->form }}

                    <x-filament-panels::form.actions
                        :actions="$this->getCachedFormActions()"
                        :full-width="$this->hasFullWidthFormActions()"
                    />
                </x-filament-panels::form>

                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
            </div>

            {{-- Footer --}}
            <div class="card-footer">
                 @if (filament()->hasRegistration())
                    <div class="text-sm text-gray-600">
                        {{ __('filament-panels::pages/auth/login.actions.register.before') }}
                        {{ $this->registerAction }}
                    </div>
                @endif
                <p class="footer-copyright">
                    &copy; 2026 Prakom Kemenag Surabaya. All rights reserved.
                </p>
                <div class="footer-dots">
                     <span class="dot dot-1"></span>
                     <span class="dot dot-2"></span>
                     <span class="dot dot-3"></span>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Base Setup */
        .custom-login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 50%, #f0fdfa 100%); /* emerald-50 to teal-50 */
            padding: 1rem;
            position: relative;
            overflow: hidden;
            font-family: sans-serif;
            color: #111827;
        }

        /* Background Blobs */
        .custom-bg-blobs {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }
        .blob {
            position: absolute;
            border-radius: 9999px;
            filter: blur(64px);
            opacity: 0.4;
            animation: blob 10s infinite alternate;
        }
        .blob-1 {
            top: -20%;
            left: -10%;
            width: 50%;
            height: 50%;
            background: #a7f3d0; /* green-200 */
        }
        .blob-2 {
            top: 30%;
            right: -10%;
            width: 40%;
            height: 40%;
            background: #99f6e4; /* teal-200 */
            animation-delay: 2s;
        }
        .blob-3 {
            bottom: -10%;
            left: 20%;
            width: 40%;
            height: 40%;
            background: #6ee7b7; /* emerald-300 */
            animation-delay: 4s;
        }
        .bg-noise {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
            opacity: 0.4;
            mix-blend-mode: overlay;
        }

        /* Login Card */
        .custom-login-card {
            width: 100%;
            max-width: 480px;
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1);
            border: 1px solid rgba(255, 255, 255, 0.6);
            position: relative;
            z-index: 10;
            padding: 2.5rem;
            transition: all 0.3s ease;
        }
        .custom-login-card:hover {
            box-shadow: 0 15px 50px -10px rgba(0,0,0,0.12);
        }

        .card-accent-bar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(to right, #10b981, #22c55e, #0d9488); /* emerald-500, green-500, teal-600 */
        }

        /* Branding */
        .card-branding {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
            text-align: center;
        }
        .logo-container {
            width: 5rem;
            height: 5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom right, #f0fdf4, #ecfdf5);
            border-radius: 1rem;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(255,255,255,0.8);
        }
        .logo-img {
            width: 3.5rem;
            height: auto;
            filter: drop-shadow(0 2px 2px rgba(0,0,0,0.1));
        }
        .brand-title {
            font-size: 1.5rem; /* 2xl */
            font-weight: 700;
            background: -webkit-linear-gradient(left, #047857, #0f766e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            letter-spacing: -0.025em;
        }
        .brand-highlight {
            color: #059669; /* emerald-600 */
            -webkit-text-fill-color: #059669;
        }
        .brand-subtitle {
            font-size: 0.875rem; /* sm */
            color: #6b7280; /* gray-500 */
            margin-top: 0.5rem;
            font-weight: 500;
            background-color: rgba(16, 185, 129, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        /* Form Container */
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Footer */
        .card-footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f3f4f6; /* gray-100 */
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }
        .footer-copyright {
            font-size: 0.75rem; /* xs */
            color: #9ca3af; /* gray-400 */
            font-weight: 500;
            margin: 0;
        }
        .footer-dots {
            display: flex;
            gap: 0.75rem;
            margin-top: 0.25rem;
        }
        .dot {
            width: 0.375rem;
            height: 0.375rem;
            border-radius: 50%;
        }
        .dot-1 { background-color: #a7f3d0; }
        .dot-2 { background-color: #bbf7d0; }
        .dot-3 { background-color: #99f6e4; }

        /* Keyframes */
        @keyframes blob {
          0% { transform: translate(0px, 0px) scale(1); }
          33% { transform: translate(30px, -50px) scale(1.1); }
          66% { transform: translate(-20px, 20px) scale(0.9); }
          100% { transform: translate(0px, 0px) scale(1); }
        }

        /* Filament Overrides - Deep Selectors */
        .fi-btn-primary {
            background-image: linear-gradient(to right, #10b981, #059669) !important;
            background-color: transparent !important;
            border: none !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.39) !important;
        }
        .fi-btn-primary:hover {
            background-image: linear-gradient(to right, #059669, #047857) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px 0 rgba(16, 185, 129, 0.29) !important;
        }
        .fi-input-wrp {
             background-color: #ffffff !important;
             border: 1px solid #d1d5db !important; /* gray-300 */
             box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
             transition: all 0.2s;
        }
        .fi-input-wrp:focus-within {
             border-color: #10b981 !important; /* emerald-500 */
             box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2) !important;
        }
        .fi-input {
            color: #111827 !important; /* gray-900 */
        }
        /* Fix label color if needed */
        .fi-fo-field-wrp-label,
        label,
        span.text-sm.font-medium.leading-6.text-gray-950,
        span.text-sm.font-medium.leading-6.text-white, /* Override dark mode defaults */
        .fi-input-label {
            color: #374151 !important; /* gray-700 */
            font-weight: 500 !important;
        }
        
        /* Ensure dark text for input values and placeholders */
        .fi-input, input {
            color: #111827 !important; /* gray-900 */
        }
        ::placeholder {
            color: #9ca3af !important; /* gray-400 */
        }

        /* Checkbox styling */
        input[type="checkbox"] {
            -webkit-appearance: none;
            appearance: none;
            background-color: #fff;
            margin: 0;
            font: inherit;
            color: currentColor;
            width: 1.15em;
            height: 1.15em;
            border: 1px solid #d1d5db !important; /* gray-300 */
            border-radius: 0.15em;
            display: grid;
            place-content: center;
        }

        input[type="checkbox"]::before {
            content: "";
            width: 0.65em;
            height: 0.65em;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em white;
            background-color: white;
            transform-origin: center;
            clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
        }

        input[type="checkbox"]:checked {
            background-color: #10b981 !important; /* emerald-500 */
            border-color: #10b981 !important;
        }

        input[type="checkbox"]:checked::before {
            transform: scale(1);
        }
        
        /* Ensure checkbox label is visible */
        .fi-fo-field-wrp-label span {
             color: #374151 !important; /* gray-700 */
        }
    </style>
</div>
