<h1>Administración de Funciones</h1>

<section class="grid">
  <div class="row">
    <form class="col-12 col-m-8" action="index.php" method="get">
      <input type="hidden" name="page" value="Funciones_FuncionesList">
      <div class="flex align-center">
        <div class="col-8 row">
          <label class="col-3" for="fndsc">Descripción</label>
          <input class="col-9" type="text" name="fndsc" id="fndsc" value="{{fndsc}}" />
          
          <label class="col-3" for="fnest">Estado</label>
          <select class="col-9" name="fnest" id="fnest">
            <option value="">Todos</option>
            <option value="ACT" {{#fnest_ACT}}selected{{/fnest_ACT}}>Activo</option>
            <option value="INA" {{#fnest_INA}}selected{{/fnest_INA}}>Inactivo</option>
          </select>
        </div>
        <div class="col-4 align-end">
          <button type="submit">Filtrar</button>
        </div>
      </div>
    </form>
  </div>
</section>

<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>
          <a href="index.php?page=Funciones_FuncionesList&orderBy=fncod&orderDescending={{#orderDescending}}0{{/orderDescending}}{{^orderDescending}}1{{/orderDescending}}">
            Código <i class="fas fa-sort-{{#orderDescending}}down{{/orderDescending}}{{^orderDescending}}up{{/orderDescending}}"></i>
          </a>
        </th>
        <th>Descripción</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>
          <a href="index.php?page=Funciones_Funcion&mode=INS">Nuevo</a>
        </th>
      </tr>
    </thead>
    <tbody>
      {{#funciones}}
      <tr>
        <td>{{fncod}}</td>
        <td>{{fndsc}}</td>
        <td>{{fntyp}}</td>
        <td>{{fnest}}</td>
        <td>
          <a href="index.php?page=Funciones_Funcion&mode=UPD&fncod={{fncod}}">Editar</a>
          <a href="index.php?page=Funciones_Funcion&mode=DEL&fncod={{fncod}}">Eliminar</a>
        </td>
      </tr>
      {{/funciones}}
      {{^funciones}}
      <tr>
        <td colspan="5">No hay funciones registradas</td>
      </tr>
      {{/funciones}}
    </tbody>
  </table>
</section>