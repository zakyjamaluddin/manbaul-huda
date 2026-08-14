<x-filament-widgets::widget>
    <div style="background: linear-gradient(135deg, #0a3d24 0%, #13653f 60%, #082818 100%); border-left: 6px solid #c5a059; border-radius: 16px; padding: 24px; color: #ffffff !important; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.15);">

        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px;">

            <!-- Sisi Kiri: Salam & Tanggal -->
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <div style="display: inline-flex; align-items: center; gap: 8px; background-color: rgba(197, 160, 89, 0.25); border: 1px solid rgba(197, 160, 89, 0.4); padding: 4px 12px; border-radius: 9999px; width: max-content;">
                    <span style="color: #f7df7b !important; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                        ✨ Panel Administrasi Utama
                    </span>
                </div>

                <h2 style="color: #ffffff !important; font-size: 22px; font-weight: 800; margin: 0; line-height: 1.2;">
                    Assalamu'alaikum, {{ auth()->user()->name ?? 'Admin Madrasah' }}!
                </h2>

                <p style="color: #d1fae5 !important; font-size: 13px; margin: 0; opacity: 0.95;">
                    Selamat datang di Dashboard MI Manba'ul Huda Sekaran. Hari ini {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}.
                </p>
            </div>

            <!-- Sisi Kanan: Box Semboyan -->
            <div style="background-color: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; padding: 12px 18px; text-align: right;">
                <span style="color: #f7df7b !important; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 2px;">
                    Semboyan Utama
                </span>
                <span style="color: #ffffff !important; font-family: 'Playfair Display', Georgia, serif; font-style: italic; font-size: 13px; font-weight: 600;">
                    "Ora Ninggal Tuntunan lan Ora Ketinggalan Zaman"
                </span>
            </div>

        </div>

    </div>
</x-filament-widgets::widget>
