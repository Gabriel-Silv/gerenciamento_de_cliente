<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Editar Senha</title>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">
            <h3>Editar Senha</h3>
          </div>
          <div class="card-body">
          <form action="<?php echo URL; ?>login/change_password" method="POST">
              <div class="form-group">
              <?php if(isset($message)) { ?>
               <div class="alert alert-danger"><?php echo $message['message'] ?></div>
               <?php } ?>
                <label for="current_password">Senha Atual:</label>
                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
              </div>
              <div class="form-group">
                <label for="new_password">Nova Senha:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
              </div>
              <div class="form-group">
                <label for="confirm_password">Confirme a Nova Senha:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
              </div>
              <button type="submit" name="submit_post" class="btn btn-primary">Alterar Senha</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>