<?php 
require_once '../functions.php';


?>

<h1 class="text-primary text-center mt-4 pt-4">Product Table</h1>
    <div class="form-group">
        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Input search of keywords" autocomplete="off">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-search" id="search-data" type="submit" name="search">Search Data</button>
    </div>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Code</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product Price</th>
      <th scope="col">Operation Table</th>
    </tr>
  </thead>
  <tbody id="view-product">

  </tbody>
</table>

<script type="text/javascript">
  $('#search-data').hide();
  $('#view-product').load('contents/search_product.php').fadeIn(1000);
</script>