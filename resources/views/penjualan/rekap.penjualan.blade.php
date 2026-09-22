<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Penjualan</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f6f9;
            margin: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }
        /* Style Area Filter & Tombol */
        .controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            background: #eef2f5;
            padding: 15px;
            border-radius: 6px;
        }
        select, input, button {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            cursor: pointer;
            border: none;
            transition: background 0.3s;
        }
        .btn-filter {
            background-color: #007bff;
            color: white;
        }
        .btn-filter:hover {
            background-color: #0056b3;
        }
        .btn-print {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
        .btn-print:hover {
            background-color: #218838;
        }
        /* Style Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-row {
            font-weight: bold;
            background-color: #e9ecef !important;
        }

        /* Styling khusus saat mencetak (Print) */
        @media print {
            body {
                background: white;
                margin: 0;
            }
            .container {
                box-shadow: none;
                padding: 0;
                width: 100%;
                max-width: 100%;
            }
            .controls {
                display: none; /* Sembunyikan filter & tombol print saat dicetak */
            }
            th {
                background-color: #ddd !important;
                color: black !important;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Laporan Rekap Penjualan</h1>
    <div class="subtitle" id="periodeJudul">Semua Periode</div>

    <!-- Area Filter & Tombol Print -->
    <div class="controls">
        <label for="jenisRekap">Tipe Rekap:</label>
        <select id="jenisRekap" onchange="toggleFilterInput()">
            <option value="semua">Semua Data</option>
            <option value="harian">Harian</option>
            <option value="bulanan">Bulanan</option>
            <option value="tahunan">Tahunan</option>
        </select>

        <!-- Input dinamis tergantung tipe rekap -->
        <input type="date" id="inputTanggal" style="display:none;">
        <input type="month" id="inputBulan" style="display:none;">
        <input type="number" id="inputTahun" placeholder="Contoh: 2026" min="2000" max="2100" style="display:none;">

        <button class="btn-filter" onclick="filterData()">Tampilkan</button>
        <button class="btn-print" onclick="window.print()">🖨️ Print Laporan</button>
    </div>

    <!-- Tabel Rekap Penjualan -->
    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th style="width: 120px;">Tanggal</th>
                <th>Nama Produk</th>
                <th style="width: 80px;">Jumlah</th>
                <th style="width: 130px;">Harga Satuan</th>
                <th style="width: 150px;">Total</th>
            </tr>
        </thead>
        <tbody id="tabelBody">
            <!-- Data akan diisi oleh JavaScript -->
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right">Grand Total:</td>
                <td id="grandTotal" class="text-right">Rp 0</td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    // Data Sampel Penjualan
    const dataPenjualan = [
        { tanggal: "2026-03-01", produk: "Kopi Espresso", jumlah: 15, harga: 18000 },
        { tanggal: "2026-03-01", produk: "Roti Bakar", jumlah: 8, harga: 15000 },
        { tanggal: "2026-03-02", produk: "Matcha Latte", jumlah: 10, harga: 22000 },
        { tanggal: "2026-03-15", produk: "Kopi Latte", jumlah: 20, harga: 20000 },
        { tanggal: "2026-04-05", produk: "Croissant", jumlah: 12, harga: 25000 },
        { tanggal: "2025-12-20", produk: "Kopi Espresso", jumlah: 25, harga: 18000 }
    ];

    // Format angka ke Rupiah
    function formatRupiah(angka) {
        return "Rp " + angka.toLocaleString("id-ID");
    }

    // Mengubah pilihan input sesuai filter yang dipilih
    function toggleFilterInput() {
        const jenis = document.getElementById("jenisRekap").value;
        document.getElementById("inputTanggal").style.display = (jenis === "harian") ? "inline-block" : "none";
        document.getElementById("inputBulan").style.display = (jenis === "bulanan") ? "inline-block" : "none";
        document.getElementById("inputTahun").style.display = (jenis === "tahunan") ? "inline-block" : "none";
    }

    // Filter dan tampilkan data ke tabel
    function filterData() {
        const jenis = document.getElementById("jenisRekap").value;
        const tbody = document.getElementById("tabelBody");
        const periodeJudul = document.getElementById("periodeJudul");
        
        tbody.innerHTML = "";
        let totalKeseluruhan = 0;
        let filteredData = [];

        if (jenis === "harian") {
            const val = document.getElementById("inputTanggal").value;
            if (!val) return alert("Pilih tanggal terlebih dahulu!");
            filteredData = dataPenjualan.filter(item => item.tanggal === val);
            periodeJudul.innerText = `Periode Tanggal: ${val}`;
        } else if (jenis === "bulanan") {
            const val = document.getElementById("inputBulan").value; // Format: YYYY-MM
            if (!val) return alert("Pilih bulan dan tahun terlebih dahulu!");
            filteredData = dataPenjualan.filter(item => item.tanggal.startsWith(val));
            periodeJudul.innerText = `Periode Bulan: ${val}`;
        } else if (jenis === "tahunan") {
            const val = document.getElementById("inputTahun").value;
            if (!val) return alert("Masukkan tahun terlebih dahulu!");
            filteredData = dataPenjualan.filter(item => item.tanggal.startsWith(val));
            periodeJudul.innerText = `Periode Tahun: ${val}`;
        } else {
            filteredData = dataPenjualan;
            periodeJudul.innerText = "Semua Periode Data";
        }

        if (filteredData.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center">Data tidak ditemukan pada periode ini.</td></tr>`;
            document.getElementById("grandTotal").innerText = formatRupiah(0);
            return;
        }

        filteredData.forEach((item, index) => {
            const total = item.jumlah * item.harga;
            totalKeseluruhan += total;

            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td class="text-center">${index + 1}</td>
                <td class="text-center">${item.tanggal}</td>
                <td>${item.produk}</td>
                <td class="text-center">${item.jumlah}</td>
                <td class="text-right">${formatRupiah(item.harga)}</td>
                <td class="text-right">${formatRupiah(total)}</td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById("grandTotal").innerText = formatRupiah(totalKeseluruhan);
    }

    // Muat data awal saat halaman dibuka
    filterData();
</script>

</body>
</html>