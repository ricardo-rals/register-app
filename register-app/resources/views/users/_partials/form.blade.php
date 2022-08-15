@csrf
<input type="text" name="name" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
<input type="email" name="email" placeholder="E-mail:" value="{{ $user->email ?? old('email') }}">
<input type="password" name="password" placeholder="Senha:" >
<input type="text" name='phone_number' placeholder="Telefone:" value="{{ $user->phone_number ?? old('phone_number') }}">
<input type="date" name="birth_date">
<input type="file" name="image">
<button type="submit" >
    Enviar
</button>