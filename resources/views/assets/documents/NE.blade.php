<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota de Encomenda {{$document->type}} - {{$document->number}}</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <img
        style="max-width: 200px;"
        src="{{$url=(!empty($setting->pic_path))? url("public/storage/logo-img/$setting->pic_path") : url("public/vendors/images/favicon-32x32.png")}}"
        alt=""
        class="mb-3 w-8 h-8 inline-block"
      />
      <div>
        <h2>NOTA DE ENCOMENDA</h2>
        <br>
        <h3 style="text-align: right;">ORIGINAL</h3>
      </div>
        <!-- QR CODE PRINT -->
        <!-- <div id="qrcode" align="center"></div> -->
    </div>
  <br>
    <table class="dados-client direita-tabela">
        <tr>
          <th>De</th>
          <th></th>
        </tr>
        <tr>
          <td>{{$setting->name_bs}}</td>
          <td></td>
        </tr>
        <tr>
          <td>NIF: {{$setting->nif}}</td>
          <td></td>
        </tr>
        <tr>
          <td>Endereço: {{substr($setting->address_bs, 0, 30)}}</td>
          <td></td>
        </tr>
        <tr>
          <td>Contacto: {{$setting->phone_bs}}</td>
          <td></td>
        </tr>
        {{-- <tr>
          <td>Email: marcelo@setmark.org</td>
          <td></td>
        </tr> --}}
    </table>

    <table align="right" class="dados-client">
        <tr>
          <th>Cobrar a</th>
          <th></th>
        </tr>
        <tr>
          <td>{{(empty($document->client_id)) ? "COMSUMIDOR FINAL" : $document->clients->name}}</td>
          <td></td>
        </tr>
        <tr>
          <td>NIF: {{(empty($document->client_id)) ? "XXXX XXX XXX" : $document->clients->code}}</td>
          <td></td>
        </tr>
        <tr>
          <td>Endereço:{{(empty($document->client_id)) ? "XXX XXX XXX" : substr($document->clients->address, 0, 30); }} </td>
          <td></td>
        </tr>
        <tr>
          <td>Contacto: {{(empty($document->client_id)) ? "XXX XXX XXX" : $document->clients->phone}}</td>
          <td></td>
        </tr>
        {{-- <tr>
          <td>Email: </td>
          <td></td>
        </tr> --}}
    </table>
<br>
<br>
    <table class="servico">
        <tr>
          <th class="th-serv" >N/O</th>
          <th class="th-serv" >Emitido Por</th>
          <th class="th-serv" >Moeda</th>
          <th class="th-serv" >Data de Emissão</th>
          <th class="th-serv" >Data de Vencimento</th>
        </tr>
        <tr>
          <td class="td-serv"># {{$document->type}} - {{$document->number}}</td>
          <td class="td-serv">{{$document->users->name}}</td>
          <td class="td-serv">{{$setting->coin}}</td>
          <td class="td-serv">{{$document->date}}</td>
          <td class="td-serv">{{$document->date_due}}</td>
        </tr>
    </table>
    <br>
    <table class="servico">
        <tr>
          <th class="th-itens th-serv" >Descrição</th>
          <th class="th-itens th-serv" >QTD</th>
          <th class="th-itens th-serv" >Preço <br> Unitário</th>
          <th class="th-itens th-serv" >Descontos</th>
          <th class="th-itens th-serv" >IVA/C</th>
          <th class="th-itens th-serv" >Total</th>
        </tr>
      
        <!-- LOOP PHP START -->
        @foreach ($itens as $row)
          <tr>
            <td class="td-serv" style="">{{$row->title}}</td>
            <td class="td-serv" style="text-align: center;">{{$row->qtd}} {{$row->unit}} </td>
            <td class="td-serv" style="text-align: center;">{{$row->net_total}}</td>
            <td class="td-serv" style="text-align: center;">{{$row->discount_for_itens}}</td>
            <td class="td-serv" style="text-align: center;">{{$row->impost}}</td>
            <td class="td-serv" style="text-align: center;">{{$row->gross_total}}</td>
          </tr>
        @endforeach
       <!-- LOOP PHP END -->
    </table>
     <br>
     
     <div style="display: flex; justify-content: space-between; align-items: top; ">
      <div class="">
        <table  style="width: 100%;">
          <td><strong> Resumo de Impostos </strong></td>
        </table>
        <table class="servico" style="width: 300px;">
          <thead style="height: 25px">
            <th class="th-serv"> <strong>Descrição</strong> </th>
            <th class="th-serv"><strong>Taxa</strong></th>
            <th class="th-serv"><strong>Imposto</strong></th>
          </thead>
          <tbody >
            @foreach ($tax as $row)
              <tr style="height: 25px">
                <td class="td-serv">IVA - {{ ($row->percent==0) ? "Isento" : $row->percent }}</td>
                <td class="td-serv">{{$row->percent}}%</td>
                <td class="td-serv">{{number_format($row->total,2)}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <table align="right" style="width: 40%;">
          <td class="td-item"><strong> SUBTOTAL </strong></td>
          <td class="td-item">{{number_format($total["sub"],2)}}</td>
        </tr>
        <tr>
          <td class="td-item"><strong> TOTAL DESCONTOS </strong></td>
          <td class="td-item">{{ number_format($total["discount"],2)}}</td>
        </tr>
        <tr>
          <td class="td-item"><strong> IVA </strong></td>
          <td class="td-item">{{number_format($total["iva"],2)}}</td>
        </tr>
      
        <tr>
          <tr>
            <td class="td-item"><strong> TOTAL </strong></td>
            <td class="td-item">{{number_format($total["total"],2)}}</td>
        </tr>
      </table>
    </div>
    <br>
    <br>
    <hr>
    <h3>Observações:</h3>
    <p>{{$document->observations}}</p>
    <hr>
    <br>
    <br>
    <br>
    <div class="">
      <?php echo $setting->text ?>
    </div>
    <br>
    <br>

      
    <style>
        .dados-client {
            border-collapse: collapse;
            text-align: left;
            display: inline-block;
            margin-top: 30px;
        }
        .direita-tabela{
            margin-right: 10%;
        }
        body{
          font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .servico, .td-serv, .th-serv {
            border: 1px solid black;
        }

        .servico {
            border-collapse: collapse;
            width: 100%;
            
        }

        .servico,.th-serv {
            text-align: left;
        }
        .th-itens {
            height: 50px;
            text-align: center;
        }
        .th-item, .td-item {
          padding: 8px;
          text-align: left;
          border-bottom: 1px solid #ddd;
        }
    </style>
   <script>
    print();
   </script>
</body>
</html>