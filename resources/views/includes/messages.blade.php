{{--
@if($errors->any())
<div class="alert alert-danger">
  <ul>
  @foreach($errors->all() as $error)
     <li> {{$error}} </li>
@endforeach
</ul>
</div>
@endif

@if(session('status'))
  <div class="alert alert-success mt-3">{{session('status')}}</div>
  @elseif(session('statusDelete'))
  <div class="alert alert-warning mt-3">{{session('statusDelete')}}</div>
@elseif(session('flash'))
  <div class="alert alert-danger text-center mt-3 flash">{{session('flash')}}</div>
@endif--}}

