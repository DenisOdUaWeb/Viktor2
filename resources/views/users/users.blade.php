<h1>FRendly urls testing</h1>

<h3>The users list :</h3>

<ul>
    @foreach($users as $user)
    <li><a href="/users/{{$user->email}}">{{$user->name}}</a> {{$user->email}}</li>
    @endforeach
</ul>

