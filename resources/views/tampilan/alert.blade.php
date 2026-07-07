{{-- ============================= --}}
{{-- FLASH MESSAGE --}}
{{-- ============================= --}}

{{-- Success --}}
@if(session('success'))

<div class="alert alert-success alert-dismissible">

    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close">

        <span aria-hidden="true">&times;</span>

    </button>

    <h5 class="mb-2">

        <i class="fas fa-check-circle mr-2"></i>

        Berhasil

    </h5>

    <p class="mb-0">

        {{ session('success') }}

    </p>

</div>

@endif

{{-- Error --}}
@if(session('error'))

<div class="alert alert-danger alert-dismissible">

    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close">

        <span aria-hidden="true">&times;</span>

    </button>

    <h5 class="mb-2">

        <i class="fas fa-times-circle mr-2"></i>

        Gagal

    </h5>

    <p class="mb-0">

        {{ session('error') }}

    </p>

</div>

@endif

{{-- Warning --}}
@if(session('warning'))

<div class="alert alert-warning alert-dismissible">

    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close">

        <span aria-hidden="true">&times;</span>

    </button>

    <h5 class="mb-2">

        <i class="fas fa-exclamation-triangle mr-2"></i>

        Peringatan

    </h5>

    <p class="mb-0">

        {{ session('warning') }}

    </p>

</div>

@endif

{{-- Info --}}
@if(session('info'))

<div class="alert alert-info alert-dismissible">

    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close">

        <span aria-hidden="true">&times;</span>

    </button>

    <h5 class="mb-2">

        <i class="fas fa-info-circle mr-2"></i>

        Informasi

    </h5>

    <p class="mb-0">

        {{ session('info') }}

    </p>

</div>

@endif

{{-- Validation Error --}}
@if($errors->any())

<div class="alert alert-danger alert-dismissible">

    <button type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close">

        <span aria-hidden="true">&times;</span>

    </button>

    <h5 class="mb-3">

        <i class="fas fa-exclamation-circle mr-2"></i>

        Terjadi Kesalahan

    </h5>

    <ul class="mb-0 pl-3">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif