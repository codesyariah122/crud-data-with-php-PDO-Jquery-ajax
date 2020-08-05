<?php require_once 'functions.php'; $dir='templates'; $content = 'contents'; ?>

<!-- interpolasi layout -->
<!-- ini header -->
<?php layout($dir, 'header', '.php') ?>

<!-- ini content -->
    <div class="container">
      
      <div class="row">

        <div class="col-md-5 mt-2 pt-2">
            <button id="add" class="btn btn-primary btn-lg mr-2">Add New Product</button>
        </div>

        <div class="col-md-12">
          <div id="viewdata"></div>
        </div>

      </div>
      
      <div class="container">
        <div class="row justify-content-center">
          <div col="col-xs-12">
            <div id="cruddata"></div>
          </div>
        </div>
      </div>


      <div id="animasi"></div>

    </div>
<!-- ini footer -->
<?php layout($dir, 'footer', '.php') ?>
