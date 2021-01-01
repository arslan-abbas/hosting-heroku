<!DOCTYPE html>

<html lang="en">
<head>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Laravel DataTable Ajax Crud Tutorial - Tuts Make</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
    <h2>Laravel DataTable Ajax Crud Tutorial - <a href="https://www.tutsmake.com" target="_blank">TutsMake</a></h2>
    <br>
    <a href="https://www.tutsmake.com/how-to-install-yajra-datatables-in-laravel/" class="btn btn-secondary">Back to Post</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Add New</button>
    <a href="{{route('export-products')}}" style="float: right" class="btn btn-info ml-3" class="export-product" id="export-product">Export Products</a>
    <a href="{{route('export-products-pdf')}}" style="float: right" class="btn btn-success ml-3" class="export-product" id="export-product">Export Products PDF</a>
    <a href="{{route('download-zip-products-pdf')}}" style="float: right" class="btn btn-success ml-3" class="export-product" id="export-product">Download Zip</a>
    <br><br>

    <div class="modal fade bd-example-modal-xl" id="bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <div class="form-group product current-product" style="margin-bottom: 15px;">
                        <input type="hidden" name="product_id[]" id="product_id[]">
                        <label for="name" class="col-sm-1 control-label" style="float: left;margin-top: 5px;" align="right">Title</label>
                        <div class="col-sm-2" style="float: left">
                            <input type="text" class="form-control" id="title[]" name="title[]" placeholder="Enter Tilte" value="" maxlength="50" required="">
                        </div>
                        <label for="name" class="col-sm-2 control-label" style="float: left;margin-top: 5px;" align="right">Product Code</label>
                        <div class="col-sm-3" style="float: left">
                            <input type="text" class="form-control" id="product_code[]" name="product_code[]" placeholder="Enter Tilte" value="" maxlength="50" required="">
                        </div>
                        <label class="col-sm-1 control-label" style="float: left;margin-top: 5px;">Description</label>
                        <div class="col-sm-3" style="float: left">
                            <input type="text" class="form-control" id="description[]" name="description[]" placeholder="Enter Description" value="" required="">
                        </div>

                    </div>
                    <div class="form-group" >
                        <div class="col-sm-8" style="float: left">
                        </div>

                        <div class="col-sm-1" style="float: left;margin-top: 15px;">
                            <input class="btn btn-info btn btn_add" value="Add New Product" readonly>
                        </div>
                        <div class="col-sm-1" style="float: left;margin-top: 15px;">
                        </div>
                        <div class="col-sm-1" style="float: right;margin-top: 15px;">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="col-sm-12">
        <table class="table table-bordered table-striped" id="laravel_datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>S. No</th>
                <th>Title</th>
                <th>Product Code</th>
                <th>Description</th>

                <th>Action</th>
            </tr>
        </thead>
        </table>
    </div>
</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="modal fade bd-example-modal-xl" id="ajax-product-modal" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="productCrudModal"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" name="productForm" class="form-horizontal">
                           <input type="hidden" name="product_id" id="product_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-1 control-label" style="float: left">Title</label>
                                <div class="col-sm-2" style="float: left">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Tilte" value="" maxlength="50" required="">
                                </div>
                                <label for="name" class="col-sm-1 control-label" style="float: left">Product Code</label>
                                <div class="col-sm-3" style="float: left">
                                    <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Tilte" value="" maxlength="50" required="">
                                </div>
                                <label class="col-sm-1 control-label" style="float: left">Description</label>
                                <div class="col-sm-4" style="float: left">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" required="">
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="col-sm-1" style="float: right;margin-top: 15px;">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
                </div>
                </div>
        </div>
    </div>
</div>

</body>

<script>
 var SITEURL = '{{URL::to('')}}';
 $(document).ready( function () {
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('.btn_add').click(function(){
    $("#productForm").submit(function(e){
    return false;
    });
    var product_add=$('<div class="form-group product" style="margin-bottom: 15px;"> <input type="hidden" name="product_id[]" id="product_id"> <label for="name" class="col-sm-1 control-label" style="float: left;margin-top: 20px;" align="right">Title</label><div class="col-sm-2" style="float: left;margin-top: 15px;"><input type="text" class="form-control" id="title" name="title[]" placeholder="Enter Tilte" value="" maxlength="50" required=""></div><label for="name" class="col-sm-2 control-label" style="float: left;margin-top: 20px;" align="right">Product Code</label><div class="col-sm-3" style="float: left;margin-top: 15px;"><input type="text" class="form-control" id="product_code" name="product_code[]" placeholder="Enter Tilte" value="" maxlength="50" required=""></div><label class="col-sm-1 control-label" style="float: left;margin-top: 20px;">Description</label><div class="col-sm-3" style="float: left;margin-top: 15px;"><input type="text" class="form-control" id="description" name="description[]" placeholder="Enter Description" value="" required=""></div></div>');
   // $('.product').append(product_add);
    product_add.insertAfter('.current-product');
    $('product').removeClass('current-product');

  });

  $('#laravel_datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{url('product-list')}}",
         columns: [
                  {data: 'id', name: 'id', 'visible': false},
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  { data: 'title', name: 'title' },
                  { data: 'product_code', name: 'product_code' },
                  { data: 'description', name: 'description' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });

 /*  When user click add user button */
    $('#create-new-product').click(function () {
        $('#btn-save').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#productCrudModal').html("Add New Product");
        $('#ajax-product-modal').modal('show');
    });

   /* When click edit user */
    $('body').on('click', '.edit-product', function () {
      var product_id = $(this).data('id');
      $.get('product-list/' + product_id +'/edit', function (data) {
         $('#title-error').hide();
         $('#product_code-error').hide();
         $('#description-error').hide();
         $('#productCrudModal').html("Edit Product");
          $('#btn-save').val("edit-product");
          $('#ajax-product-modal').modal('show');
          //console.log(data.id);
          $('#product_id').val(data.id);
          $('#title').val(data.title);
          $('#product_code').val(data.product_code);
          $('#description').val(data.description);
      })
   });

    $('body').on('click', '#delete-product', function () {

        var product_id = $(this).data("id");

        if(confirm("Are You sure want to delete !")){
          $.ajax({
              type: "get",
              url: SITEURL + "/product-list/delete/"+product_id,
              success: function (data) {
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
        }
    });

   });

if ($("#productForm").length > 0) {
      $("#productForm").validate({

     submitHandler: function(form) {

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');

      $.ajax({
          data: $('#productForm').serialize(),
          url: SITEURL + "/product-list/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#productForm').trigger("reset");
              $('#bd-example-modal-xl').modal('hide');
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
</script>

</html>
