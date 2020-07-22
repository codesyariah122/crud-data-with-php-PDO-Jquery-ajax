<style>
  .loader{
    width:150px;
    position:absolute;
    top:-2rem;
    margin-left: -2rem;
    z-index:-1;
    display:none;
  }
  </style>

<h1 class="text-primary text-center mt-4 pt-4">Product Table</h1>
    
    <div class="form-group">
      <div class="row">
        <div class="col-xs-12">
          <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Type keywords to search the product ... " autocomplete="off">
        </div>
        <div class="col-md-4">
          <img src="assets/img/animated.gif" class="loader">
        </div>  
      </div>
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
  <tbody id="product-data">
  </tbody>
</table>

<script type="text/javascript">
  
  $('#product-data').load('contents/product_data.php').fadeIn(1000);

</script>
