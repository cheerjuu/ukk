@extends('layouts.app')

@section('title', 'Penggajian')

@section('content')

<div class="mb-4">
    <h3>Penggajian</h3>

    <p class="text-muted mb-0">
        Pilih periode sebelum memasukkan data penggajian.
    </p>
</div>


<div class="card border-0 shadow-sm">

    <div class="card-body text-center py-5">

        <h5 class="mb-3">
            Tambah Data Penggajian
        </h5>

        <p class="text-muted">
            Pilih periode penggajian terlebih dahulu.
        </p>

        @if ($periode->count() > 0)

            <button type="button"
                    class="btn btn-primary px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#modalPeriode">

                Tambah Penggajian

            </button>

        @else

            <div class="alert alert-warning">
                Belum ada periode aktif.
                Silakan buat periode terlebih dahulu.
            </div>

            <a href="{{ route('periode.index') }}"
               class="btn btn-primary">

                Data Periode

            </a>

        @endif

    </div>

</div>



{{-- MODAL PILIH PERIODE --}}
<div class="modal fade"
     id="modalPeriode"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Pilih Periode
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <form action="{{ route('penggajian.create') }}"
                  method="GET">

                <div class="modal-body">

                    <label class="form-label">
                        Periode Penggajian
                    </label>

                    <select name="periode"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Periode --
                        </option>

                        @foreach ($periode as $data)

                            <option value="{{ $data->id }}">

                                {{ $data->period_name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        Lanjut

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- BOOTSTRAP JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

@endsection