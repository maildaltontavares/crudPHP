<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity=" sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <style>

                *{
                    margin:0px;
                    padding:0px;
                    font-family:'Arial';
                    }

                .menu{
                    width:100%;
                    height:55px; /* Altura da barra principal */
                    background-color: #000; 

                    }

                .menu>ul{
                    list-style:none;
                    position:relative;
                    margin-left:50px;
                    z-index: 999;
                    }
                .menu ul li{
                        width:150px;
                        float:left; 
                    }

                .menu a{
                    padding:15px;
                    display:block;
                    text-decoration: none;
                    background-color:  #000;/*Cor dos elementos do menu nivel 1*/
                    text-align:center;

                    }
                .menu ul ul{
                    list-style:none;
                    position:absolute;
                    visibility:hidden;

                    }
                .menu ul li:hover ul{
                    visibility:visible;
                    }

                .menu a:hover{
                    background-color:#f4f4f4; /* Cor do hover*/
                    }

                .menu ul ul li{
                    float:none;
                    border-bottom: solid 1px #ccc;
                    }
                .menu ul ul li a{
                    background-color:#d5f4e6;  
                    /* cor do corpo do menu */
                    }
                #bt_menu{
                    display: none;
                    }
                label[for='bt_menu']{
                    padding:5px;
                    background-color:#222;
                    color:#fff;
                    font-family:'Arial';
                    text-align:center;
                    font-size:30px;
                    cursor:pointer;
                    display:none;
                    width:50px;
                    height:50px;
                    }
                label[for='bt_menu']:hover{
                    background-color:#f4f4f4;
                    color:#aaa;
                    }
                @media (max-width: 500px) {
                .menu{
                    margin-left:-100%;
                    transition:all .4s;
                    }
                label[for='bt_menu']{
                    display:block;
                    }
                .menu>ul{
                    margin-left:0;
                    }
                .menu{
                    margin-top:5px;
                    }
                .menu ul li{
                    width:100%;
                    float:none;
                    }
                .menu ul ul{
                    position:static;
                    overflow:hidden;
                    max-height:0;
                    transition:all .4s;
                    }
                .menu ul li:hover ul{
                    height:auto;
                    max-height:200px;
                    transition:all .4s;
                    }
                #bt_menu:checked ~ .menu{
                    margin-left:0;
                    }
                }
    </style> 

    <title>SysMater</title>
  </head> 


<body>

    <header>
        
        <?php
            include "topo.php";
        ?>

    </header>    

    <input type="checkbox" id="bt_menu">
    <label for="bt_menu">&#9776;</label>
    <nav class="menu">
        <ul>
            <li> <a href="#">Cadastros</a>

                    <ul>

<!--                         <li> <a href="{%url 'add'%}">Usuarios</a> </li>-->

                        
                         <li> <a href="#">Loja</a></li>
                         <li> <a href="#">Produto</a></li>
                         <li> <a href="#">Evento</a></li>
                         


                <!--        <li> <a href="{%url 'home'%}">Home</a> </li>-->
                <!--        <li> <a href="{%url 'contato'%}">Contato</a> </li>-->
                    </ul>
             </li>
        </ul>
        <ul>
            <li> <a href="#">Movimentacoes</a>

                    <ul>
                         <li> <a href="">Tipo de Movimento</a> </li>
                         <li> <a href="">Gerencial</a> </li>
                         <li> <a href="">Fiscal</a> </li>



                    </ul>
             </li>
        </ul>
        <ul>
            <li> <a href="#">Relatórios</a>

                    <ul>
                         <li> <a href="">Movimentações</a> </li>
         
                    </ul>
             </li>
        </ul>       

        <ul>
            <li> <a href="#">Shopping</a>

                    <ul>
                         <li> <a href="selecioneTb.php">Tabelas</a> </li>
                         <li> <a href="lista_tp.php">Grupo Tabelas</a> </li>
                         <li> <a href="lista_paramtp.php">Parametrização Tabelas</a> </li>
                         



                    </ul>
             </li>
        </ul>  

        <ul>
            <li> <a href="#">Seguranca</a>

                    <ul>
                         <li> <a href="#">Função</a> </li>
                         <li> <a href="#">Grupo</a> </li>
                         <li> <a href="lista_usuarios.php">Usuario</a> </li>



                    </ul>
             </li>
        </ul>        

        <ul>
            <li> <a href="#">Help</a>

                    <ul>
                         <li> <a href="">Página Inicial</a> </li>



                    </ul>
             </li>
        </ul>

        <ul>            
            <li> <a href="logout.php" >Sair</a> </li>

             </li>
        </ul>

    </nav>
