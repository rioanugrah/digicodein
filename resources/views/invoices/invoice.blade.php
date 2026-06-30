{{-- <!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>{{ '#INV'.explode('-',$order->order_code)[1].'-'.explode('-',$order->order_code)[2] }}</title>
    <style>
        /* Tetapan Asas Dompdf */
        @page {
            margin: 0; /* Kita kawal margin secara manual untuk elemen dekoratif */
            size: a4;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        /* Dekorasi Jalur Tepi (Keren) */
        .sidebar-accent {
            position: absolute;
            top: 0;
            left: 0;
            width: 10px;
            height: 100%;
            background-color: #1a2a6c; /* Biru Gelap */
        }

        .container {
            padding: 40px 50px;
            margin-left: 10px;
        }

        /* Header */
        .header-table {
            width: 100%;
            margin-bottom: 40px;
        }

        .brand-name {
            font-size: 24px;
            font-weight: bold;
            color: #1a2a6c;
            letter-spacing: 1px;
        }

        .invoice-title {
            font-size: 32px;
            font-weight: 100;
            color: #ccc;
            text-align: right;
            text-transform: uppercase;
        }

        /* Maklumat Utama */
        .info-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .info-box {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .label {
            font-size: 9px;
            font-weight: bold;
            color: #1a2a6c;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: block;
        }

        /* Jadual Item */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th {
            background-color: #1a2a6c;
            color: #ffffff;
            padding: 12px 10px;
            text-align: left;
            text-transform: uppercase;
            font-size: 10px;
        }

        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #eeeeee;
        }

        .items-table tr:nth-child(even) {
            background-color: #fafafa;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* Ringkasan */
        .summary-table {
            width: 35%;
            margin-left: 65%;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 8px 5px;
        }

        .total-row {
            font-size: 16px;
            font-weight: bold;
            color: #1a2a6c;
            border-top: 2px solid #1a2a6c;
        }

        /* Bank & Nota */
        .bottom-section {
            margin-top: 50px;
        }

        .payment-info {
            width: 60%;
            font-size: 10px;
            border-left: 3px solid #1a2a6c;
            padding-left: 15px;
            color: #555;
        }

        .signature-area {
            width: 30%;
            text-align: center;
            margin-top: 40px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 5px;
            font-weight: bold;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            left: 50px;
            right: 50px;
            text-align: center;
            font-size: 9px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="sidebar-accent"></div>

    <div class="container">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td>
                    <div class="brand-name">DigiCodein</div>
                </td>
                <td class="invoice-title">Invoice</td>
            </tr>
        </table>

        <!-- Alamat -->
        <table class="info-table">
            <tr>
                <td width="40%">
                    <span class="label">Dari:</span>
                    <strong>DigiCodein</strong><br>
                    marketing@digicodein.com<br><br>
                </td>
                <td width="30%">
                    <span class="label">Kepada:</span>
                    <strong>{{ json_decode($order->payments->payment_billing)->first_name.' '.json_decode($order->payments->payment_billing)->last_name }}</strong><br>
                    {{ json_decode($order->payments->payment_billing)->email }}<br>
                    {{ json_decode($order->payments->payment_billing)->phone }}
                </td>
                <td width="30%" class="text-right">
                    <div class="info-box">
                        <span class="label">No. Invoice</span>
                        <div style="font-size: 14px; font-weight: bold;">{{ '#INV'.explode('-',$order->order_code)[1].'-'.explode('-',$order->order_code)[2] }}</div>
                        <br>
                        <span class="label">Tanggal Transaksi</span>
                        <div>{{ $order->created_at }}</div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Item -->
        <table class="items-table">
            <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="55%">Deskripsi</th>
                    <th width="10%" class="text-center">Unit</th>
                    <th width="15%" class="text-center">Harga</th>
                    <th width="15%" class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td><strong>{{ $item->order_item }}</strong></td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ 'Rp. '.number_format($item->price,0,',','.') }}</td>
                    <td class="text-right">{{ 'Rp. '.number_format($item->price*$item->quantity,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Ringkasan -->
        <table class="summary-table">
            <tr>
                <td>Subtotal</td>
                <td class="text-right">{{ 'Rp. '.number_format($order->total_price,0,',','.') }}</td>
            </tr>
            <tr>
                <td>Biaya Admin</td>
                <td class="text-right">Rp. 0</td>
            </tr>
            <tr class="total-row">
                <td>Total</td>
                <td class="text-right">{{ 'Rp. '.number_format($order->total_price,0,',','.') }}</td>
            </tr>
        </table>

        <div class="footer">
            Terima kasih atas kepercayaan anda. Sebarang pertanyaan mengenai invoice ini boleh dirujuk dalam tempoh 7 hari bekerja.
        </div>
    </div>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'Invoice #INV'.explode('-',$order->order_code)[1].'-'.explode('-',$order->order_code)[2] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Pengaturan khusus untuk PDF/Print */
        @media print {
            @page {
                margin: 0;
                size: auto;
            }
            body {
                background-color: white;
                padding: 0;
            }
            .no-print {
                display: none;
            }
            .print-container {
                box-shadow: none !important;
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                border-radius: 0 !important;
            }
            .print-padding {
                padding: 2rem !important;
            }
        }
    </style>
</head>
<body class="p-4 md:p-10">

    <!-- Kontainer Utama Invoice -->
    <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-xl overflow-hidden print-container">

        <!-- Header / Banner Atas -->
        <div class="bg-slate-800 p-10 text-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-xl">DC</div>
                    <span class="text-xl font-bold tracking-tight uppercase">DigiCodein</span>
                </div>
                <p class="text-slate-400 text-sm">Solusi Digital Terpercaya</p>
            </div>
            <div class="text-left md:text-right">
                <h1 class="text-4xl font-black tracking-tighter mb-1">INVOICE</h1>
                <p class="text-slate-400 font-mono text-sm">{{ '#INV'.explode('-',$order->order_code)[1].'-'.explode('-',$order->order_code)[2] }}</p>
            </div>
        </div>

        <div class="p-10 print-padding">
            <!-- Status & Tanggal -->
            <div class="flex flex-wrap justify-between items-center mb-10 pb-6 border-b border-slate-100">
                <div class="flex gap-8">
                    <div>
                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest mb-1">Tanggal Terbit</p>
                        <p class="text-slate-700 font-semibold">{{ $order->created_at }}</p>
                    </div>
                </div>
                <div class="mt-4 md:mt-0">
                    @switch($order->payments->payment_status)
                        @case('Unpaid')
                        <span class="bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-200">
                            WAITING PAYMENT
                        </span>
                            @break
                        @case('Paid')
                        <span class="bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-200">
                            PAID
                        </span>
                        @break
                        @case('Canceled')
                        <span class="bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-200">
                            CANCELED
                        </span>
                        @break
                        @case('Expired')
                        <span class="bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-200">
                            EXPIRED
                        </span>
                        @break
                        @default

                    @endswitch
                </div>
            </div>

            <!-- Informasi Pengirim & Penerima -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-blue-600 uppercase text-[10px] font-black tracking-[0.2em] mb-3">Penagih</h3>
                        <p class="font-bold text-xl text-slate-800">DigiCodein</p>
                        <p class="text-slate-500 text-sm leading-relaxed mt-2">
                            {{-- Jl. Sudirman No. 123, Lantai 5, SCBD<br>
                            Jakarta Selatan, Indonesia 12190<br> --}}
                            <span class="text-slate-400 italic">marketing@digicodein.com</span>
                        </p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-blue-600 uppercase text-[10px] font-black tracking-[0.2em] mb-3">Ditagihkan Kepada</h3>
                        <p class="font-bold text-xl text-slate-800">{{ json_decode($order->payments->payment_billing)->first_name.' '.json_decode($order->payments->payment_billing)->last_name }}</p>
                        <p class="text-slate-500 text-sm leading-relaxed mt-2">
                            {{ json_decode($order->payments->payment_billing)->email }}<br>
                            {{ json_decode($order->payments->payment_billing)->phone }}
                        </p>
                    </div>
                </div>
            </div>

            @php
                $totalPrice = [];
            @endphp

            <!-- Tabel Item -->
            <div class="mb-10">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-4 py-3 font-bold text-slate-700 uppercase text-[10px] tracking-wider rounded-l-lg">Layanan / Deskripsi</th>
                            <th class="px-4 py-3 font-bold text-slate-700 uppercase text-[10px] tracking-wider text-center">Qty</th>
                            <th class="px-4 py-3 font-bold text-slate-700 uppercase text-[10px] tracking-wider text-right">Harga</th>
                            <th class="px-4 py-3 font-bold text-slate-700 uppercase text-[10px] tracking-wider text-right rounded-r-lg">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($order->orderItems as $key => $item)
                        @php
                            array_push($totalPrice,$item->price*$item->quantity);
                        @endphp
                        <tr class="border-b border-slate-100 group">
                            <td class="px-4 py-6">
                                <p class="font-bold text-slate-800">{{ $item->order_item }}</p>
                                <p class="text-slate-400 text-xs mt-1">{{ $item->order_id }}</p>
                            </td>
                            <td class="px-4 py-6 text-center text-slate-600">{{ $item->quantity }}</td>
                            <td class="px-4 py-6 text-right text-slate-600 font-mono">{{ 'Rp. '.number_format($item->price,0,',','.') }}</td>
                            <td class="px-4 py-6 text-right font-bold text-slate-800 font-mono">{{ 'Rp. '.number_format($item->price*$item->quantity,0,',','.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Bagian Kalkulasi Akhir -->
            <div class="flex flex-col md:flex-row justify-between items-start mt-10 gap-8">
                <div class="w-full md:w-1/2 p-6 bg-slate-50 rounded-xl">
                    <h4 class="font-bold text-slate-800 text-xs uppercase tracking-widest mb-3">Metode Pembayaran</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between border-b border-slate-200 pb-2">
                            <span class="text-slate-500">Bank:</span>
                            @switch($order->payments->payment_method)
                                @case('QRISC')
                                <span class="font-bold text-slate-700">QRIS</span>
                                @break
                                @case('QRIS2')
                                <span class="font-bold text-slate-700">QRIS</span>
                                @break
                                @case('BCAVA')
                                <span class="font-bold text-slate-700">BCA</span>
                                @break
                                @case('MANDIRIVA')
                                <span class="font-bold text-slate-700">MANDIRI</span>
                                @break
                                @default
                            @endswitch
                            <!--<span class="font-bold text-slate-700">{{ $order->payments->payment_method }}</span>-->
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3 space-y-3">
                    <div class="flex justify-between text-slate-500 text-sm">
                        <span>Subtotal</span>
                        <span class="font-mono">{{ 'Rp. '.number_format(array_sum($totalPrice),0,',','.') }}</span>
                    </div>
                    <div class="pt-4 border-t-2 border-slate-200 flex justify-between items-center">
                        <span class="font-black text-slate-800 uppercase text-xs">Total Akhir</span>
                        <span class="text-2xl font-black text-blue-600 font-mono italic">{{ 'Rp. '.number_format(array_sum($totalPrice),0,',','.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer & Tanda Tangan -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-2 gap-10 items-end">
                <div class="text-sm text-slate-500 leading-relaxed italic border-l-4 border-blue-500 pl-4">
                    Catatan: Pembayaran dilakukan paling lambat 14 hari setelah invoice diterima. Hubungi kami untuk bantuan teknis lebih lanjut.
                </div>
            </div>
        </div>

        <!-- Garis Penutup -->
        <div class="bg-slate-800 h-2 w-full"></div>
    </div>

    <div class="max-w-4xl mx-auto mt-6 text-center no-print">
        <p class="text-slate-400 text-xs tracking-widest uppercase">&copy; {{ date('Y') }} DigiCodein</p>
    </div>

</body>
</html>
