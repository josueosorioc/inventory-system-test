{{-- message --}}
@if (session('error'))
@php
    $message = session('error') ?? session('success');
@endphp
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    @if (is_array($message))
        @foreach ($message as $msg)
            &bullet; {!! $msg !!}<br>
        @endforeach
    @else
        {{ $message }}
    @endif
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif