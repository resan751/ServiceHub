<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;

            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
        }
    </style>
</head>

<body class=" font-jakarta bg-black3 flex">

    {{-- @section('content') --}}
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Form Transaksi Service</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('detail.store') }}" method="POST">
                        @csrf

                        <!-- Info User -->
                        <div class="mb-4">
                            <h5>Info Transaksi</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>User: {{ Auth::user()->username }}</label>
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                </div>
                            </div>
                        </div>

                        <!-- Barang Section -->
                        <div class="mb-4">
                            <h5>Pilih Barang</h5>
                            <div id="barang-container">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <select name="barang_id[]" class="form-select barang-select">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($barang as $item)
                                                <option value="{{ $item->id_barang }}">
                                                    {{ $item->nama_barang }} (Stok: {{ $item->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="jumlah_barang[]" class="form-control" placeholder="Jumlah" min="1">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="harga_satuan_barang[]" class="form-control" placeholder="Harga Satuan">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success add-barang">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jasa Section -->
                        <div class="mb-4">
                            <h5>Pilih Jasa</h5>
                            <div id="jasa-container">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <select name="jasa_id[]" class="form-select jasa-select">
                                            <option value="">Pilih Jasa</option>
                                            @foreach ($jasa as $item)
                                                <option value="{{ $item->id_jasa }}">
                                                    {{ $item->nama_jasa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="jumlah_jasa[]" class="form-control" placeholder="Jumlah" min="1">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="harga_satuan_jasa[]" class="form-control" placeholder="Harga Satuan">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success add-jasa">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    // Add Barang
                    $('.add-barang').click(function() {
                        let barangHtml = `
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select name="barang_id[]" class="form-select barang-select">
                            <option value="">Pilih Barang</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id_barang }}">
                                    {{ $item->nama_barang }} (Stok: {{ $item->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="jumlah_barang[]" class="form-control" placeholder="Jumlah" min="1">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="harga_satuan_barang[]" class="form-control" placeholder="Harga Satuan">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-item">-</button>
                    </div>
                </div>
            `;
                        $('#barang-container').append(barangHtml);
                    });

                    // Add Jasa
                    $('.add-jasa').click(function() {
                        let jasaHtml = `
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select name="jasa_id[]" class="form-select jasa-select">
                            <option value="">Pilih Jasa</option>
                            @foreach ($jasa as $item)
                                <option value="{{ $item->id_jasa }}">
                                    {{ $item->nama_jasa }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="jumlah_jasa[]" class="form-control" placeholder="Jumlah" min="1">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="harga_satuan_jasa[]" class="form-control" placeholder="Harga Satuan">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-item">-</button>
                    </div>
                </div>
            `;
                        $('#jasa-container').append(jasaHtml);
                    });

                    // Remove item
                    $(document).on('click', '.remove-item', function() {
                        $(this).closest('.row').remove();
                    });

                    // Auto-fill harga barang
                    $(document).on('change', '.barang-select', function() {
                        let selectedOption = $(this).find('option:selected');
                        let row = $(this).closest('.row');
                        let hargaInput = row.find('input[name="harga_satuan_barang[]"]');

                        if (selectedOption.val()) {
                            $.get(`/api/barang/${selectedOption.val()}/harga`, function(data) {
                                hargaInput.val(data.harga_barang);
                            });
                        }
                    });

                    // Auto-fill harga jasa
                    $(document).on('change', '.jasa-select', function() {
                        let selectedOption = $(this).find('option:selected');
                        let row = $(this).closest('.row');
                        let hargaInput = row.find('input[name="harga_satuan_jasa[]"]');

                        if (selectedOption.val()) {
                            $.get(`/api/jasa/${selectedOption.val()}/harga`, function(data) {
                                hargaInput.val(data.harga_jasa);
                            });
                        }
                    });
                });
            </script>
        @endpush
    {{-- @endsection --}}

</body>
</html>
