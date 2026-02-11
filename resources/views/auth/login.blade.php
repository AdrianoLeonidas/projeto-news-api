<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Entrar</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <div class="auth-wrap">
    <div class="card auth-card">
      <h1 class="auth-title">Entrar</h1>
      <p class="auth-sub">Acesse para gerenciar as notícias.</p>

      @if($errors->any())
        <div class="alert alert-error">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
          <label>Email</label>
          <input type="email" name="email" required autocomplete="username">
        </div>

        <div class="field">
          <label>Senha</label>
          <input type="password" name="password" required autocomplete="current-password">
        </div>

        <button class="btn btn-primary" type="submit" style="width:100%; justify-content:center;">
          Entrar
        </button>
      </form>
    </div>
  </div>
</body>
</html>
