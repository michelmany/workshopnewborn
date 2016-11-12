
<!-- Declaração do formulário -->  
<form method="post" target="pagseguro" action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
          
    <!-- Campos obrigatórios -->  
    <input name="receiverEmail" type="hidden" value="vickateo@gmail.com">  
    <input name="currency" type="hidden" value="BRL">  

    <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
    <input name="itemId1" type="hidden" value="<?= $workshop_id; ?>">  
    <input name="itemDescription1" type="hidden" value="<?php htmlentities($workshop_nome, 0, 'UTF-8'); ?>">  
    <input name="itemAmount1" type="hidden" value="<?= number_format($workshop_investimento, 2, '.', ''); ?>">
    <input name="itemQuantity1" type="hidden" value="1">  
<!--     <input name="itemWeight1" type="hidden" value="1000"> -->

    <!-- Código de referência do pagamento no seu sistema (opcional) -->  
    <input name="reference" type="hidden" value="<?= $cad_id; ?>">  
      
    <!-- Informações de frete (opcionais) -->  
<!--     <input name="shippingType" type="hidden" value="1">  
    <input name="shippingAddressPostalCode" type="hidden" value="01452002">  
    <input name="shippingAddressStreet" type="hidden" value="Av. Brig. Faria Lima">  
    <input name="shippingAddressNumber" type="hidden" value="1384">  
    <input name="shippingAddressComplement" type="hidden" value="5o andar">  
    <input name="shippingAddressDistrict" type="hidden" value="Jardim Paulistano">  
    <input name="shippingAddressCity" type="hidden" value="Sao Paulo">  
    <input name="shippingAddressState" type="hidden" value="SP">  
    <input name="shippingAddressCountry" type="hidden" value="BRA">   -->

    <!-- Dados do comprador (opcionais) -->  
    <input name="senderName" type="hidden" value="<?= $cad_aluno; ?>">  
<!--     <input name="senderAreaCode" type="hidden" value="11">  
    <input name="senderPhone" type="hidden" value="56273440">   -->
    <input name="senderEmail" type="hidden" value="<?= $cad_email; ?>">  

    <!-- submit do form (obrigatório) -->  
    <input alt="Pague com PagSeguro" name="submit" type="submit" value="Pagar agora" class="btn btn-custom-pagamento" />  
    <br><br><p><small>Você será redirecionado para a página do Pagseguro.<br>Ambiente seguro de pagamento.</small></p>
          
</form>  
