<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $struk->nomor_struk }} — Coffeineé</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root{--brown-900:#2C1A0E;--brown-800:#4A2C1A;--brown-600:#8B5A2B;--brown-400:#C47C3E;--brown-200:#E8D5B7;--brown-100:#F5EDE0;--cream:#FFFDF9;--text-light:#9B7550;}

        /* SCREEN STYLES */
        body { font-family: 'Inter', sans-serif; background: var(--brown-100); display: flex; flex-direction: column; min-height: 100vh; }
        .screen-wrap { max-width: 420px; margin: 40px auto; padding: 0 24px; flex: 1; }
        .screen-title { font-size: 18px; font-weight: 600; color: var(--brown-800); margin-bottom: 20px; text-align: center; }
        .screen-actions { display: flex; gap: 10px; margin-top: 20px; }
        .btn-print { flex: 1; background: var(--brown-800); color: white; border: none; padding: 13px; border-radius: 2px; font-size: 13px; font-weight: 500; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; font-family: 'Inter', sans-serif; transition: background .2s; }
        .btn-print:hover { background: var(--brown-600); }
        .btn-back { flex: 1; background: transparent; color: var(--brown-700); border: 1px solid var(--brown-400); padding: 13px; border-radius: 2px; font-size: 13px; font-weight: 500; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; font-family: 'Inter', sans-serif; text-decoration: none; display: flex; align-items: center; justify-content: center; transition: all .2s; }
        .btn-back:hover { border-color: var(--brown-600); color: var(--brown-800); }

        /* STRUK PAPER */
        .struk-paper {
            background: white;
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
            padding: 24px 20px;
            border-radius: 4px;
            box-shadow: 0 4px 24px rgba(44,26,14,.15);
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            position: relative;
        }
        /* Zigzag top & bottom */
        .struk-paper::before, .struk-paper::after {
            content: '';
            display: block;
            height: 10px;
            background: radial-gradient(circle at 5px -5px, transparent 5px, var(--brown-100) 5px) -5px 0 / 10px 10px repeat-x;
            position: absolute;
            left: 0; right: 0;
        }
        .struk-paper::before { top: -10px; }
        .struk-paper::after { bottom: -10px; transform: rotate(180deg); }

        .struk-brand { text-align: center; font-size: 20px; font-weight: 700; color: var(--brown-800); letter-spacing: 1px; margin-bottom: 2px; font-family: 'Inter', sans-serif; }
        .struk-sub { text-align: center; font-size: 10px; color: var(--text-light); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 14px; }
        .struk-divider { border: none; border-top: 1px dashed #ccc; margin: 10px 0; }
        .struk-row { display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 12px; color: #444; }
        .struk-row strong { color: #222; }
        .struk-items { margin: 8px 0; }
        .struk-item { margin-bottom: 8px; }
        .struk-item-name { font-size: 13px; font-weight: 600; color: #222; }
        .struk-item-detail { display: flex; justify-content: space-between; font-size: 12px; color: #666; padding-left: 10px; margin-top: 2px; }
        .struk-total { display: flex; justify-content: space-between; font-size: 15px; font-weight: 700; color: #111; padding: 10px 0; }
        .struk-footer { text-align: center; font-size: 11px; color: #888; margin-top: 10px; line-height: 1.7; }
        .struk-footer strong { color: var(--brown-600); font-size: 12px; }

        /* PRINT STYLES */
        @media print {
            body { background: white; }
            .screen-wrap { margin: 0; padding: 0; }
            .screen-title, .screen-actions { display: none !important; }
            .struk-paper { box-shadow: none; max-width: 100%; border-radius: 0; margin: 0; padding: 10px; }
            .struk-paper::before, .struk-paper::after { display: none; }
            @page { size: 80mm auto; margin: 0; }
        }
    </style>
</head>
<body>

<div class="screen-wrap">
    <div class="screen-title">Preview Struk</div>

    {{-- STRUK PAPER --}}
    <div class="struk-paper" id="struk">
        <div class="struk-brand">Coffeineé</div>
        <div class="struk-sub">Coffee Shop Digital · Jambi</div>

        <hr class="struk-divider">

        <div class="struk-row"><span>No. Struk</span><strong>{{ $struk->nomor_struk }}</strong></div>
        <div class="struk-row"><span>Kasir</span><strong>{{ $struk->kasir->nama }}</strong></div>
        <div class="struk-row"><span>Pelanggan</span><strong>{{ $pesanan->user->nama }}</strong></div>
        <div class="struk-row"><span>Tanggal</span><strong>{{ $struk->printed_at->format('d/m/Y H:i') }}</strong></div>
        <div class="struk-row"><span>Metode</span><strong>{{ strtoupper($pesanan->metode_pembayaran) }}</strong></div>

        <hr class="struk-divider">

        <div class="struk-items">
            @foreach($pesanan->detailPesanans as $detail)
            <div class="struk-item">
                <div class="struk-item-name">{{ $detail->menu->nama_menu }}</div>
                <div class="struk-item-detail">
                    <span>{{ $detail->jumlah }} × Rp {{ number_format((float)$detail->harga, 0, ',', '.') }}</span>
                    <span>Rp {{ number_format((float)$detail->subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <hr class="struk-divider">

        <div class="struk-total">
            <span>TOTAL</span>
            <span>{{ $pesanan->total_format }}</span>
        </div>

        <hr class="struk-divider">

        <div class="struk-footer">
            Terima kasih sudah berkunjung!<br>
            <strong>Selamat menikmati ☕</strong><br>
            <span style="font-size:10px">{{ now()->format('d/m/Y H:i:s') }}</span>
        </div>
    </div>

    {{-- ACTIONS (hidden saat print) --}}
    <div class="screen-actions">
        <button onclick="window.print()" class="btn-print">🖨️ Cetak Struk</button>
        <a href="{{ route('kasir.dashboard') }}" class="btn-back">← Dashboard</a>
    </div>
</div>

</body>
</html>
