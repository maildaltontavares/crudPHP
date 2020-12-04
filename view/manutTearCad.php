<?php
 
  session_start();

  require_once '../config.php'; 
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00015');  
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Leituras"'); 
  endif;     

  include_once "menuNavCab.php";
   
  $paramDt =  $_SESSION['paramDt']; // Parametro de formato de data do banco de dados
 
  ?> 

 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>
   
 
<form method="POST"> 
  <div class="limiteTela" > 
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">OS Tecelagem</h1> 
        </div> 
    </div>   

    <button type="submit" name= "listar" class="btn btn-primary paramBt" id="listar">Gerar</button>
    
    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="dt_leitura">Data da abertura</label> 
          <input id="dt_leitura" name ="dt_leitura_inicial" type="date" required class="form-control"   >  
        </div> 
    </div> 

<!--
    <div class="form-row"> 
        <div class="form-group col-md-8">
            <label for="exampleFormControlSelect2">Turno</label>
            <select multiple class="form-control" id="exampleFormControlSelect2">
                   <option value='1'>A </option>';  
                   <option value='2'>B</option>'; 
                   <option value='2'>C</option>';
            </select>
         </div>        
    </div>  
-->

    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="turno">Turno</label>
          <select class="form-control" id="selecioneTurno" name="turno" >             
                 <option value="A">A</option>'                   
                 <option value="B">B</option>'  
                 <option value="C">C</option>'   
          </select> 
        </div> 
    </div>  

    <div class="form-row"> 
        <div class="form-group col-md-1">
          <label for="dt_leitura">Hora Início</label> 
          <input id="dt_leitura" name ="dt_leitura_inicial" type="text"   class="form-control simple-field-data-mask-selectonfocus" data-mask="00:00"  >  
        </div> 
    </div>

    <div class="form-row"> 
        <div class="form-group col-md-8" >
          <label for="turno">Tear</label>
          <select class="form-control" id="selecioneTurno" name="turno" >             
                   <option value='1'>301</option>';  
                   <option value='2'>302</option>'; 
                   <option value='1'>303</option>';  
                   <option value='2'>304</option>'; 
                   <option value='1'>305</option>';  
                   <option value='2'>306</option>'; 
                   <option value='1'>307</option>';  
                   <option value='2'>308</option>';  
          </select> 
        </div> 
    </div>   
    <div class="form-row"> 
        <div class="form-group col-md-3  ComboSelect"> 
            <table class="table table-hover">    
                <thead>
                  <tr>
                    <th scope="col-3">Motivos da parada</th>  
                    <th scope="col-1"></th>  
                  </tr>
                </thead>
                <tbody>  
 
                     <tr><td>Troca de Trama</td><td> <input type="checkbox"   ></td>''</tr>  
                     <tr><td>Mancha de Óleo</td><td> <input type="checkbox"    ></td>''</tr> 
                     <tr><td>Trama curta</td><td> <input type="checkbox"    ></td>''</tr> 
                     <tr><td>Cavalo</td><td> <input type="checkbox"    ></td>''</tr> 
                     <tr><td>Troca de Óleo</td><td> <input type="checkbox"   ></td>''</tr>  
                     <tr><td>Fio Torto</td><td> <input type="checkbox"    ></td>''</tr> 
                     <tr><td>Trama irreguar</td><td> <input type="checkbox"    ></td>''</tr> 
                     <tr><td>Ruptura</td><td> <input type="checkbox"    ></td>''</tr>                      

               </tbody> 
            </table>   
        </div> 
    </div>  

    <div class="form-row"> 
        <div class="form-group col-md-3 ComboSelect"> 
            <table class="table table-hover">    
                <thead>
                  <tr>
                    <th scope="col-3">Mecanicos</th>  
                    <th scope="col-1"></th>  
                  </tr>
                </thead>
                <tbody>  
 
                     <tr><td>João Maria</td><td> <input type="checkbox"   ></td>''</tr>  
                     <tr><td>Antonio Jose</td><td> <input type="checkbox"    ></td>''</tr> 
                     <tr><td>Paulo Henrique</td><td> <input type="checkbox"    ></td>''</tr>  
                     <tr><td>João Paulo</td><td> <input type="checkbox"   ></td>''</tr>  
                     <tr><td>Jose Claudio</td><td> <input type="checkbox"    ></td>''</tr> 
                     <tr><td>Henrique Antunes</td><td> <input type="checkbox"    ></td>''</tr>                      
                     <tr><td>Francisco Nildo</td><td> <input type="checkbox"   ></td>''</tr>  
                     <tr><td>Paulo Alves</td><td> <input type="checkbox"    ></td>''</tr> 
                     <tr><td>Carlos Silva</td><td> <input type="checkbox"    ></td>''</tr> 


               </tbody> 
            </table>   
        </div> 
    </div>    

    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="dt_leitura">Observação</label> 
          <input id="dt_leitura" name ="dt_leitura_inicial" type="text"   class="form-control"   >  
        </div> 
    </div>


    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="dt_leitura">Data Encerramento</label> 
          <input id="dt_leitura" name ="dt_leitura_inicial" type="date"   class="form-control"   >  
        </div> 
    </div>


    <div class="form-row"> 
        <div class="form-group col-md-1">
          <label for="dt_leitura">Hora Final</label> 
          <input id="dt_leitura" name ="dt_leitura_inicial" type="text"   class="form-control simple-field-data-mask-selectonfocus" data-mask="00:00"  >  
        </div> 
    </div>




  </div> 

<?php
 
  include_once "menuNavRodape.php";
?> 

</form>
 
 
  <script type="text/javascript" src="../bibliotecas/jQuery-Mask/src/jquery.mask.js"></script>
  <script type="text/javascript" src="../bibliotecas/jQuery-Mask/test/jquery.mask.test.js"></script>
