@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">

                @php
                    $nilai=0;
                    $jumlah_soal=0
                @endphp
                @foreach($results as $result)
                @php
                    $nilai= 100*($result->achieved_score/$result->quiz_score);
                    $jumlah_soal+= $result->quiz_score;
                @endphp
                <div class="card-header">
                    <h4>
                    Hasil {{$result->title}}
                    </h4>
                    <h6>
                    Nama : {{$result->name}}
                    </h6>
                    <h6>
                    Soal : {{$result->quiz_score}}
                    </h6>
                    <h6>
                    Nilai : {{$nilai}}
                    </h6>
                </div>
                @endforeach

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
                            <th>Kunci Jawaban</th>
                            <th>Jawaban</th>
                            <th>Nilai</th>
                        </tr>
                        <?php
                        $no=1;
                        $nilai_soal =0;
                        $nilai_soal = 100*(1/$jumlah_soal);
                        ?>
                        @foreach ($data as $dt) 
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$dt->title}}</td>
                            <td>{{$dt->question }}</td>
                            <td>
                                @if($dt->correct == 'option_a') 
                                    Opsi A
                                @elseif ($dt->correct == 'option_b')
                                    Opsi B
                                @elseif($dt->correct == 'option_c')
                                    Opsi C
                                @else
                                    Opsi D
                                
                                @endif    
                            </td>
                            <td>
                                @if($dt->answer == 'option_a') 
                                    Opsi A
                                @elseif ($dt->answer == 'option_b')
                                    Opsi B
                                @elseif($dt->answer == 'option_c')
                                    Opsi C
                                @else
                                    Opsi D
                                
                                @endif    
                            </td>
                            <td>
                                @if($dt->ans_correct == 1) 
                                    {{ $nilai_soal }}
                                @else
                                    0
                                @endif</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
