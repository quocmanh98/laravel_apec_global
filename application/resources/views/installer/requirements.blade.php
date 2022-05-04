@extends('layouts.installer')

@section('title', trans('installer_messages.requirements.title'))

@section('page')

    <h2 class="h4 text-center">{{ trans('installer_messages.requirements.templateTitle') }}</h2>

    <ul class="list-group">
        @foreach($requirements as $extention => $enabled)
        <li class="list-group-item d-flex justify-content-between align-items-center {{ $enabled ? 'success' : 'error' }}">
            {{ $extention }}
            @if($enabled)
                <svg height="20pt" viewBox="-27 0 512 512.00052" width="20pt" xmlns="http://www.w3.org/2000/svg"><path d="m32.308594 256.488281c0 65.777344 32.679687 123.921875 82.6875 159.082031 8.8125 6.199219 9.28125 19.070313.816406 25.734376l-.238281.1875c-5.527344 4.351562-13.277344 4.640624-19.035157.597656-58.378906-41-96.539062-108.847656-96.539062-185.601563 0-124.496093 103.050781-225.5625 227.296875-226.625v32.316407c-106.414063 1.054687-194.988281 87.648437-194.988281 194.308593zm0 0" fill="#1ed688"/><path d="m233.230469.964844 59.375 40.613281c3.179687 2.175781 3.179687 6.867187 0 9.042969l-59.375 40.613281c-3.636719 2.488281-8.570313-.117187-8.570313-4.519531v-81.226563c0-4.40625 4.933594-7.007812 8.570313-4.523437zm0 0" fill="#1ab975"/><path d="m425.382812 255.511719c0-65.777344-32.683593-123.921875-82.691406-159.082031-8.8125-6.199219-9.28125-19.070313-.816406-25.734376l.238281-.1875c5.527344-4.351562 13.277344-4.640624 19.035157-.597656 58.382812 41 96.539062 108.847656 96.539062 185.601563 0 124.496093-102.875 225.5625-227.125 226.625v-32.316407c106.414062-1.054687 194.820312-87.644531 194.820312-194.308593zm0 0" fill="#1ed688"/><path d="m224.460938 511.035156-59.375-40.613281c-3.179688-2.175781-3.179688-6.867187 0-9.042969l59.375-40.613281c3.632812-2.488281 8.570312.117187 8.570312 4.519531v81.226563c0 4.40625-4.9375 7.011719-8.570312 4.523437zm0 0" fill="#1ab975"/><path d="m329.628906 230.820312-97.257812 80.65625-24.519532 20.335938c-5.777343 4.785156-13.089843 7.382812-20.527343 7.382812-1.238281 0-2.476563-.070312-3.726563-.214843-8.675781-1.019531-16.660156-5.621094-21.898437-12.617188l-37.820313-50.414062c-8.539062-11.386719-6.230468-27.550781 5.160156-36.105469 11.398438-8.539062 27.5625-6.230469 36.105469 5.160156l25.53125 34.042969.207031-.167969 105.828126-87.765625c10.964843-9.085937 27.222656-7.570312 36.3125 3.394531 9.089843 10.964844 7.570312 27.222657-3.394532 36.3125zm0 0" fill="#1ed688"/><path d="m329.628906 230.820312-97.257812 80.65625c-15.90625-7.941406-29.894532-18.917968-41.488282-32.597656l105.828126-87.765625c10.964843-9.085937 27.222656-7.570312 36.3125 3.394531 9.089843 10.964844 7.570312 27.222657-3.394532 36.3125zm0 0" fill="#35e298"/></svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20pt" height="20pt" x="0" y="0" viewBox="0 0 512 512.00052" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m32.308594 256.488281c0 65.777344 32.679687 123.921875 82.6875 159.082031 8.8125 6.199219 9.28125 19.070313.816406 25.734376l-.238281.1875c-5.527344 4.351562-13.277344 4.640624-19.035157.597656-58.378906-41-96.539062-108.847656-96.539062-185.601563 0-124.496093 103.050781-225.5625 227.296875-226.625v32.316407c-106.414063 1.054687-194.988281 87.648437-194.988281 194.308593zm0 0" fill="#d61e1e" data-original="#1ed688" style="" class=""/><path xmlns="http://www.w3.org/2000/svg" d="m233.230469.964844 59.375 40.613281c3.179687 2.175781 3.179687 6.867187 0 9.042969l-59.375 40.613281c-3.636719 2.488281-8.570313-.117187-8.570313-4.519531v-81.226563c0-4.40625 4.933594-7.007812 8.570313-4.523437zm0 0" fill="#b91a1a" data-original="#1ab975" style="" class=""/><path xmlns="http://www.w3.org/2000/svg" d="m425.382812 255.511719c0-65.777344-32.683593-123.921875-82.691406-159.082031-8.8125-6.199219-9.28125-19.070313-.816406-25.734376l.238281-.1875c5.527344-4.351562 13.277344-4.640624 19.035157-.597656 58.382812 41 96.539062 108.847656 96.539062 185.601563 0 124.496093-102.875 225.5625-227.125 226.625v-32.316407c106.414062-1.054687 194.820312-87.644531 194.820312-194.308593zm0 0" fill="#d61e1e" data-original="#1ed688" style="" class=""/><path xmlns="http://www.w3.org/2000/svg" d="m224.460938 511.035156-59.375-40.613281c-3.179688-2.175781-3.179688-6.867187 0-9.042969l59.375-40.613281c3.632812-2.488281 8.570312.117187 8.570312 4.519531v81.226563c0 4.40625-4.9375 7.011719-8.570312 4.523437zm0 0" fill="#b91a1a" data-original="#1ab975" style="" class=""/><path xmlns="http://www.w3.org/2000/svg" d="m329.628906 230.820312-97.257812 80.65625-24.519532 20.335938c-5.777343 4.785156-13.089843 7.382812-20.527343 7.382812-1.238281 0-2.476563-.070312-3.726563-.214843-8.675781-1.019531-16.660156-5.621094-21.898437-12.617188l-37.820313-50.414062c-8.539062-11.386719-6.230468-27.550781 5.160156-36.105469 11.398438-8.539062 27.5625-6.230469 36.105469 5.160156l25.53125 34.042969.207031-.167969 105.828126-87.765625c10.964843-9.085937 27.222656-7.570312 36.3125 3.394531 9.089843 10.964844 7.570312 27.222657-3.394532 36.3125zm0 0" fill="#d61e1e" data-original="#1ed688" style="" class=""/><path xmlns="http://www.w3.org/2000/svg" d="m329.628906 230.820312-97.257812 80.65625c-15.90625-7.941406-29.894532-18.917968-41.488282-32.597656l105.828126-87.765625c10.964843-9.085937 27.222656-7.570312 36.3125 3.394531 9.089843 10.964844 7.570312 27.222657-3.394532 36.3125zm0 0" fill="#b91a1a" data-original="#35e298" style="" class=""/></g></svg>
            @endif
        </li>
    @endforeach
    </ul>

    @if ( $next == true )
    <div class="d-block text-end mt-3">
        <a href="{{ route('install.permissions') }}" class="btn btn-success">
            {{ trans('installer_messages.requirements.next') }}
        </a>
    </div>
    @else
    <div class="d-block text-end mt-3">
        <a href="{{ url()->full() }}" class="btn btn-danger">
            {{ trans('installer_messages.requirements.current') }}
        </a>
    </div>
    @endif

@endsection
