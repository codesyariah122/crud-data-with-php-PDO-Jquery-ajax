<h1 class="text-primary text-center mt-4 pt-4">Product Table</h1>

<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Type keyword for this search the product ... " autocomplete="off"> <!-- <div id="loading"></div> -->

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
  <tbody id="product-data">
  </tbody>
</table>

<script type="text/javascript">
  $('#product-data').load('contents/product_data.php').fadeIn(1000);
</script>