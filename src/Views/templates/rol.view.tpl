<section class="container-m row px-4 py-4">
  <h1>{{FormTitle}}</h1>
</section>

<section class="container-m row px-4 py-4">
  <form action="index.php?page=Roles_Rol&mode={{mode}}&rolescod={{rol.rolescod}}" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="rolescod">Código Rol</label>
      <input class="col-12 col-m-9" 
             type="text" 
             name="rolescod" 
             id="rolescod" 
             value="{{rol.rolescod}}" 
             {{#readonly}}readonly{{/readonly}}
             required />
      {{#rol.rolescod_error}}<div class="error">{{rol.rolescod_error}}</div>{{/rol.rolescod_error}}
    </div>
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="rolesdsc">Descripción</label>
      <input class="col-12 col-m-9" 
             type="text" 
             name="rolesdsc" 
             id="rolesdsc" 
             value="{{rol.rolesdsc}}" 
             required />
      {{#rol.rolesdsc_error}}<div class="error">{{rol.rolesdsc_error}}</div>{{/rol.rolesdsc_error}}
    </div>
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="rolesest">Estado</label>
      <select class="col-12 col-m-9" 
              name="rolesest" 
              id="rolesest" 
              {{#readonly}}disabled{{/readonly}}>
        <option value="ACT" {{#rol.rolesest_act}}selected{{/rol.rolesest_act}}>Activo</option>
        <option value="INA" {{#rol.rolesest_ina}}selected{{/rol.rolesest_ina}}>Inactivo</option>
      </select>
      {{#rol.rolesest_error}}<div class="error">{{rol.rolesest_error}}</div>{{/rol.rolesest_error}}
    </div>
    
    <div class="row my-4 align-center flex-end">
      {{#showCommitBtn}}
      <button class="primary" type="submit">Confirmar</button>
      &nbsp;
      {{/showCommitBtn}}
      <a href="index.php?page=Roles_RolesList" class="button">Cancelar</a>
    </div>
  </form>
</section>