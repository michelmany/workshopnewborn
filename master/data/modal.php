<!-- MODAL CONFIRMAÇÃO DELETAR GENÉRICO -->
<script type="text/javascript">
  function confirm_modal(delete_url)
  {
    $('#modalDeletar').modal('show', {backdrop: 'static'});
    document.getElementById('delete_link').setAttribute('href' , delete_url);
  }
</script>


<!-- MODAL CONFIRMAÇÃO DELETAR SLIDE-->
<script type="text/javascript">
  function confirm_modal_del_slide(delete_url, nome_objeto)
  {
    $('#modalDeletar').modal('show', {backdrop: 'static'});
    document.getElementById('delete_link').setAttribute('href' , delete_url);
    $('.fraseConfirma').html('Você tem certeza que deseja deletar o slide <b>' + nome_objeto + '</b>?');
  }
</script>

<!-- MODAL CONFIRMAÇÃO DELETAR ÁLBUM-->
<script type="text/javascript">
  function confirm_modal_del_album(delete_url, nome_objeto)
  {
    $('#modalDeletar').modal('show', {backdrop: 'static'});
    document.getElementById('delete_link').setAttribute('href' , delete_url);
    $('.fraseConfirma').html('Você tem certeza que deseja deletar o álbum <b>' + nome_objeto + '</b>?<br>Automaticamente todas as imagens desse álbum serão excluídos!');
  }
</script>


<!-- Modal Deletar -->
<div id="modalDeletar" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Confirmação</h4>
          </div>
          <div class="modal-body">
              <p class="fraseConfirma">Você tem certeza que deseja excluir esta entrada?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
            <a id="delete_link" href="#" ><button type="button" class="btn btn-danger">Sim, excluir!</button></a>
          </div>
      </div>
  </div>
</div> 


<!-- Gallery Modal Image Album -->
  <div class="modal fade j_modal_show_img" id="gallery-image-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-gallery-image">
          <img id="imgedit" class="img-responsive" name="gallery_image"/>
        </div>
        
        <form name="image_update" class="j_btn_salva" method="post" action="">  
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                
                <div class="form-group">
                  <input type="hidden" id="imgid" name="imgid"> 
                  <label for="imgtitle" class="control-label">Título</label>
                  <input type="text" class="form-control" id="imgtitle" placeholder="Adicione um título" name="gallery_title" value="" maxlength="40">
                </div>  
                
              </div>
            </div>
                    
          </div>
          
          <div class="modal-footer modal-gallery-top-controls">
            <button type="button" class="btn btn-xs btn-white" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-xs btn-success">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  

  <!-- Gallery Delete Image (Confirm)-->
  <div class="modal fade" id="gallery-image-delete-modal" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <h4 class="modal-title">Confirmação</h4>
        </div>
        
        <div class="modal-body">
        
          Você deseja mesmo apagar esta imagem?
          
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Não</button>
          <button type="button" class="btn btn-danger">Sim, quero deletar</button>
        </div>
      </div>
    </div>
  </div>  

