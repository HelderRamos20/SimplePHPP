<section>
    <h2>Mensaje injectado por el controlador</h2>
    <p>{{mensaje}}</p>
    <table>
        <tr>
            <th>SKU</th>
            <TH>Descripcion</TH>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
        {{foreach productos}}
        <tr>
            <td>{{id}}</td>
            <td>{{descripcion}}</td>
            <td>{{precio}}</td>
            <td>{{stock}}</td>
        </tr>
        {{endfor productos}}
    </table>
    <ul>
        {{foreach carros}}
        <li>
            {{id}} - {{nombre}} - {{marca}} - {{estado}} 
        </li>
        {{endfor carros}}
    </ul>
</section>