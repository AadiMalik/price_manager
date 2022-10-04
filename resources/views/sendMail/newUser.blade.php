<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<h2 class="font-bold">Welcome to {{config('app.name')}}</h2>
<p>Your Email is {{$email}}</p>
<b>{{ $password }}</b>
<p>Click on this for login <a href="{{url('/login')}}">Click me !</a></p>
