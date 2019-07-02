<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    // Roles này là define ra để xử lý, có thể làm 1 chức năng ở admin thêm vào cũng đc, mình k thích nên mình thêm lun ở đây
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->timestamps();
        });
        // Mỗi item ứng với mỗi route
        $data = [
            [
             'name' => 'index',
             'title' => 'View',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
             'name' => 'permissions.index',
             'title' => 'View',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
             'name' => 'permissions.create,permissions.store',
             'title' => 'Create',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
             'name' => 'permissions.edit,permissions.update',
             'title' => 'Edit',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
             'name' => 'permissions.destroy',
             'title' => 'Delete',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
             'name' => 'users.index',
             'title' => 'View',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
             'name' => 'users.create,users.store',
             'title' => 'Create',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
             'name' => 'users.edit,users.update',
             'title' => 'Edit',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
             'name' => 'users.destroy',
             'title' => 'Delete',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],

        ];
        foreach ($data as $key => $value) {
            DB::table('roles')->insert($value);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
