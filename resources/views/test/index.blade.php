@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test</div>

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
                    @if(session('status'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>No.</th>
                            <th>Judul Tes</th>
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
                            <td>{{$dt->duration}} Menit</td>
                            <td>
                                <a href="{{ url('test/start/'.$dt->id_quiz) }}" class="btn btn-info btn-sm mb-2">
                                    Start Test 
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