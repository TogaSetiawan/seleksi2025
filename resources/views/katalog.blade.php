<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Diskon E-Katalog</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Inter', sans-serif;
            color: #333;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(45deg, #0d6efd, #0d9afd);
            border-bottom: none;
            padding: 1.5rem;
        }
        .card-header h4 {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
        }
        .form-control {
            border-radius: 8px;
            padding: 0.8rem;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.2);
            border-color: #86b7fe;
        }
        .result-card {
            background-color: #ffffff;
            border-top: 5px solid #198754;
        }
        .result-card .card-title {
            font-weight: 700;
        }
        .result-card table td:first-child {
            font-weight: 500;
            color: #6c757d;
        }
        .result-card .final-price-row {
            border-top: 2px dashed #e9ecef;
        }
        .result-card .final-price-label {
            font-weight: 700 !important;
            color: #212529 !important;
        }
        .result-card .final-price-value {
            color: #198754;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header text-white">
                        <h4><i class="bi bi-calculator-fill"></i> Kalkulator Diskon</h4>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <p class="card-text mb-4 text-muted">Masukkan detail pembelian untuk melihat total harga setelah diskon.</p>
                        
                        <form action="{{ route('katalog.hitung') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="harga_satuan" class="form-label fw-semibold">Harga Satuan (Rp)</label>
                                <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan') }}" placeholder="Contoh: 1000" required>
                                @error('harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="jumlah_pembelian" class="form-label fw-semibold">Jumlah Pembelian (Unit)</label>
                                <input type="number" class="form-control @error('jumlah_pembelian') is-invalid @enderror" id="jumlah_pembelian" name="jumlah_pembelian" value="{{ old('jumlah_pembelian') }}" placeholder="Contoh: 500" required>
                                @error('jumlah_pembelian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg mt-3">Hitung Total</button>
                            </div>
                        </form>
                    </div>
                </div>

                @isset($hasil)
                <div class="card mt-4 result-card">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="card-title text-success"><i class="bi bi-receipt"></i> Hasil Perhitungan</h5>
                        <hr class="mb-4">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td><i class="bi bi-box-seam me-2"></i>Jumlah Beli</td>
                                    <td class="text-end"><strong>{{ number_format($hasil['jumlah_pembelian'], 0, ',', '.') }}</strong> unit</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-cash me-2"></i>Total Awal</td>
                                    <td class="text-end">Rp {{ number_format($hasil['total_harga_awal'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-tag-fill me-2 text-success"></i>Diskon</td>
                                    <td class="text-end"><span class="badge bg-success-subtle text-success-emphasis rounded-pill fs-6">{{ $hasil['persentase_diskon'] }}%</span></td>
                                </tr>
                                 <tr>
                                    <td><i class="bi bi-arrow-down-circle me-2 text-success"></i>Potongan</td>
                                    <td class="text-end">- Rp {{ number_format($hasil['nilai_diskon'], 0, ',', '.') }}</td>
                                </tr>
                                <tr class="final-price-row">
                                    <td class="pt-4 final-price-label"><i class="bi bi-wallet-fill me-2"></i>Harga Akhir</td>
                                    <td class="pt-4 text-end fs-4 final-price-value">Rp {{ number_format($hasil['harga_akhir'], 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
</body>
</html>
