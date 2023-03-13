@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>
                    Tabel Data Quiz
                    </h4>
                    <a href="{{ url('quiz/create/') }}" class="btn btn-success btn-sm mb-2">
                        Tambah 
                    </a>
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
                            <th>Title</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Durasi</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $no=1;
                        ?>
                        @foreach ($data as $dt) 
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$dt->title}}</td>
                            <td>{{$dt->from_time}}</td>
                            <td>{{$dt->to_time}}</td>
                            <td>{{$dt->duration}}</td>
                            <td>
                                <a href="{{ url('question/'.$dt->id_quiz) }}" class="btn btn-info btn-sm mb-2">
                                    Lihat Soal 
                                </a>
                                <a href="{{ url('quiz/edit/'.$dt->id_quiz) }}" class="btn btn-primary btn-sm mb-2">
                                    Edit 
                                </a>
                                <a href="{{ url('quiz/delete/'.$dt->id_quiz) }}" class="btn btn-danger btn-sm mb-2">  
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
