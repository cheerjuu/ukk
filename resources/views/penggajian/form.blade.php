@extends('layouts.app')

@section('title', 'Tambah Penggajian')

@section('content')

<style>
    .slip-box {
        max-width: 950px;
        margin: auto;
        background: white;
        padding: 35px 45px;
    }

    .judul-slip {
        text-align: center;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .periode-slip {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 500;
    }

    .bagian {
        font-weight: bold;
        text-align: center;
        padding: 5px;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .kolom-slip {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 45px;
    }

    .baris {
        display: grid;
        grid-template-columns: 145px 1fr;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .baris label {
        margin: 0;
    }

    .input-slip {
        height: 34px;
    }

    .hasil-box {
        margin-top: 15px;
        padding: 10px 15px;
        border-radius: 4px;
        font-weight: bold;
        text-align: center;
    }

    .captcha-box {
        max-width: 330px;
        margin-top: 25px;
    }

    .captcha-judul {
        padding: 7px 10px;
        border-radius: 4px 4px 0 0;
        font-weight: 500;
    }

    .btn-submit {
        margin-top: 25px;
        min-width: 260px;
    }

    @media (max-width: 768px) {

        .slip-box {
            padding: 20px;
        }

        .kolom-slip {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .baris {
            grid-template-columns: 120px 1fr;
        }

        .btn-submit {
            width: 100%;
        }
    }
</style>


<div class="card border-0 shadow-sm">

    <div class="slip-box">

        {{-- JUDUL --}}
        <h4 class="judul-slip">
            SLIP GAJI KARYAWAN
        </h4>


        {{-- PERIODE --}}
        <div class="periode-slip">

            PERIODE

            {{ $periodeDipilih->start_date->format('d F Y') }}

            -

            {{ $periodeDipilih->end_date->format('d F Y') }}

        </div>


        <form action="{{ route('penggajian.store') }}"
              method="POST"
              id="formPenggajian">

            @csrf


            {{-- ID PERIODE --}}
            <input type="hidden"
                   name="payroll_period_id"
                   value="{{ $periodeDipilih->id }}">


            {{-- IDENTITAS KARYAWAN --}}
            <div class="mb-4">

                {{-- NAMA --}}
                <div class="baris">

                    <label>NAMA</label>

                    <select name="employee_id"
                            id="employee_id"
                            class="form-select input-slip"
                            required>

                        <option value="">
                            -- Pilih Karyawan --
                        </option>

                        @foreach ($karyawan as $data)

                            <option value="{{ $data->id }}"
                                    data-nik="{{ $data->employee_code }}"
                                    data-jabatan="{{ $data->position }}"
                                    data-gaji="{{ $data->basic_salary }}">

                                {{ $data->employee_name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- NIK --}}
                <div class="baris">

                    <label>NIK</label>

                    <input type="text"
                           id="nik"
                           class="form-control input-slip"
                           readonly>

                </div>


                {{-- JABATAN --}}
                <div class="baris">

                    <label>JABATAN</label>

                    <input type="text"
                           id="jabatan"
                           class="form-control input-slip"
                           readonly>

                </div>

            </div>



            {{-- PENGHASILAN DAN POTONGAN --}}
            <div class="kolom-slip">


                {{-- PENGHASILAN --}}
                <div>

                    <div class="bagian">
                        PENGHASILAN
                    </div>


                    {{-- GAJI POKOK --}}
                    <div class="baris">

                        <label>Gaji Pokok</label>

                        <input type="text"
                               id="gaji_pokok"
                               class="form-control input-slip"
                               value="Rp 0"
                               readonly>

                    </div>


                    {{-- LEMBUR --}}
                    <div class="baris">

                        <label>Lembur</label>

                        {{-- Yang dilihat user --}}
                        <input type="text"
                               id="lembur_tampil"
                               class="form-control input-slip"
                               value="Rp 0"
                               autocomplete="off">

                        {{-- Yang dikirim ke Laravel --}}
                        <input type="hidden"
                               name="overtime"
                               id="overtime"
                               value="0">

                    </div>


                    {{-- TOTAL PENGHASILAN --}}
                    <div class="baris mt-4">

                        <label>Total Penghasilan</label>

                        <input type="text"
                               id="total_penghasilan"
                               class="form-control input-slip"
                               value="Rp 0"
                               readonly>

                    </div>

                </div>



                {{-- POTONGAN --}}
                <div>

                    <div class="bagian">
                        POTONGAN
                    </div>


                    {{-- PINJAMAN --}}
                    <div class="baris">

                        <label>Pinjaman Karyawan</label>

                        {{-- Yang dilihat user --}}
                        <input type="text"
                               id="pinjaman_tampil"
                               class="form-control input-slip"
                               value="Rp 0"
                               autocomplete="off">

                        {{-- Yang dikirim ke Laravel --}}
                        <input type="hidden"
                               name="employee_loan"
                               id="employee_loan"
                               value="0">

                    </div>


                    {{-- TOTAL POTONGAN --}}
                    <div class="baris mt-4">

                        <label>Total Potongan</label>

                        <input type="text"
                               id="total_potongan"
                               class="form-control input-slip"
                               value="Rp 0"
                               readonly>

                    </div>

                </div>

            </div>



            {{-- GAJI BERSIH --}}
            <div class="hasil-box">

                <div class="row align-items-center">

                    <div class="col-md-6">
                        GAJI BERSIH
                    </div>

                    <div class="col-md-6">

                        <input type="text"
                               id="gaji_bersih"
                               class="form-control"
                               value="Rp 0"
                               readonly>

                    </div>

                </div>

            </div>



            {{-- CAPTCHA --}}
            <div class="captcha-box">

                <div class="captcha-judul">

                    Captcha :

                    <strong>
                        {{ $angka1 }} * {{ $angka2 }}
                    </strong>

                </div>

                <input type="number"
                       name="captcha"
                       class="form-control"
                       required>

                @error('captcha')

                    <small class="text-danger">
                        {{ $message }}
                    </small>

                @enderror

            </div>



            {{-- ERROR --}}
            @error('employee_id')

                <small class="text-danger d-block mt-2">
                    {{ $message }}
                </small>

            @enderror


            @error('overtime')

                <small class="text-danger d-block">
                    {{ $message }}
                </small>

            @enderror


            @error('employee_loan')

                <small class="text-danger d-block">
                    {{ $message }}
                </small>

            @enderror


            @error('payroll_period_id')

                <small class="text-danger d-block">
                    {{ $message }}
                </small>

            @enderror



            {{-- SUBMIT --}}
            <button type="submit"
                    class="btn btn-primary btn-submit">

                Submit

            </button>

        </form>

    </div>

</div>



<script>

    // =========================
    // AMBIL ELEMENT
    // =========================

    const karyawan =
        document.getElementById('employee_id');

    const nik =
        document.getElementById('nik');

    const jabatan =
        document.getElementById('jabatan');

    const gajiPokok =
        document.getElementById('gaji_pokok');

    const lemburTampil =
        document.getElementById('lembur_tampil');

    const lembur =
        document.getElementById('overtime');

    const pinjamanTampil =
        document.getElementById('pinjaman_tampil');

    const pinjaman =
        document.getElementById('employee_loan');

    const totalPenghasilan =
        document.getElementById('total_penghasilan');

    const totalPotongan =
        document.getElementById('total_potongan');

    const gajiBersih =
        document.getElementById('gaji_bersih');



    // =========================
    // FORMAT RUPIAH
    // =========================

    function formatRupiah(angka)
    {
        angka = Number(angka) || 0;

        return 'Rp ' +
            angka.toLocaleString('id-ID');
    }



    // =========================
    // AMBIL ANGKA DARI INPUT
    // =========================

    function ambilAngka(nilai)
    {
        return Number(
            String(nilai).replace(/[^0-9]/g, '')
        ) || 0;
    }



    // =========================
    // FORMAT INPUT LEMBUR
    // =========================

    lemburTampil.addEventListener('input', function ()
    {
        const nilai =
            ambilAngka(this.value);

        lembur.value = nilai;

        this.value =
            formatRupiah(nilai);

        hitungGaji();
    });



    // =========================
    // FORMAT INPUT PINJAMAN
    // =========================

    pinjamanTampil.addEventListener('input', function ()
    {
        const nilai =
            ambilAngka(this.value);

        pinjaman.value = nilai;

        this.value =
            formatRupiah(nilai);

        hitungGaji();
    });



    // =========================
    // HITUNG GAJI
    // =========================

    function hitungGaji()
    {
        const pilihan =
            karyawan.options[
                karyawan.selectedIndex
            ];


        const gaji =
            Number(
                pilihan?.dataset.gaji || 0
            );


        const nilaiLembur =
            Number(
                lembur.value || 0
            );


        const nilaiPinjaman =
            Number(
                pinjaman.value || 0
            );


        // Total Penghasilan
        const penghasilan =
            gaji + nilaiLembur;


        // Total Potongan
        const potongan =
            nilaiPinjaman;


        // Gaji Bersih
        const bersih =
            penghasilan - potongan;



        // Tampilkan Gaji Pokok
        gajiPokok.value =
            formatRupiah(gaji);


        // Tampilkan Lembur
        lemburTampil.value =
            formatRupiah(nilaiLembur);


        // Tampilkan Total Penghasilan
        totalPenghasilan.value =
            formatRupiah(
                penghasilan
            );


        // Tampilkan Pinjaman
        pinjamanTampil.value =
            formatRupiah(nilaiPinjaman);


        // Tampilkan Total Potongan
        totalPotongan.value =
            formatRupiah(
                potongan
            );


        // Tampilkan Gaji Bersih
        gajiBersih.value =
            formatRupiah(
                bersih
            );
    }



    // =========================
    // TAMPILKAN DATA KARYAWAN
    // =========================

    function tampilkanKaryawan()
    {
        const pilihan =
            karyawan.options[
                karyawan.selectedIndex
            ];


        // NIK
        nik.value =
            pilihan?.dataset.nik || '';


        // Jabatan
        jabatan.value =
            pilihan?.dataset.jabatan || '';


        // Hitung gaji
        hitungGaji();
    }



    // =========================
    // EVENT KARYAWAN
    // =========================

    karyawan.addEventListener(
        'change',
        tampilkanKaryawan
    );



    // =========================
    // SAAT HALAMAN DIBUKA
    // =========================

    tampilkanKaryawan();

</script>

@endsection