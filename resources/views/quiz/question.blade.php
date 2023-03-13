@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">

                <div class="card-header">
                    <h4>
                    Tabel Data Soal
                    </h4>
                </div>

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
                    <table class="table">
                        <tr>
                            <th>No.</th>
                            <th>Judul</th>
                            <th>Soal</th>
                            <th>Opsi A</th>
                            <th>Opsi B</th>
                            <th>Opsi C</th>
                            <th>Opsi D</th>
                            <th>Jawaban Benar</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $no=1;
                        ?>
                        @foreach ($data as $dt) 
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$dt->title}}</td>
                            <td>{{$dt->question_text}}</td>
                            <td>{{$dt->option_a}}</td>
                            <td>{{$dt->option_b}}</td>
                            <td>{{$dt->option_c}}</td>
                            <td>{{$dt->option_d}}</td>
                            <td>
                                @if($dt->correct_option == 'option_a') 
                                    Opsi A
                                @elseif ($dt->correct_option == 'option_b')
                                    Opsi B
                                @elseif($dt->correct_option == 'option_c')
                                    Opsi C
                                @else
                                    Opsi D
                                
                                @endif    
                            </td>
                            <td>
                                <a href="{{ url('question/delete/'.$dt->id_question) }}" class="btn btn-danger btn-sm mb-2">  
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                    Tambah Soal
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('question/create') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="question_text" class="col-md-4 col-form-label text-md-end">{{ __('Teks Soal') }}</label>

                            <div class="col-md-6">
                                <input id="question_text" type="text" class="form-control @error('question_text') is-invalid @enderror" name="question_text" value="" required autocomplete="question_text" autofocus>

                                @error('question_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="option_a" class="col-md-4 col-form-label text-md-end">{{ __('Opsi A') }}</label>

                            <div class="col-md-6">
                                <input id="option_a" type="text" class="form-control @error('option_a') is-invalid @enderror" name="option_a" value="" required autocomplete="option_a" autofocus>

                                @error('option_a')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="option_b" class="col-md-4 col-form-label text-md-end">{{ __('Opsi A') }}</label>

                            <div class="col-md-6">
                                <input id="option_b" type="text" class="form-control @error('option_b') is-invalid @enderror" name="option_b" value="" required autocomplete="option_b" autofocus>

                                @error('option_b')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="option_c" class="col-md-4 col-form-label text-md-end">{{ __('Opsi C') }}</label>

                            <div class="col-md-6">
                                <input id="option_c" type="text" class="form-control @error('option_c') is-invalid @enderror" name="option_c" value="" required autocomplete="option_c" autofocus>

                                @error('option_c')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="option_d" class="col-md-4 col-form-label text-md-end">{{ __('Opsi D') }}</label>

                            <div class="col-md-6">
                                <input id="option_d" type="text" class="form-control @error('option_d') is-invalid @enderror" name="option_d" value="" required autocomplete="option_d" autofocus>

                                @error('option_d')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="correct_option" class="col-md-4 col-form-label text-md-end">{{ __('Jawaban Benar') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('correct_option') is-invalid @enderror" name="correct_option" id="correct_option">
                                    <option value="option_a">Opsi A</option>
                                    <option value="option_b">Opsi B</option>
                                    <option value="option_c">Opsi C</option>
                                    <option value="option_d">Opsi D</option>
                                </select>
                                @error('correct_option')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <input type="hidden" name="quiz_id" value="{{ $quiz_id }}" required autocomplete="option_d" autofocus>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    {{ __('Tambah Data') }}
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
