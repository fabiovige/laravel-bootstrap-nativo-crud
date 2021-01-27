@extends('property.master')

@section('content')

    <div class="container my-3">
        <h1>Listar imóveis</h1>

        <?php
        echo "<table class='table table-striped table-hover'>";
        if (!empty($properties)) {
            echo "<thead class='bg-primary text-white'>
                <tr>
                        <td>Título</td>
                        <td>Valor de locação</td>
                        <td>Valor de compra</td>
                        <td>Ações</td>
                    </thead>
                </tr>";
            foreach ($properties as $property) {

                $linkReadMode = url('/imoveis/' . $property->slug);
                $linkEditItem = url('/imoveis/editar/' . $property->slug);
                $linkRemoveItem = url('/imoveis/remover/' . $property->slug);

                echo "<tr>
            <td>{$property->title}</td>
            <td>R$ " . number_format($property->rental_price, 2, ',', '.') . "</td>
            <td>R$ " . number_format($property->sale_price, 2, ',', '.') . "</td>
            <td><a href='{$linkReadMode}'>Ver mais</a> | <a href='{$linkEditItem}'>Editar</a> | <a href='{$linkRemoveItem}'>Remover</a></td>
        </tr>";

            }
        }

        echo "</table>";

        ?>

    </div>

@endsection
