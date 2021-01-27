@extends('property.master')

@section('content')

    <div class="container my-3">
                <h1>Editar imóveis</h1>

                <?php
                $property = $property[0]
                ?>

                <form action="<?= url('/imoveis/update', ['id' => $property->id])?>" method="post">

                    <?= csrf_field();  ?>
                    <?= method_field('put'); ?>
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" value="<?php echo $property->title ?>"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" cols="30"
                                  rows="10" class="form-control"><?php echo $property->description ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rental_price">Valor de locação</label>
                        <input type="text" name="rental_price" id="rental_price"
                               value="<?php echo $property->rental_price ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sale_price">Valor de venda</label>
                        <input type="text" name="sale_price" id="sale_price" value="<?php echo $property->sale_price ?>"
                               class="form-control">
                    </div>


                    <button type="submit" class="btn btn-primary">Atualizar imóvel</button>

                </form>

        </div>
@endsection
