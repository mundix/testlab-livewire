@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post Dashboard') }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @livewire('post-component');
        </div>
    </div>
</div>
@endsection
