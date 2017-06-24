<?php
    $page_title = trans('general.error.title-403');
    $page_description = trans('general.error.description-403');
?>

{{-- Emma you can use @extends('layouts.session_frozen') --}}

@extends('layouts.master')

@section('content')
    <h1>{{ trans('general.error.forbidden-403') }}</h1>
    <h3>{{ trans('general.error.client-error', ['error-code' => '403']) }}</h3>
    <hr style="width: 100%; color: black; height: 1px; background-color:black;">
    <h4>{{ trans('general.error.what-is-this') }}</h4>
    <div class="box-body">
        {{ trans('general.error.403-explanation') }}
    </div>
@endsection
