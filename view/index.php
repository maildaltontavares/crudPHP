<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Carousel Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
  </head>
  <body>
  <header>
      <?php
       include_once "menuHome.php";
       ?>
</header>

<main role="main">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>      
      <li data-target="#myCarousel" data-slide-to="3"></li>         
 
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active"> 
           <img id="ed1" src="virtual3.jpg" height="100%"; width="100%"/> 
      </div>
      <div class="carousel-item">  
             <img id="ed1" src="virtual6.jpg" height="100%"; width="100%"/>  
      </div> 
      <div class="carousel-item">    
          <img id="ed1" src="descontos1.jpg"  height="100%"; width="100%"/> 
      </div>     
      <div class="carousel-item">  
          <img id="ed1" src="virtual5.jpg"  height="100%"; width="100%"/> 
      </div>    
 

    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
         <svg width="7cm" height="7cm" version="1.1" style="border: 1px solid;border-radius:  100%;"
         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <image href="roupas1.jpg"/></svg>
        <h2>Lojas</h2>
        <p>Encontre tudo que você procura aqui. Presenteie quem você ama. Conheça nossa variedade de lojas prontas para atendê-lo. Entre e divirta-se com suas compras.
        </p>
        <p><a class="btn btn-secondary" href="#" role="button">Ir para as compras &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
         <svg width="7cm" height="7cm" version="1.1" style="border: 1px solid;border-radius:  100%;"
         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <image href="eventos3.jpg"/></svg>
        <h2>Eventos</h2>
        <p>Nada melhor para aprimorar seus conhecimentos e enriquecer sua cultura que os eventos promovidos pelo Virtualize. Inscreva-se, participe. Promova.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Ir para os eventos &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
         <svg width="7cm" height="7cm" version="1.1" style="border: 1px solid;border-radius:  100%;"
         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <image href="servicos2.jpg"/></svg>
        <h2>Serviços</h2>
        <p>Nossa área de serviços cada vez mais completa para melhor servi-lo. Conheça nossa variedade.</p><br>
        <p><a class="btn btn-secondary" href="#" role="button">Conhecer os serviços &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
 

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
         <svg width="400px" height="400px" version="1.1"  
         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <image href="loja03.jpg" height="100%"; width="100%"/></svg>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
         <svg width="400px" height="400px" version="1.1"  
         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <image href="desfile02.jpg" height="100%"; width="100%"/></svg>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
         <svg width="400px" height="400px" version="1.1"  
         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <image href="bijouterias02.jpg" height="100%"; width="100%"/></svg>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-right"><a href="#">Início</a></p>
    <p>&copy; 2020-2020 Virtualize, Inc. &middot; <a href="#">Políticas</a> &middot; <a href="#">Termos</a></p>
  </footer>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script></body>
</html>
