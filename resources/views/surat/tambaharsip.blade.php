@extends('layout/app')
@section('title')
    Tambah Arsip Surat | SiArsip
@endsection
@section('isiNavbar')
    Unggah Arsip Surat
@endsection
@section('isiNavbar2')
    Unggah Surat yang telah diterbitkan untuk diarsipkan. <br>
    Catatan : <br>
    <li> Gunakan File Berformat PDF </li>
@endsection
@section('content')
    <div class="col-md-12 col-lg-12 pt-5">
        {{-- <div class="row"> --}}
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="flex-wrap card-header">
                    <div class="header-title">
                        <h4 class="card-title">Unggah Surat</h4>      
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('simpan-arsip') }}" method="post" class="row g-3 needs-validation text-dark" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control text-dark" name="nomor_surat" id="validationCustom01" required>
                            <div class="invalid-feedback">
                                Harap Isi Bidang Ini.    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Judul Surat</label>
                            <input type="text" class="form-control text-dark" name="judul_surat" id="validationCustom02" required>
                            <div class="invalid-feedback">
                                Harap Isi Bidang Ini.    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">Kategori Surat</label>
                            <select class="form-select text-dark" id="validationCustom04" name="kategori_surat" required>
                                <option selected disabled value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['nama_kategori'] }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Silahkan Pilih Kategori Surat.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">File Surat</label>
                            <input type="file" class="form-control text-dark" name="file_surat" aria-label="file example" required
                                accept=".pdf" onchange="validateFile(this)">
                            <div class="invalid-feedback" id="file-error" style="display: none;">
                                Silahkan Upload File dengan ukuran maksimal 2 MB.
                            </div>
                            <div class="invalid-feedback" id="file-upload-error" >
                                Silahkan Upload File Surat.
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-light text-primary fw-bold btn-sm me-2" type="button" onclick="goBack()">Kembali</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        /*---------------------------------------------------------------------
                                        Form Validation
        -----------------------------------------------------------------------*/
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        // Form valid, biarkan formulir dikirim secara tradisional
                        form.submit();
                    }                    
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);

        /*---------------------------------------------------------------------
                                        Validate Form
        -----------------------------------------------------------------------*/
        function validateFile(input) {
            const maxSize = 2 * 1024 * 1024; // 2 MB dalam bytes
            const fileInput = input.files[0];

            if (!fileInput) {
                document.getElementById('file-upload-error').style.display = 'block';
                document.getElementById('file-error').style.display = 'none';
                input.setCustomValidity("invalid");
            } else if (fileInput.size > maxSize) {
                document.getElementById('file-error').style.display = 'block';
                document.getElementById('file-upload-error').style.display = 'none';
                input.setCustomValidity("invalid");
            } else {
                document.getElementById('file-upload-error').style.display = 'none';
                document.getElementById('file-error').style.display = 'none';
                input.setCustomValidity("");
            }
        }
        function goBack() {
            window.location.href = '/arsip-surat';
        }
    </script>
@endsection