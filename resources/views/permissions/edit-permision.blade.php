@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1 class="pull-left">Permissions</h1>
  <h1 class="pull-right">
   <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('permissions.create') !!}">Add New</a>
 </h1>
</section>
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>
  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
       <form class="form-horizontal" role="form" action="{{ route('permissions.update', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
         <input name="_method" type="hidden" value="PATCH">
         @csrf
         <table class="table" id="permissions-table">
          <thead>
            <tr>
              <th>ROLE</th>
              <th>VIEW</th>
              <th>CREATE</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <td>Permissions</td>
              <td>
                <input type="checkbox" value="permissions.index" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="permissions.create,permissions.store" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="permissions.edit,permissions.update" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="permissions.destroy" name="permissions[]" />
              </td>
            </tr>

            <tr>
              <td>User</td>
              <td>
                <input type="checkbox" value="users.index" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="users.create,users.store" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="users.edit,users.update" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="users.destroy" name="permissions[]" />
              </td>
            </tr>

            <tr>
              <td>Product</td>
              <td>
                <input type="checkbox" value="products.index" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="products.create,products.store" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="products.edit,products.update" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="products.destroy" name="permissions[]" />
              </td>
            </tr>

            <tr>
              <td>Roles</td>
              <td>
                <input type="checkbox" value="roles.index" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="roles.create,roles.store" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="roles.edit,roles.update" name="permissions[]" />
              </td>
              <td>
                <input type="checkbox" value="roles.destroy" name="permissions[]" />
              </td>
            </tr>

          </tbody>
        </table>
        <button type="submit">Update</button>
      </form>
    </div>

  </div>
</div>
<div class="text-center">

</div>
</div>
@endsection
