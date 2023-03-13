@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('test/score') }}">
                        @csrf
                                <div class="card-body">
                                    @foreach($dt_question as $item)
                                        <div class="card">
                                            <div class="card-header">{{ $item->question_text }}</div>
                        
                                            <div class="card-body">
                                                <input type="hidden" name="question_id" value="{{ $item->id_question }}">
                                                {{-- <input type="hidden" name="questions[{{ $item->id_question }}]" value=""> --}}
                                                @foreach($item->questionOptions as $option)
                                                    <div class="form-check">
                                                        <input class="form-check-input" 
                                                            type="radio" 
                                                            {{-- name="option_id" --}}
                                                            name="questions[{{ $item->id_question }}]" 
                                                            id="option-{{ $option->id_option }}" 
                                                            value="{{ $option->id_option }}"
                                                            @if(old("questions.$item->id_question") == $option->id_option) 
                                                                checked 
                                                            @endif
                                                            >
                                                        <label class="form-check-label" for="option-{{ $option->id_option }}">
                                                            {{ $option->option_text }}
                                                        </label>
                                                    </div>
                                                @endforeach

                                                @if($errors->has("questions.$item->id_question"))
                                                    <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                        <strong>{{ $errors->first("questions.$item->id_question") }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection