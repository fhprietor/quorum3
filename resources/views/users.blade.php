@foreach($users as $user)
    <p>{{$user->email}}{{$user->weight}}</p>
@endforeach
