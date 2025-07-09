<h1>Administración de Usuarios</h1>

<section class="grid">
  <div class="row">
    <form class="col-12 col-m-8" action="index.php" method="get">
      <input type="hidden" name="page" value="Usuarios_Usuarios">
      <div class="flex align-center">
        <div class="col-8 row">
          <label class="col-3" for="useremail">Email</label>
          <input class="col-9" type="text" name="useremail" id="useremail" value="{{useremail}}" />
          
          <label class="col-3" for="userest">Estado</label>
          <select class="col-9" name="userest" id="userest">
            <option value="">Todos</option>
            <option value="ACT" {{#userest_ACT}}selected{{/userest_ACT}}>Activo</option>
            <option value="INA" {{#userest_INA}}selected{{/userest_INA}}>Inactivo</option>
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
        <th>Código</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Fecha Registro</th>
        <th>Estado</th>
        <th>Tipo</th>
        <th>
          <a href="index.php?page=Usuario_Usuario&mode=INS">Nuevo</a>
        </th>
      </tr>
    </thead>
    <tbody>
      {{#usuarios}}
      <tr>
        <td>{{usercod}}</td>
        <td>{{useremail}}</td>
        <td>{{username}}</td>
        <td>{{userfching}}</td>
        <td>{{userest}}</td>
        <td>{{usertipo}}</td>
        <td>
          <a href="index.php?page=Usuario_Usuario&mode=UPD&usercod={{usercod}}">Editar</a>
          <a href="index.php?page=Usuario_Usuario&mode=DEL&usercod={{usercod}}">Eliminar</a>
        </td>
      </tr>
      {{/usuarios}}
    </tbody>
  </table>
</section>