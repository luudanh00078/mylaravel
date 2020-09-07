
@if(isset($error))
    {{ $error or ''}}
@endif
<form action="{{route('login')}}" method="post">
    @csrf
    <input type="text" name="username" placeholder="username">
    <input type="password" name="password" placeholder="password">
    <input type="submit"> 
</form>