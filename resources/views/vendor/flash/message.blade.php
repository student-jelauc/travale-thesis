@php
    $flashNotifications = session('flash_notification', collect())->toArray();
@endphp

@if (count($flashNotifications))
    <div id="flash-messages" class="fixed-bottom">
        <div class="col-md-4 float-right ">
            @foreach (session('flash_notification', collect())->toArray() as $message)
                <div class="border-0 shadow-sm pt-3 pb-3 alert
                    alert-{{ $message['level'] }}
                {{ $message['important'] ? 'alert-important' : '' }}"
                     role="alert"
                >
                    @if ($message['important'])
                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-hidden="true"
                        >&times;
                        </button>
                    @endif

                    {!! $message['message'] !!}
                </div>
            @endforeach
        </div>
    </div>
@endif

{{ session()->forget('flash_notification') }}

@push('scripts')
    <script>
        $('#flash-messages div.alert').not('.alert-important').delay(5000).fadeOut(350);
    </script>
@endpush
