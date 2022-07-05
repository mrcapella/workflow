<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>..:: Sistema ::..</title>
<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bostrap.min.css">
<script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://bootstrapcreative.com/wp-bc/wp-content/themes/wp-bootstrap/codepen/bootstrapcreative.js?v=11"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
    // executes when HTML-Document is loaded and DOM is ready

    // breakpoint and up  
    $(window).resize(function(){
        if ($(window).width() >= 980){	

            // when you hover a toggle show its dropdown menu
            $(".navbar .dropdown-toggle").hover(function () {
                $(this).parent().toggleClass("show");
                $(this).parent().find(".dropdown-menu").toggleClass("show"); 
            });

            // hide the menu when the mouse leaves the dropdown
            $( ".navbar .dropdown-menu" ).mouseleave(function() {
                $(this).removeClass("show");  
            });
    
            // do something here
        }	
    });
// document ready  
});
</script>
<style>
/* adds some margin below the link sets  */
.navbar .dropdown-menu div[class*="col"] {
    margin-bottom:1rem;
}

.navbar .dropdown-menu {
    border:none;
    background-color:#0060c8!important;
}

/* breakpoint and up - mega dropdown styles */
@media screen and (min-width: 992px) {
  
    /* remove the padding from the navbar so the dropdown hover state is not broken */
    .navbar {
    padding-top:0px;
    padding-bottom:0px;
    }

    /* remove the padding from the nav-item and add some margin to give some breathing room on hovers */
    .navbar .nav-item {
    padding:.5rem .5rem;
    margin:0 .25rem;
    }

    /* makes the dropdown full width  */
    .navbar .dropdown {position:static;}

    .navbar .dropdown-menu {
        width:100%;
        left:0;
        right:0;
        /*  height of nav-item  */
        top:45px;
        display:block;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.3s linear;  
    }
    
    /* shows the dropdown menu on hover */
    .navbar .dropdown:hover .dropdown-menu, .navbar .dropdown .dropdown-menu:hover {
        display:block;
        visibility: visible;
        opacity: 1;
        transition: visibility 0s, opacity 0.3s linear;
    }  
    .navbar .dropdown-menu {
        border: 1px solid rgba(0,0,0,.15);
        background-color: #fff;
    }
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(página atual)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Ação</a>
          <a class="dropdown-item" href="#">Outra ação</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Algo mais aqui</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Desativado</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>
  </div>
</nav>
</body>
</html>