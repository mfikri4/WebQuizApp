@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit data pertanyaan') }}</div>

                @if(session('success'))
                    <span class="alert alert-success">{{session('success')}}</span>
                @endif
                @if(session('msg'))
                    <span class="alert alert-info">{{session('msg')}}</span>
                @endif
                @if(session('error'))
                    <span class="alert alert-danger">{{session('error')}}</span>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('quiz/edit/'.$data->id_quiz) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Judul Tes') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $data->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="from_time" class="col-md-4 col-form-label text-md-end">{{ __('Start Tes') }}</label>

                            <div class="col-md-6">
                                <input id="from_time" type="datetime-local" class="form-control @error('from_time') is-invalid @enderror" name="from_time" value="{{ $data->from_time }}" required autocomplete="from_time" autofocus>

                                @error('from_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="to_time" class="col-md-4 col-form-label text-md-end">{{ __('Selesai Tes') }}</label>

                            <div class="col-md-6">
                                <input id="to_time" type="datetime-local" class="form-control @error('to_time') is-invalid @enderror" name="to_time" value="{{ $data->to_time }}" required autocomplete="to_time" autofocus>

                                @error('to_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="duration" class="col-md-4 col-form-label text-md-end">{{ __('Durasi') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ $data->duration }}" required autocomplete="duration" autofocus>

                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    {{ __('Edit Data') }}
                                </button>
                                <a href="{{ url('quiz') }}" class="btn btn-secondary btn-sm">
                                    {{ __('Kembali') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
