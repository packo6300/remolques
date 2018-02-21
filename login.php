<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        include 'links.html';
        ?>
        <style>
/* Snippet One */

body {
    background-color: rgba(80, 99, 234, 0.53);
}

div.member_signin {
    text-align: center;
}

div.member_signin  i.fa.fa-user {
    color: #FFF;
    background-color: #FFD202;
    border-radius: 500px;
    font-size: 36px;
    padding: 15px 20px 15px 20px;
}

div.fa_user {
    margin-top: -47px;
    margin-bottom: 15px;
}

p.member {
    font-size: 19px;
    color: #888888;
    margin-bottom: 20px;
}

button.login {
    width: 100%;
    text-transform: uppercase;
}

form.loginform div.input-group {
    width: 100%;
}

form.loginform input[type="text"], form.loginform input[type="password"] {
    color: #6C6C6C;
    text-align: center;
}

p.forgotpass {
    margin-top: 10px;
}

p.forgotpass a {
    color: #F5683D;
}

</style>
    </head>
    <body>
        <div class="container" style="margin-top:10%">
  <div class="col-md-3 col-md-offset-4">
    <div class="panel member_signin">
      <div class="panel-body">
        <!--<div class="fa_user">
          <i class="fa fa-user"></i>
        </div>-->
        <p class="member">Remolques Aeropuerto</p>
        <form id="login" method="post" action="session/login.php" class="loginform"  role="form">
           <div class="form-group">
            <label for="exampleInputEmail1" class="sr-only">Ususario</label>
            <div class="input-group">
               <input type="text" id="inputEmail" class="form-control" placeholder="Usuario" required="" name="usuario" >
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" class="sr-only">Contraseña</label>
            <div class="input-group">
               <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" name="pss" required="">
            </div>
          </div>
            <button type="submit" class="btn btn-primary btn-md login">Entrar</button>
        </form>
        <!--<p class="forgotpass"><a href="#" class="small">Forgot Password?</a></p>-->
      </div>
    </div>
  </div>
</div>
    </body>
</html>