@extends('tampilan.app')
@section('title','Profile')
@section('content')

<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="row">

            <div class="col-md-6">

                @include('profile.partials.update-profile-information-form')

            </div>

            <div class="col-md-6">

                @include('profile.partials.update-password-form')

            </div>

        </div>

        <div class="row mt-3">

            <div class="col-md-12">

                @include('profile.partials.delete-user-form')

            </div>

        </div>

    </div>

</section>

@endsection