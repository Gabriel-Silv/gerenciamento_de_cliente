<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Recuperar Senha</title>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">
            <h3>Recuperar Senha</h3>
          </div>
          <div class="card-body">
          <form action="<?php echo URL; ?>login/recover" method="POST">
              <div class="form-group">
              <?php if(isset($message)) { ?>
               <div class="alert alert-danger"><?php echo $message['message'] ?></div>
               <?php } ?>
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
              </div>
              <button type="submit" name="submit_post" class="btn btn-primary">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>