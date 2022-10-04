<!DOCTYPE html>
<?php
$total=0;
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
	<style>
		@font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 10px;
  background: #EEEEEE;
  text-align: center;
  border: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 16px;
  font-weight:bold;
}

table tbody tr:last-child td {
  border: 1px solid #FFFFFF;
}

table tfoot td {
  padding: 10px 10px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.4em;
  font-weight:bold;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}
@media print {
  #printPageButton {
    display: none;
  }
}
	</style>
  </head>
  <body>
    <header class="clearfix">
        @foreach($company as $item)
      <div id="logo">
        <img src="{{$item->image_url ? asset($item->image_url) : asset('asset/img/portfolio-1.jpg')}}">
      </div>
      <div id="company">
          
        <h2 class="name">{{$item->name}}</h2>
        <div>{{$item->address}}</div>
        <div>{{$item->phone_no}}</div>
        <div><a href="mailto:{{$item->email}}">{{$item->email}}</a></div>
        @endforeach
      </div>
      </div>
    </header>
    <main>
        @foreach($sale as $loop => $item)
          @if($loop->first)
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          @foreach($customer->where('code',$item->code) as $item1)
          <h2 class="name">{{$item1->name}}</h2>
          <div class="address">{{$item1->location_name->location}}</div>
          <div class="email"><a href="tel:{{$item1->phone}}">{{$item1->phone}}</a></div>
          @endforeach
        </div>
        <div id="invoice">
          <h1>INVOICE # {{$item->bill_no}}</h1>
          <div class="date">Date of Invoice: {{date('d-m-Y', strtotime($item->created_at))}}</div>
        </div>
        @endif
        @endforeach
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="total">#</th>
            <th class="total">PRODUCT</th>
            <th class="total">UNIT PRICE</th>
            <th class="total">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @foreach($sale as $index => $item)
          <tr>
            <td class="unit" style="text-align:center;">{{$index+1}}</td>
            <td class="unit" style="text-align:left;"><h3>{{$item->product_name->name}}</h3></td>
            <td class="unit">{{number_format($item->sale_rate)}}</h3></td>
            <td class="unit">{{number_format($item->qty)}}</td>
            <td class="unit">{{number_format($item->sale_rate * $item->qty)}}</td>
          </tr>
          <?php $total += $item->sale_rate * $item->qty; ?>
          @endforeach
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td><?php echo number_format($total);?></td>
          </tr>
          
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td><?php echo number_format($total);?></td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!<button id="printPageButton" style="float:right;" onClick="window.print();">Print</button></div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>