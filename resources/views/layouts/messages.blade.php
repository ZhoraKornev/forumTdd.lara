@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp

@if ($errors->any())
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert-danger alert" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">x</span>
                    {{$errors->first()}}
                </button>
            </div>
        </div>
    </div>
@endif
@if (session('success'))
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert-success alert" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    {{session()->get('success')}}
                    <span aria-hidden="true">x</span>
                </button>
            </div>
        </div>
    </div>
@endif
