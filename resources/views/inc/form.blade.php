@csrf
<input type="text" name="login" value="" placeholder="Login" class="form__login">
@error('login')
<div class="alert__error">{{$message}}</div>
@enderror

<input type="password" name="password" value="" placeholder="Password" class="form__password">
@error('password')
<div class="alert__error">{{$message}}</div>
@enderror
