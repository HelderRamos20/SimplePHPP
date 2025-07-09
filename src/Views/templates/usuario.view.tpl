<section class="container-m row px-4 py-4">
  <h1>{{FormTitle}}</h1>
</section>

<section class="container-m row px-4 py-4">
  <form action="index.php?page=Usuario_Usuario&mode={{mode}}&usercod={{usuario.usercod}}" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="usercod">Código</label>
      <input class="col-12 col-m-9" readonly type="text" name="usercod" id="usercod" value="{{usuario.usercod}}" />
    </div>
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="useremail">Email</label>
      <input class="col-12 col-m-9" type="email" name="useremail" id="useremail" value="{{usuario.useremail}}" required />
      {{#usuario.error_useremail}}<div class="error">{{usuario.error_useremail}}</div>{{/usuario.error_useremail}}
    </div>
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="username">Nombre</label>
      <input class="col-12 col-m-9" type="text" name="username" id="username" value="{{usuario.username}}" required />
    </div>
    
    {{#showPasswordField}}
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="userpswd">Contraseña</label>
      <input class="col-12 col-m-9" type="password" name="userpswd" id="userpswd" required />
      {{#usuario.error_userpswd}}<div class="error">{{usuario.error_userpswd}}</div>{{/usuario.error_userpswd}}
    </div>
    {{/showPasswordField}}
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="userest">Estado</label>
      <select class="col-12 col-m-9" name="userest" id="userest">
        <option value="ACT" {{#usuario.userest_ACT}}selected{{/usuario.userest_ACT}}>Activo</option>
        <option value="INA" {{#usuario.userest_INA}}selected{{/usuario.userest_INA}}>Inactivo</option>
      </select>
    </div>
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="usertipo">Tipo</label>
      <select class="col-12 col-m-9" name="usertipo" id="usertipo">
        <option value="NOR" {{#usuario.usertipo_NOR}}selected{{/usuario.usertipo_NOR}}>Normal</option>
        <option value="CON" {{#usuario.usertipo_CON}}selected{{/usuario.usertipo_CON}}>Consultor</option>
        <option value="CLI" {{#usuario.usertipo_CLI}}selected{{/usuario.usertipo_CLI}}>Cliente</option>
      </select>
    </div>
    
    <div class="row my-4 align-center flex-end">
      <button class="primary" type="submit">Confirmar</button>
      <button type="button" id="btnCancelar">Cancelar</button>
    </div>
  </form>
</section>

<script>
  document.getElementById("btnCancelar").addEventListener("click", () => {
    window.location.href = "index.php?page=Usuarios";
  });
</script>