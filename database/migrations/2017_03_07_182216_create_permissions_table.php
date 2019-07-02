<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $data = [
                    [
                     'name' => 'Owner',
                     "created_at" =>  \Carbon\Carbon::now(),
                     "updated_at" => \Carbon\Carbon::now()
                    ],
                    [
                     'name' => 'Admin',
                     "created_at" =>  \Carbon\Carbon::now(),
                     "updated_at" => \Carbon\Carbon::now()
                    ],
                    [
                     'name' => 'Editor',
                     "created_at" =>  \Carbon\Carbon::now(),
                     "updated_at" => \Carbon\Carbon::now()
                    ],
                    [
                     'name' => 'User',
                     "created_at" =>  \Carbon\Carbon::now(),
                     "updated_at" => \Carbon\Carbon::now()
                    ]
                ];
        foreach ($data as $key => $value) {
            DB::table('permissions')->insert($value);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
