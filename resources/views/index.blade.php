<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Test Api Logger</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></head>
<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
<style>
    pre.sf-dump .sf-dump-compact, .sf-dump-str-collapse .sf-dump-str-collapse, .sf-dump-str-expand .sf-dump-str-expand { display: none; }
</style>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'logger') }}
        </a>
    </div>
</nav>

<main class="p-4">
    <div class="w-100 d-flex justify-content-between">
        <h3 class="text-center">Logger</h3>
        <form method="POST" action="{{ route('logs.delete') }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="form-group">
                <input type="submit" class="btn btn-danger delete-logs" value="Delete Logs">
            </div>
        </form>
    </div>
    <div class="list-group">
        @forelse ($logs as $key => $log)
            <div class="my-3 alert">
                <div class="row w-100">
                    <span class="col-md-3">
                       <button class="btn btn-success">{{$log->method}}</button>

                        <small class="col-md-2">
                            <b>{{$log->status_code}} - {{url($log->url)}}</b>
                        </small>
                    </span>
                    <div class="col-md-3">
                        <p class="mb-0"><b>Duration : </b>{{$log->duration * 1000}}ms<br />
                           {!! empty($log->models) ? '' : implode('<br />', explode(', ', $log->models)) !!}</p>
                    </div>
                    <div class= "col-md-3">
                        <p class="mb-0">
                            </b> {{$log->ip}}<br />
                            {{$log->created_at}}</p>
                    </div>
                    <div class="col-md-3 mb-1">
                        <p class="mb-0"><b>Controller :</b> {{ empty($log->controller) ? 'None' : $log->controller }}<br />
                            {{ empty($log->action) ? '' : $log->action }}</p>
                    </div>
                </div>
                <ul class="nav nav-tabs mt-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab_1_{{$key}}">Payload</a>
                    </li>
                    @if(config('log.payload_raw'))
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_2_{{$key}}">raw</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_3_{{$key}}"> Headers</a>
                    </li>
                    @if(config('log.response'))
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_4_{{$key}}">Response</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_5_{{$key}}">Response Headers</a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab_1_{{$key}}">
                        @dump(json_decode($log->payload, true))
                    </div>
                    @if(config('log.payload_raw'))
                        <div class="tab-pane fade" id="tab_2_{{$key}}">
                            <div class='alert-secondary p-3 mb-3'>{{$log->payload_raw}}</div>
                            <h5>Dump</h5>
                            <pre>@dump(json_decode($log->payload_raw, true))</pre>
                        </div>
                    @endif
                    <div class="tab-pane fade" id="tab_3_{{$key}}">
                        @dump(json_decode($log->headers, true))
                    </div>
                </div>
            </div>
        @empty
            <h5>
                Empty
            </h5>
        @endforelse
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
