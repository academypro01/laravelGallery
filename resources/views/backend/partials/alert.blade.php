@if(\Illuminate\Support\Facades\Session::has('success'))
    <div class="alert alert-success my-2">
        <b>{{\Illuminate\Support\Facades\Session::get('success')}}</b>
    </div>
@elseif(\Illuminate\Support\Facades\Session::has('info'))
    <div class="alert alert-info my-2">
        <b>{{\Illuminate\Support\Facades\Session::get('info')}}</b>
    </div>
@elseif(\Illuminate\Support\Facades\Session::has('warning'))
    <div class="alert alert-warning my-2">
        <b>{{\Illuminate\Support\Facades\Session::get('warning')}}</b>
    </div>
@elseif(\Illuminate\Support\Facades\Session::has('danger'))
    <div class="alert alert-success my-2">
        <b>{{\Illuminate\Support\Facades\Session::get('danger')}}</b>
    </div>
@endif
