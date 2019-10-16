<?php

use App\Term;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $terms = [
            'angular',
            'javascript',
            'laravel',
            'php',
            'python',
            'react',
            'ruby',
            'sql',
            'vuejs',
        ];

        collect($terms)->each(function ($term) {
            Term::create([
                'text' => $term
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
