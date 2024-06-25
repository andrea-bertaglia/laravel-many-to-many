@if (session('message'))
    <div class="alert alert-success my-4">
        {!! session('message') !!}
    </div>
@endif
