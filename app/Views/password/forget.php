<?php
use App\Helpers\Sessao;
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?= asset(BOOTCSS) ?>">
  <link rel="stylesheet" href="<?= asset(IZOCSS) ?>">
  <script src="<?= asset(JQUERY) ?>"></script>
  <script src="<?= asset(IZOJS) ?>"></script>
  <link rel="stylesheet" href="<?=asset("css/password.css")?>">
  <link rel="shortcut icon" href="<?= asset("img/favicon.png") ?>" type="image/x-icon">
  <title>Reset Password</title>
  
</head>

<body class="d-flex justify-content-center flex-column align-items-center">

  <h1>Recuperação de senha</h1>
  <main class="p-5 rounded-3 d-flex justify-content-center align-items-center">
    <form action="<?=URL?>/password/forget" method="post">
    <?=Sessao::sms('password')?>
      <!-- <div class="alert alert-success">exito</div> -->
      <div class="mb-3">
        <label for="exampleInputText1" class="form-label fs-2">Email ou número</label>
        <input type="text" class="form-control bg-transparent .color text-white <?= $dados['error']?'is-invalid':'' ?>" id="exampleInputText1" aria-describedby="textHelp" placeholder="email ou número" name="info">
        <div id="textHelp" class="form-text">Insira o email ou número cadastrado no sistema</div>
      </div>
      <button type="submit" class="p-3 rounded-2" name="btn" value="submit">Submit</button>
    </form>
  </main>

  <script src="<?= asset(BOOTJS) ?>"></script>
  <script src="<?= asset(BOOTPOPPER) ?>"></script>
</body>

</html>