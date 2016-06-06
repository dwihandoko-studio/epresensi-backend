<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="<?php echo base_url('surat/style1.css') ?>" />
    <title>SLIP GAJI :  GJ/<?php echo $detail['GajiID']."/".date('Y') ?></title>
  </head>
   <body onload="window.print()">
	
	<div class="book">
		<div class="page">
			<div class="subpage">
				<div class="content">
					<h3 class="garis kepala-surat">
						<CENTER><b>PT. Umbu Namura<BR/>SLIP BUKTI PEMBAYARAN GAJI<BR/>Tanggal : <?php echo $this->m_umum->formatTanggal($detail['TanggalTransfer'], 'd-m-Y'); ?> &nbsp;&nbsp;&nbsp; Nomor: GJ/<?php echo $detail['GajiID']."/".date('Y') ?></b></CENTER>
					</h3>
					
					
					
					
					
					
				
					
					<table class="tb1" style="font-size:9pt">
						<tr>
							<td>Kepada : </td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td valign="top"><?php echo $detail['NamaKaryawan'] ?> - <?php echo $detail['NIK'] ?><br/>
							<?php echo $detail['NamaJabatan'].' - '.$detail['NamaGolongan'] ?><br/>
							<br>
							</td>
							<td valign="top"></td>
							<td valign="top"></td>
							<td valign="top"></td>
						</tr>
						
						<tr>
							<td valign="top" colspan="3">
								
							</td>
						</tr>
					</table>
					
					<table class="tb2">
						<tr>
							<td colspan="2">GAJI BRUTO</td>
							<td colspan="2">POTONGAN</td>
						</tr>
						
						<tr>
							<td>Gaji Pokok</td>
							<td>Rp. <?php echo number_format($detail['GajiPokok']); ?></td>
							<td>PKP Per Tahun</td>
							<td>Rp. <?php echo number_format($detail['PKPTahunan']); ?></td>
						</tr>
						<tr>
							<td>Gaji Bonus</td>
							<td>Rp. <?php echo number_format($detail['BonusGaji']); ?></td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td>Lembur</td>
							<td><?php  echo $detail['JamLembur'].' x '.$detail['TarifLembur'].' :<br>Rp. '.number_format($detail['TotalUangLembur']); ?></td>
							<td>PKP Per Bulan</td>
							<td>Rp. <?php echo number_format($detail['PotonganPajak']); ?></td>
						</tr>
						
						<tr>
							<td>Total Gaji Bruto</td>
							<td>Rp. <?php echo number_format($detail['GajiBruto']) ?></td>
							<td>Total Potongan </td>
							<td>Rp. <?php echo number_format($detail['PotonganPajak']) ?></td>
						</tr>
						
						<tr>
						    <td colspan="3" align="right">
								Total Gaji Bersih (Gaji Bruto - Potongan)
							</td>
							<td  align="left">
								<b>Rp. <?php echo number_format($detail['GajiNetto']) ?></b>
							</td>
						</tr>
					</table>
					
					
					<br/>
					<br/>
					<br/>
					
					<div class="width:100%; float:left;">
						<div class="garisatas" style="float:left;width:100mm">
							<ul style="margin-left:-10px; font-size:7pt;" type="square">
								<li>Ini adalah bukti sah pembayaran gajian anda untuk bulan ini.</li>
								
							</ul>
						</div>
						
						<div class="garisatas" style="float:left;width:60mm">
							<p>
								<center>
									JAKARTA, <?php echo $this->m_umum->formatTanggal($detail['TanggalTransfer'], 'd F Y') ?><br/>
									A.n. Human Resource Department<br/>
									PT. Umbu Namura<br/>
									<br/>
									<br/>
									<br/>
										TTD<br/>
										
								</center>
							</p>
						</div>
					</div>
				</div>
			</div>    
		</div>
	</div>
   
   </body>
</html>
</html>