<!DOCTYPE html>

<html lang="en">
<head>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Product Details</title>
<style>
table tr th{
    width: 30px;
}
</style>
</head>
<body>


<table class="table table-bordered table-striped" id="laravel_datatable">
   <thead>
      <tr>
         <th rowspan="2" align="center"><b>ID</b></th>

         <th rowspan="2" colspan="5" align="center" ><b>Title</b></th>
         <th rowspan="2" colspan="8" align="center"><b>Product Code</b></th>
      </tr>
      <tr>
          <td></td>
          <td></td>
          <td></td>
      </tr>
   </thead>
   <tbody>
       @foreach($products as $products)
       <tr>
       <td rowspan="2">{{$products->id}}</td>
       <td rowspan="2" colspan="5" align="center">{{$products->title}}</td>
       <td rowspan="2" colspan="8" align="center">{{$products->product_code}}</td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        </tr>
       @endforeach
   </tbody>
</table>

</body>
</html>
