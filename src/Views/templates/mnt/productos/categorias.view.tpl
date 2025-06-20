<section class="depth-2 px-2 py-2" >
    <h2>Mantenimiento de Categorias</h2>
</section>
<section class="WWList my-4">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Categoria</th>
                <th>Estado</th>
                <th>
                    <a href="index.php?page=Mantenimientos-Productos-Categoria&mode=INS&id=">Nuevo</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach categorias}}
            <td>{{id}}</td>
            <td>{{categoria}}</td>
            <td>{{estado}}</td>
            <td>
                <a href="index.php?page=Mantenimientos-Productos-Categoria&mode=UPD&id={{id}}">Ver</a>
                <a href="index.php?page=Mantenimientos-Productos-Categoria&mode=UPD&id={{id}}">Editar</a>
                <a href="index.php?page=Mantenimientos-Productos-Categoria&mode=DEL&id={{id}}">Eliminar</a>
            </td>
            </tr>
            {{endfor categorias}}
    </table>
</section>