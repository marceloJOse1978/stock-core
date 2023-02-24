<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{url("public/css/tailwind.min.css")}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url("css/style.css")}}">
    <title>{{$document->type}} - {{$document->number}}</title>
</head>
<body>
    <div id="receipt-content" class="text-left w-full text-sm p-6 overflow-auto">
        <div class="text-center">
            <img
                style="max-width: 200px;"
                src="{{$url=(!empty($setting->pic_path))? url("public/storage/logo-img/$setting->pic_path") : url("public/vendors/images/favicon-32x32.png")}}"
                alt=""
                class="mb-3 w-8 h-8 inline-block"
            />
            <h2 class="text-xl font-semibold">RECIBO</h2>
            {{--  <p>{{$name}}</p> --}}
        </div>
        <div class="flex mt-4 text-xs">
            <div class="flex-grow">
            {{-- DATA SETTING START --}}
            <table>
                <tr>
                <td><strong>{{$setting->name_bs}}</strong></td>
                </tr>
                <tr>
                <td>NIF <strong>{{$setting->nif}}</strong></td>
                </tr>
                <tr>
                <td>CONTACTO: <strong>{{$setting->phone_bs}}</strong></td>
                </tr>
                <tr>
                <td>ENDEREÇO: <strong>{{$setting->address_bs}}</strong></td>
                </tr>
            </table>
            </div>
            <div >
            {{-- DATA SETTING START --}}
            <table>
                <tr>
                <td><strong>{{(empty($document->client_id)) ? "COMSUMIDOR FINAL" : $document->clients->name}}</strong></td>
                </tr>
                <tr>
                <td>NIF: <strong>{{(empty($document->client_id)) ? "XXXX XXX XXX" : $document->clients->code}}</strong></td>
                </tr>
                <tr>
                <td>CONTACTO: <strong>{{(empty($document->client_id)) ? "XXX XXX XXX" : $document->clients->phone}}</strong></td>
                </tr>
                <tr>
                <td>ENDEREÇO: <strong>{{(empty($document->client_id)) ? "XXX XXX XXX" : substr($document->clients->address, 0, 30); }}</strong></td>
                </tr>
            </table>
            </div>
        </div>
        <div class="flex mt-4 text-xs">
            <div class="flex-grow">No: <span>{{$document->type}} - {{$document->number}}</span></div>
            <div x-text="receiptDate"></div>
        </div>
        <hr class="my-2">
        <div>
            <table class="w-full text-xs">
                <thead>
                    <tr>
                    <th class="py-1 w-1/12 text-center">#</th>
                    <th class="py-1 text-left">Item</th>
                    <th class="py-1 w-2/12 text-center">QTD</th>
                    <th class="py-1 w-2/12 text-center">IVA/C</th>
                    <th class="py-1 w-2/12 text-center">Desconto</th>
                    <th class="py-1 w-3/12 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itens as $row)
                    <tr>
                        <td class="py-2 text-center">{{$count++}}</td>
                        <td class="py-2 text-left">
                            <span>{{$row->title}}</span>
                            <br/>
                            <small> {{$row->net_total}} </small>
                        </td>
                        <td class="py-2 text-center" >{{$row->qtd}} {{$row->unit}}</td>
                        <td class="py-2 text-center" >{{$row->impost}}</td>
                        <td class="py-2 text-center">{{$row->discount_for_itens}}</td>
                        <td class="py-2 text-right">{{$row->gross_total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <hr class="my-2">
        <div>
            <div class="flex font-semibold">
            <div class="flex-grow">SUBTOTAL</div>
            <div x-text="priceFormat(getTotalPrice())">{{number_format($total["sub"],2)}}</div>
            </div>
            <div class="flex font-semibold">
            <div class="flex-grow">IMPOSTO</div>
            <div x-text="priceFormat(getTotalTax())">{{number_format($total["iva"],2)}}</div>
            </div>
            <div class="flex font-semibold">
            <div class="flex-grow">TOTAL</div>
            <div x-text="priceFormat(getTotalPrice()+getTotalTax())">{{number_format($total["total"],2)}}</div>
            </div>
            <br>
        </div>
        <br>
        <br>
        <samp style="text-align: center" >moeda em {{$setting->coin}}</samp>
    </div>
    <script>
        print();
    </script>
</body>
</html>