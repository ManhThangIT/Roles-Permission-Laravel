<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_permissions', function (Blueprint $table) {
            $table->integer('permissions_id')->unsigned();
            $table->integer('roles_id')->unsigned();
            $table->foreign('permissions_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('roles_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['permissions_id', 'roles_id']);
            $table->timestamps();
        });

         $data = [
                    [
                        'permissions_id' => 1,
                        'roles_id'       => 1,  
                        "created_at" =>  \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now()
                    ],
                    [
                        'permissions_id' => 2,
                        'roles_id'       => 1,  
                        "created_at" =>  \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now()
                    ],
                    [
                        'permissions_id' => 3,
                        'roles_id'       => 1,  
                        "created_at" =>  \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now()
                    ]
                ];
            foreach ($data as $key => $value) {
                DB::table('users_permissions')->insert($value);
            }    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_permissions');
    }
}
