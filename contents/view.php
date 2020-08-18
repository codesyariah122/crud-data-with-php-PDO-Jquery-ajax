<style type="text/css">
  .loader{
    width: 150px;
    position: absolute;
    top: 4.3rem;
    margin-left: 12rem;
    z-index: -1;
    display: none;
  }
</style>
<h1 class="text-primary text-center mt-4 pt-4">Product Table</h1>

<div class="row mt-3 mb-3 mx-auto">
  <div class="col-xs-12">
      <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Type keyword ... " autocomplete="off" autofocus>
      <img src="assets/img/animated.gif" class="loader">
  </div>
</div>

<div id="paging"></div>


<div id="modal-detail"></div>  

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Code</th>
      <th scope="col">Product Name</th>
      <th scope="col">Operation Table</th>
    </tr>
  </thead>
  <tbody id="product-data">
  </tbody>
</table>


<script type="text/javascript" src="assets/js/view.js"></script>