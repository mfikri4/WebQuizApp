@extends('layouts.app')
@section('title')
    <title>My Results</title>
@endsection
@section('content')
<div class="conrainer">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(Auth::user()->role == 1)
                    Hasil Tes 
                    @else
                    Tes Terakhir
                    @endif
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
                    <div class="text-center">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul Tes</th>
                                <th scope="col">Jumlah Soal</th>
                                <th scope="col">Nilai</th>
                                @if(Auth::user()->role == 1)
                                    <th scope="col">User Name</th>
                                @endif
                                {{-- @if(session('user_role')=='admin')
                                    <th scope="col">User Name</th>
                                @endif --}}
                                <th scope="col">Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sl=1;
                                $nilai=0;
                            @endphp
                            @foreach($results as $result)
                                <tr>
                                    @php
                                        $nilai= 100*($result->achieved_score/$result->quiz_score);
                                    @endphp
                                    <th scope="row">{{$sl++}}</th>
                                    <td>{{$result->title}}</td>
                                    <td>{{$result->quiz_score}}</td>
                                    <td>{{$nilai}}</td>
                                    @if(Auth::user()->role == 1)
                                    <td>{{$result->name}}</td>     
                                    @endif
                                    {{-- @if(session('user_role')=='admin')
                                    <td>{{$result->name}}</td>     
                                    @endif  --}}
                                    <td>{{$result->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
