<section class="container-m row px-4 py-4">
  <h1>{{FormTitle}}</h1>
</section>

<section class="container-m row px-4 py-4">
  <form action="index.php?page=Funciones_Funcion&mode={{mode}}&fncod={{funcion.fncod}}" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="fncod">Código</label>
      <input class="col-12 col-m-9" 
             type="text" 
             name="fncod" 
             id="fncod" 
             value="{{funcion.fncod}}" 
             {{#readonly}}readonly{{/readonly}}
             required />
      {{#funcion.fncod_error}}<div class="error">{{funcion.fncod_error}}</div>{{/funcion.fncod_error}}
    </div>
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="fndsc">Descripción</label>
      <input class="col-12 col-m-9" 
             type="text" 
             name="fndsc" 
             id="fndsc" 
             value="{{funcion.fndsc}}" 
             required />
      {{#funcion.fndsc_error}}<div class="error">{{funcion.fndsc_error}}</div>{{/funcion.fndsc_error}}
    </div>
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="fntyp">Tipo</label>
      <select class="col-12 col-m-9" 
              name="fntyp" 
              id="fntyp" 
              {{#readonly}}disabled{{/readonly}}>
        <option value="GEN" {{#funcion.fntyp_gen}}selected{{/funcion.fntyp_gen}}>General</option>
        <option value="ESP" {{#funcion.fntyp_esp}}selected{{/funcion.fntyp_esp}}>Especial</option>
        <option value="ADM" {{#funcion.fntyp_adm}}selected{{/funcion.fntyp_adm}}>Administrativo</option>
      </select>
      {{#funcion.fntyp_error}}<div class="error">{{funcion.fntyp_error}}</div>{{/funcion.fntyp_error}}
    </div>
    
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="fnest">Estado</label>
      <select class="col-12 col-m-9" 
              name="fnest" 
              id="fnest" 
              {{#readonly}}disabled{{/readonly}}>
        <option value="ACT" {{#funcion.fnest_act}}selected{{/funcion.fnest_act}}>Activo</option>
        <option value="INA" {{#funcion.fnest_ina}}selected{{/funcion.fnest_ina}}>Inactivo</option>
      </select>
      {{#funcion.fnest_error}}<div class="error">{{funcion.fnest_error}}</div>{{/funcion.fnest_error}}
    </div>
    
    <div class="row my-4 align-center flex-end">
      {{#showCommitBtn}}
      <button class="primary" type="submit">Confirmar</button>
      &nbsp;
      {{/showCommitBtn}}
      <a href="index.php?page=Funciones_FuncionesList" class="button">Cancelar</a>
    </div>
  </form>
</section>