<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rabi Gorkhali Assignment') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div id="app">
        @include('system.layouts.navbar')
        <main class="py-4">
            <div class="container">
                @if (isset($indexUrl) && $indexUrl == env('SYSTEM_PREFIX', '/system') . '/' . last(explode('/', url()->current())))
                    <a class="btn btn-sm btn-primary mb-1" href="{{ URL::to($indexUrl . '/create') }}">Create</a>
                @elseif(isset($indexUrl))
                    <a class="btn btn-sm btn-success mb-1" href="{{ URL::to($indexUrl) }}">Back</a>
                @endif
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __(ucfirst($title ?? '')) }}</div>
                            <div class="card-body">
                                <!-- Success Message -->
                                @if ($errors->first('alert-success'))
                                    <div id="successAlert" class="alert alert-success alert-dismissible fade show"
                                        role="alert">
                                        {{ $errors->first('alert-success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <!-- Danger Message -->
                                @if ($errors->first('alert-danger'))
                                    <div id="dangerAlert" class="alert alert-danger alert-dismissible fade show"
                                        role="alert">
                                        {{ $errors->first('alert-danger') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

{{-- SCRIPT --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
{{--NOTE FOR DEVELOPER: COMPILE WITH WEBPACK AND INSTEAD OF USING DIRECTLY, IMPORT COMPILED JS --}}
<script>
    // Auto-close the success alert after 5 seconds
    setTimeout(function() {
        $("#successAlert").alert('close');
    }, 5000);

    // Auto-close the danger alert after 5 seconds
    setTimeout(function() {
        $("#dangerAlert").alert('close');
    }, 5000);
</script>

{{-- DELETE MODAL SCRIPT --}}
<script>
    $(document).ready(function() {
        $(".delete-button").click(function() {
            var username = $(this).data("username");
            var actionUrl = $(this).data("actionurl");
            $("#confirmationText").text("Are you sure you want to delete username " + username + "?");
            $("#deleteForm").attr("action", actionUrl);
        });

    });
</script>
{{-- END DELETE MODAL SCRIPT --}}

{{-- SCRIPT --}}

</html>
