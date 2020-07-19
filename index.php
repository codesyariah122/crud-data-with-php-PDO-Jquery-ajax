<?php require_once 'functions.php'; $dir='templates'; ?>

<?php layout($dir, 'header', '.php') ?>
    <div class="container">
      
      <div class="row">

        <div class="col-md-5 mt-2 pt-2">
            <button id="add" class="btn btn-primary btn-lg mr-2">Add New Product</button>
        </div>

        <div class="col-md-12">
          <div id="viewdata"></div>
        </div>

      </div>

      <div col="col-md-4">
        <div id="cruddata"></div>
      </div>

      <div id="animated"></div>

    </div>
    
<?php layout($dir, 'footer', '.php') ?>