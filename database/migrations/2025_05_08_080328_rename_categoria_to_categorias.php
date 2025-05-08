<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCategoriaToCategorias extends Migration
{
    public function up()
    {
        Schema::rename('categoria', 'categorias');
    }

    public function down()
    {
        Schema::rename('categorias', 'categoria');
    }
}
