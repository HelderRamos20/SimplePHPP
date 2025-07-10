<h1>Administración de Roles</h1>

<section class="grid">
  <div class="row">
    <form class="col-12 col-m-8" action="index.php" method="get">
      <input type="hidden" name="page" value="Roles_RolesList">
      <div class="flex align-center">
        <div class="col-8 row">
          <label class="col-3" for="rolesdsc">Descripción</label>
          <input class="col-9" type="text" name="rolesdsc" id="rolesdsc" value="{{rolesdsc}}" />
          
          <label class="col-3" for="rolesest">Estado</label>
          <select class="col-9" name="rolesest" id="rolesest">
            <option value="">Todos</option>
            <option value="ACT" {{#rolesest_ACT}}selected{{/rolesest_ACT}}>Activo</option>
            <option value="INA" {{#rolesest_INA}}selected{{/rolesest_INA}}>Inactivo</option>
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
          <a href="index.php?page=Roles_RolesList&orderBy=rolescod&orderDescending={{#orderDescending}}0{{/orderDescending}}{{^orderDescending}}1{{/orderDescending}}">
            Código <i class="fas fa-sort-{{#orderDescending}}down{{/orderDescending}}{{^orderDescending}}up{{/orderDescending}}"></i>
          </a>
        </th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>
          <a href="index.php?page=Roles_Rol&mode=INS">Nuevo</a>
        </th>
      </tr>
    </thead>
    <tbody>
      {{#roles}}
      <tr>
        <td>{{rolescod}}</td>
        <td>{{rolesdsc}}</td>
        <td>{{rolesest}}</td>
        <td>
          <a href="index.php?page=Roles_Rol&mode=UPD&rolescod={{rolescod}}">Editar</a>
          <a href="index.php?page=Roles_Rol&mode=DEL&rolescod={{rolescod}}">Eliminar</a>
        </td>
      </tr>
      {{/roles}}
      {{^roles}}
      <tr>
        <td colspan="4">No hay roles registrados</td>
      </tr>
      {{/roles}}
    </tbody>
  </table>
</section>