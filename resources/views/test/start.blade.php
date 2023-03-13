@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $quiz->title }}</strong><br>
                    Exam Time: {{$quiz->duration}} Minutes<br><br>
                    Timer: <div id="timer_style"><label id="minutes">00</label>:<label id="seconds">00</label></div>
                </div>

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
                                    <div class="card"> 
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach ($questions as $qt) 
                                        <div class="card-header">{{ $qt->question_text }}</div>
                                        <input type="hidden" name="quiz_id" value="{{ $quiz->id_quiz }}">
                                        <input id="start_time" type="hidden" name="start_time" value="{{$start_time}}" readonly required>
                    
                                        <div class="card-body">
                                               
                                                <select name="answer[{{$i++}}]" class="form-control" required>
                                                    <option selected disabled value>Pilihan Jawaban</option>
                                                    <option value="option_a">{{$qt->option_a}}</option>
                                                    <option value="option_b">{{$qt->option_b}}</option>
                                                    <option value="option_c">{{$qt->option_c}}</option>
                                                    <option value="option_d">{{$qt->option_d}}</option>
                                                </select>
                                        </div>
                                        @endforeach
                                    </div>
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
    <script>

        var minutesLabel = document.getElementById("minutes");
        var secondsLabel = document.getElementById("seconds");
        var totalSeconds = 0;
        setInterval(setTime, 1000);

        function setTime() {
            ++totalSeconds;
            secondsLabel.innerHTML = pad(totalSeconds % 60);
            minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
        }

        function pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
        }
        function myFunction() {
            window.setTime=null;
            window.pad=null;
            document.getElementById('timer_style').innerHTML="Time is Up!";
            document.getElementById('timer_style').style.color='red'
        }
        window.setTimeout(myFunction, {{$quiz->duration*60*1000}}).location = 'test';
    </script>
@endsection