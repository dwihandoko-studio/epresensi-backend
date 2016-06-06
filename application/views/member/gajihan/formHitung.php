
  <h4>Informasi Karyawan</h4><hr>
  <form class="form-horizontal" role="form">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">NIK:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="nik" readonly value="<?php  echo $dataKaryawan['NIK'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Nama:</label>
      <div class="col-sm-8">          
        <input type="text" class="form-control" id="nama" readonly value="<?php  echo $dataKaryawan['NamaKaryawan'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Jabatan:</label>
      <div class="col-sm-8">          
        <input type="text" class="form-control" id="jabatan" readonly value="<?php  echo $dataKaryawan['NamaJabatan'] ?>">
      </div>
    </div>
  
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Golongan Pajak:</label>
      <div class="col-sm-8">          
        <input type="text" class="form-control" id="gol_pajak" readonly value="<?php  echo $dataKaryawan['NamaGolongan'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Nomor Rekening:</label>
      <div class="col-sm-8">          
        <input type="text" class="form-control" id="nomor_rekening" readonly value="<?php  echo $dataKaryawan['NoRek'] ?>">
      </div>
    </div>
   </form> 
   <hr>
  <h4>Perhitungan Gajihan</h4>
  <form class="form-horizontal" role="form" id="formTopup">
  <hr>
  <h6><i>Perhitungan Lembur</i></h6><hr>

	<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Tarif Lembur / jam</label>
      <div class="col-sm-8">          
        <input type="text" class="form-control txtTarifLemburJam" id="pwd" readonly value="<?php  echo $dataKaryawan['TarifLembur'] ?>">
      </div>
    </div>
	 <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Lembur Karyawan:</label>
      <div class="col-sm-8">          
        <input type="number" class="form-control txtLemburKaryawan" value="0" id="txtLemburKaryawan" value="" onkeyup="calculateFinal()" onblur="setToZero('txtLemburKaryawan')" placeholder="Masukkan jumlah lembur karyawan bulan ini">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Total Tarif Lembur:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control txtTotalTarifLembur" readonly="readonly" id="txtTotalTarifLembur" value="0">
      </div>
    </div>
    <hr>
	  <h6><i>Perhitungan Gaji Bruto</i></h6><hr>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Gaji Pokok Karyawan:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control txtGajiPokokKaryawan" readonly="readonly" id="txtGajiPokokKaryawan"  value="<?php  echo $dataKaryawan['GajiUtama'] ?>">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Bonus Gaji Karyawan:</label>
      <div class="col-sm-8">
        <input type="number" class="form-control txtBonusGaji" value="0" id="txtBonusGaji" onkeyup="calculateFinal()" onblur="setToZero('txtBonusGaji')" value="">
      </div>
    </div>
	<div class="form-group" >
      <label class="control-label col-sm-2" for="email">Total Tarif Lembur:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control txtTotalTarifLembur" id="txtTotalTarifLembur"  value="0" disabled="disabled">
      </div>
    </div>
	 <div class="form-group">
      <label class="control-label col-sm-2" for="email">Total Gaji Bruto:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control txtTotalGajiBruto" id="txtTotalGajiBruto"  value="<?php  echo $dataKaryawan['GajiUtama'] ?>" disabled="disabled">
      </div>
    </div>
    <hr>
    <h6><i>Perhitungan Gaji Netto</i></h6><hr>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Total Gaji Bruto:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control txtTotalGajiBruto" id="txtTotalGajiBruto"  value="<?php  echo $dataKaryawan['GajiUtama'] ?>" disabled="disabled">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Potongan Pajak:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control txtPotonganPajak" id="txtPotonganPajak"  value="<?php echo ((($dataKaryawan['GajiUtama']*12)>$dataKaryawan['NominalPKP']) ? $dataKaryawan['NominalPKP']/12 : '0'); ?>" disabled="disabled">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Total Gaji Netto:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control txtGajiNetto" id="txtGajiNetto"  value="<?php  echo $dataKaryawan['GajiUtama']-((($dataKaryawan['GajiUtama']*12)>$dataKaryawan['NominalPKP']) ? $dataKaryawan['NominalPKP']/12 : '0') ?>" disabled="disabled">
      </div>
    </div>
    <div class="form-group" style="">        
      <div class="col-sm-offset-2 col-sm-8">
        <input type="hidden" id="karyawanID" value="<?php echo $karyawanID ?>">
        <input type="hidden" id="bulan" value="<?php echo $bulan ?>">
        <input type="hidden" id="tahun" value="<?php echo $tahun ?>">
        <button type="button" class="btn btn-primary btnAcc" acc="1"><i class="ace-icon fa fa-send"></i> Proses Sekarang !</button>
	      <button type="button" class="btn btn-danger btnAcc" acc="2" style="display:none;"><i class="ace-icon fa fa-times"></i> Decline</button>
      </div>
    </div>
	<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-8">
        <div class="alert alert-success msgSuksesPesan" style="display:none;">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Success ! </strong> <span id="pesanSukses">Topup credit the stokist.</span>
		</div>
		<div class="alert alert-danger msgGagalPesan" style="display:none;">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Oops, </strong> something wrong when topup credit, please try again.
		</div>
		<div class="alert alert-warning loadingGif" style="display:none;">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Please wait, </strong> while system saving the data
		</div>
      </div>
    </div>
  </form>
  <script>
  <?php 
  if($_GET['mode']=="view"){
  ?>
  $("#GeneralModal").attr('force-refresh','no');
  <?php
  }
  ?>

  $(window).load(function(){
	  console.log('im here');
    $("#txtLemburKaryawan").focus();
	
  });
	$(".btnAcc").load(function(){
    console.log('here');
    calculateFinal();
	
  });
	function calculateFinal(){
    var jumlahJamLembur = $(".txtLemburKaryawan").val();
    var tarifPerJam = $(".txtTarifLemburJam").val();

		var totalLembur = Number(jumlahJamLembur)*Number(tarifPerJam);
		$(".txtTotalTarifLembur").val(totalLembur);

    var gajiPokokKaryawan  = $(".txtGajiPokokKaryawan").val();
	var bonusGajiKaryawan  = $(".txtBonusGaji").val();
    var gajiBruto = Number(totalLembur)+Number(gajiPokokKaryawan)+Number(bonusGajiKaryawan);
    $('.txtTotalGajiBruto').val(gajiBruto);
    var potonganPajak = $(".txtPotonganPajak").val();
    var gajiNetto =  Number(gajiBruto)-(Number(potonganPajak));
    $('.txtGajiNetto').val(gajiNetto);
	}
	
	function setToZero(namaElement){
		current_value = $('.'+namaElement).val();
		if(current_value==''){
			$('.'+namaElement).val('0');
		}
		calculateFinal();
	}

	
	$(".btnAcc").click(function(){

	var txtLemburKaryawan = $(".txtLemburKaryawan").val();
    var txtTarifLemburJam = $(".txtTarifLemburJam").val();
    var txtTotalTarifLembur = $(".txtTotalTarifLembur").val();
    var txtGajiPokokKaryawan = $(".txtGajiPokokKaryawan").val();
    var txtTotalGajiBruto = $('.txtTotalGajiBruto').val();
    var txtPotonganPajak = $('.txtPotonganPajak').val();
    var txtGajiNetto = $('.txtGajiNetto').val();
    var karyawanID = $("#karyawanID").val();
	var bonusGajiKaryawan  = $(".txtBonusGaji").val();
    var bulan = $("#bulan").val();
    var tahun = $("#tahun").val();
	
	  $(".msgSuksesPesan").hide();
	  $(".loadingGif").show();
	  $(".msgGagalPesan").hide();
	  $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/gajihan/prosesGaji') ?>",
                data: { 
					    karyawanID: karyawanID , 
                        bulan : bulan ,
                        tahun : tahun,
              					txtGajiNetto : txtGajiNetto,
              					txtPotonganPajak : txtPotonganPajak,
              					txtTotalGajiBruto : txtTotalGajiBruto,
                        txtGajiPokokKaryawan : txtGajiPokokKaryawan,
                        txtTotalTarifLembur : txtTotalTarifLembur,
                        txtTarifLemburJam : txtTarifLemburJam,
                        txtLemburKaryawan : txtLemburKaryawan,
						txtBonusGaji : bonusGajiKaryawan
				              },
				timeout: 1000,
				error: function(x, t, m) {
							if(t==="timeout") {
								 $(".msgSuksesPesan").hide(); 
								 $(".loadingGif").hide();
								 $(".msgGagalPesan").show();
							} else {
								 $(".msgSuksesPesan").hide();
								 $(".loadingGif").hide();
								 $(".msgGagalPesan").show();
							}
						}
            }).done(function( msg ) {
				$(".loadingGif").hide();
				
				$("#pesanSukses").html("Gaji sudah diproses");
				$(".msgSuksesPesan").show();
				$(".msgGagalPesan").hide();
				location.reload();
			});
		return false;
	});
  </script>


