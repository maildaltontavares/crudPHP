<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Santana Textiles</title>
        <link href="css/styles.css" rel="stylesheet" /> 
        <link href="estiloVirtuax.css" rel="stylesheet" /> 

        <!--<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>-->
    </head>
    <body class="nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
           <!-- <a class="navbar-brand" href="index.php"><img src="virtualize2.png" width="182" height="52">  </a>-->
            <a class="navbar-brand" href="login.php"><img src="logoSantana2.jpg" width="150" height="60">  </a> 
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">&#9776;</i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Funcionalidade" aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">...<i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="login2.png"width="32" height="32" placeholder="login" /></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="alterarSenhaUsuario.php">Alterar senha</a>
                        <a class="dropdown-item" href="#">Preferências</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>   
             

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <div class="sb-sidenav-menu-heading">Industrial</div>
  
                            <!--
                            <a class="nav-link" href="index.html" href="lista_tabelas">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Cadastros
                            </a>-->  
   
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCadastros" aria-expanded="false" aria-controls="collapseCadastros">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> 
                                Cadastros >
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCadastros" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"> 
                                    
                                  
                                    <!--<a class="nav-link" href="pastas.php">Ler Pastas Aplic</a> -->
                                    <a class="nav-link" href="selecioneFilial.php">Alternar Filial</a>
                                    <a class="nav-link" href="selecioneTb.php">Tabelas</a>
                                    <a class="nav-link" href="solicitaWS.php">WebService</a>
                                    <a class="nav-link" href="solicitaWS2.php">WebService2</a> 
                                    
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMovim" aria-expanded="false" aria-controls="collapseMovim">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div> 
                                Movimentações >
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseMovim" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
 
                 
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Produção >
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="lista_leitura.php">Leituras Teares</a>         
                                            <a class="nav-link" href="manutTearCad.php">OS Manutenção</a> 
                                 
                                            
                                        </nav>
                                    </div>

 

                                </nav>
                            </div>  
 


                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRelat" aria-expanded="false" aria-controls="collapseRelat">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div> 
                                Relatórios >
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseRelat" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
 


                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#relatorios" aria-expanded="false" aria-controls="relatorios">
                                        Movimentos >
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="relatorios" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="leituraParamRel.php">Leituras</a>         
                                        </nav>
                                    </div>

                                </nav>
                            </div>  


    


                            <div class="sb-sidenav-menu-heading">Configurações</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Segurança >
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="lista_funcao.php">Funções</a>
                                    <a class="nav-link" href="lista_perfil.php">Perfis</a>
                                    <a class="nav-link" href="lista_grupoUsuario.php">Grupos</a>
                                    <a class="nav-link" href="lista_grupoTabela.php">Tabelas</a>
                                    <a class="nav-link" href="lista_usuarios.php">Usuários</a>
                                    <a class="nav-link" href="#">Usuários tabelas</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div> 
                                Diversos >
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Sistema >
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="lista_grupoEmpresa.php">Grupo Empresarial</a>
                                            <a class="nav-link" href="lista_filial.php">Filial</a>
                                            <a class="nav-link" href="lista_tp.php">Grupo de Tabela</a>
                                            <a class="nav-link" href="lista_paramtp.php">Parametrização Tabela</a>
                                            <a class="nav-link" href="selecioneTbSistema.php">Tabelas Configuração</a>
                                             
                                        </nav>
                                    </div>
                       
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Miscelânea</div>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Help
                            </a>

                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Logout
                            </a>
             
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logado como:</div>
                        <?php
                          if(isset($_SESSION['user'])):
                            echo  substr($_SESSION['user'], 0, 20)   . '</br>';  
                            echo $_SESSION['nomeFilial'];  
                          endif;
                        ?>  
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                  