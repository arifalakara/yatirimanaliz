<?php
	require "fonksiyon.php";
?>

<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hisse Senedi Yatırım Analiz Tablosu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  </head>
  <body>
  


				<?php
				
					$Baglan = Baglan("https://www.isyatirim.com.tr/tr-tr/analiz/hisse/Sayfalar/default.aspx");
					preg_match('@<table class="dataTable(.*?)>(.*?)</table>@si', $Baglan, $hissekodlar);
                    preg_match_all('@<a href="(.*?)">                                        (.*?)                                    </a>@si', $hissekodlar[0], $kodlar);
                        
                        $hisseLink = $kodlar[1];
                        $hisseKod = $kodlar[2];
                        $Link = ("https://www.isyatirim.com.tr");
						
				?>
  
	<div class="container-fluid my-4" >
			<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
		  <thead>
			<tr>
			  <th style="text-align:left;" scope="col">Hisse Kodu</th>
              <th style="text-align:left;" scope="col">Hisse Adı</th>
              <th style="text-align:left;" scope="col">Piyasa Değeri</th>
              <th style="text-align:left;" scope="col">Yabancı Oranı</th>
              <th style="text-align:left;" scope="col">Halka Açıklık Oranı</th>
              <th style="text-align:left;" scope="col">Net Borç</th>
              <th style="text-align:left;" scope="col">Ödenmiş Sermaye</th>
              <th style="text-align:left;" scope="col">Öz Kaynaklar</th>
              <th style="text-align:left;" scope="col">Net Kar</th>
              <th style="text-align:left;" scope="col">3 Aylık Max. Fiyat</th>
              <th style="text-align:left;" scope="col">3 Aylık Min. Fiyat</th>
              <th style="text-align:left;" scope="col">PD/DD</th>              
			</tr>
		  </thead>
          
		  <tbody>
			<?php				
					for ($i = 0; $i < count($hisseKod); $i++ ) {
             ?>		
			<tr>                
				<td style="text-align:right;" value="<?php echo $hisseKod[$i] ?> Hisse Analizi"><?php echo $hisseKod[$i] ?></td>
                <td style="text-align:right;" >
					<?php 
						$hisseDetay = Baglan("https://www.isyatirim.com.tr/tr-tr/analiz/hisse/Sayfalar/sirket-karti.aspx?hisse=". $hisseKod[$i]); 
						preg_match('@<th>Ünvanı</th>                    <td class="text-right">(.*?)</td>@si', $hisseDetay, $unvan);
						echo $unvan[1];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<th>Piyasa Değeri</th>                    <td>(.*?)</td>@si', $hisseDetay, $piyasaDegeri);
						echo $piyasaDegeri[1];
					?>
                </td>
                 
                <td style="text-align:right;" >
					<?php 
						preg_match('@<th>Yabancı Oranı (.*?)</th>                    <td>(.*?)</td>@si', $hisseDetay, $yabanciOrani);
						echo $yabanciOrani[2];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<th>Halka Açıklık Oranı (.*?)</th>                    <td>(.*?)</td>@si', $hisseDetay, $halkaAciklikOrani);
						echo $halkaAciklikOrani[2];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<th>Net Borç</th>                    <td>(.*?)</td>@si', $hisseDetay, $netBorc);
						echo $netBorc[1];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<td>Ödenmiş Sermaye</td><td class="data-ozkaynak_1">(.*?)</td>@si', $hisseDetay, $odenmisSermaye);
						echo $odenmisSermaye[1];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<td>Özkaynaklar</td><td class="data-ozkaynak_1">(.*?)</td>@si', $hisseDetay, $ozKaynak);
						echo $ozKaynak[1];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<td>Net Kâr</td><td class="data-ozkaynak_1">(.*?)</td>@si', $hisseDetay, $netKar);
						echo $netKar[1];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<td>Fiyat Hareketi (.*?)</td>                        <td>(.*?)</td>                        <td>(.*?)</td>@si', $hisseDetay, $maxFiyat);
						echo $maxFiyat[3];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<td>Fiyat Hareketi (.*?)</td>                        <td>(.*?)</td>                        <td>(.*?)</td>@si', $hisseDetay, $minFiyat);
						echo $minFiyat[2];
					?>
                </td>
                <td style="text-align:right;" >
					<?php 
						preg_match('@<th>PD/DD</th>                    <td>(.*?)</td>@si', $hisseDetay, $pddd);
						echo $pddd[1];
					?>                    
                </td>
			</tr>
            <?php } ?>
		  </tbody>          
		</table>
	</div>
             
             	
  
 
  
  
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script>
	$(document).ready(function() {
	    var table = $('#example').DataTable( {
	        lengthChange: false,
	        buttons: [ 'copy', 'excel', 'colvis' ]
	    } );
	 
	    table.buttons().container()
	        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
	} );
     </script>
  </body>
</html>
