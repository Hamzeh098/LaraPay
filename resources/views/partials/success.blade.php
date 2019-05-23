@if(session('status'))
    <div class="alert alert-success">
        <p>{{session('status')}}</p>
    </div>
@endif