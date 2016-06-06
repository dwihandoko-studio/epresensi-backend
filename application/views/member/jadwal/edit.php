<div class="main-content">
    <div class="main-content-inner">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
				
				$(document).ready(function(){
					$('.clockpicker1').clockpicker({
						placement: 'top',
						align: 'left',
						donetext: 'Done',
						autoclose: true,
					});
				});
				
				$(document).ready(function(){
					$('.clockpicker2').clockpicker({ 
						placement: 'top',
						align: 'left',
						donetext: 'Done',
						autoclose: true,
					});
				});
            </script>
 
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>

                <li>
                    <a href="<?php echo base_url('admin/jadwal/daftar') ?>">Jadwal</a>
                </li>
                
                
                <li class="active">Edit Jadwal</li>
            </ul><!-- /.breadcrumb -->

            <!-- #section:basics/content.searchbox -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->

            <!-- /section:basics/content.searchbox -->
        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">
            <!-- #section:settings.box -->
            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="ace-icon fa fa-cog bigger-130"></i>
                </div>

                <div class="ace-settings-box clearfix" id="ace-settings-box">
                    <div class="pull-left width-50">
                        <!-- #section:settings.skins -->
                        <div class="ace-settings-item">
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select>
                            </div>
                            <span>&nbsp; Choose Skin</span>
                        </div>

                        <!-- /section:settings.skins -->

                        <!-- #section:settings.navbar -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                            <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                        </div>

                        <!-- /section:settings.navbar -->

                        <!-- #section:settings.sidebar -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                        </div>

                        <!-- /section:settings.sidebar -->

                        <!-- #section:settings.breadcrumbs -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                            <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                        </div>

                        <!-- /section:settings.breadcrumbs -->

                        <!-- #section:settings.rtl -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                        </div>

                        <!-- /section:settings.rtl -->

                        <!-- #section:settings.container -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                            <label class="lbl" for="ace-settings-add-container">
                                Inside
                                <b>.container</b>
                            </label>
                        </div>

                        <!-- /section:settings.container -->
                    </div><!-- /.pull-left -->

                    <div class="pull-left width-50">
                        <!-- #section:basics/sidebar.options -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                            <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                            <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                            <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                        </div>

                        <!-- /section:basics/sidebar.options -->
                    </div><!-- /.pull-left -->
                </div><!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            <!-- /section:settings.box -->
            <div class="page-header">
                <h1>
                    Formulir Edit Jadwal
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/jadwal/doEdit/'.$this->uri->segment(4);?>" role="form"> 
                       <?php 
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');?>
                        <!-- #section:elements.form -->
						<div class="form-group">        
                          <div class="col-sm-2" style="border-bottom: 2px solid #6EBACC;">
                            Harap isi isian di bawah ini:
                          </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode</label>
                            <div class="col-sm-3">
                                <input type="text" id="form-field-1" name="txtKode" value="<?php echo $dataDetail['kode']; ?>" class="col-xs-10 col-sm-5" required readonly/>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
                            <div class="col-sm-9">
								<select name="txtKelas" class="col-xs-10 col-sm-5" required>
									<option value="<?php echo $dataDetail['id_kelas']; ?>"><?php echo $dataDetail['kelas'];?></option>
									<option disabled>---------------</option>
									<?php foreach ($listKelas as $value) { ?>
                                    <option value="<?php echo $value['kode']; ?>"><?php echo $value['kelas']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>					
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ruangan</label>
                            <div class="col-sm-9">
								<select name="txtRuangan" class="col-xs-10 col-sm-5" required>
									<option value="<?php echo $dataDetail['id_ruangan']; ?>"><?php echo $dataDetail['ruangan'];?></option>
									<option disabled>---------------</option>
									<?php foreach ($listRuangan as $value) { ?>
                                    <option value="<?php echo $value['kode']; ?>"><?php echo $value['ruangan']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>				
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mata Kuliah</label>
                            <div class="col-sm-9">
								<select name="txtMatkul" class="col-xs-10 col-sm-5" required>
									<option value="<?php echo $dataDetail['id_mk']; ?>"><?php echo $dataDetail['mata_kuliah'];?></option>
									<option disabled>---------------</option>
									<?php foreach ($listMatkul as $value) { ?>
                                    <option value="<?php echo $value['kode']; ?>"><?php echo $value['mata_kuliah']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>	
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Dosen</label>
                            <div class="col-sm-9">
								<select name="txtDosen" class="col-xs-10 col-sm-5" required>
									<option value="<?php echo $dataDetail['id_dosen']; ?>"><?php echo $dataDetail['nama_dosen'];?></option>
									<option disabled>---------------</option>
									<?php foreach ($listDosen as $value) { ?>
                                    <option value="<?php echo $value['nip']; ?>"><?php echo $value['nama_dosen']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>						
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester</label>
                            <div class="col-sm-9">
								<select name="txtSemester" class="col-xs-10 col-sm-5" required>
									<option value="<?php echo $dataDetail['id_semester']; ?>"><?php echo $dataDetail['semester'];?></option>
									<option disabled>---------------</option>
									<?php foreach ($listSemester as $value) { ?>
                                    <option value="<?php echo $value['kode']; ?>"><?php echo $value['semester']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Akademik</label>
                            <div class="col-sm-9">
								<select name="txtAkademik" class="col-xs-10 col-sm-5" required>
									<option value="<?php echo $dataDetail['id_akademik']; ?>"><?php echo $dataDetail['akademik'];?></option>
									<option disabled>---------------</option>
									<?php foreach ($listAkademik as $value) { ?>
                                    <option value="<?php echo $value['kode']; ?>"><?php echo $value['akademik']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>	
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Hari</label>
                            <div class="col-sm-9">
								<select name="txtHari" class="col-xs-10 col-sm-5" required>
									<option value="<?php echo $dataDetail['hari']; ?>"><?php echo $dataDetail['nama_hari'];?></option>
									<option disabled>---------------</option>
									<?php foreach ($listHari as $value) { ?>
                                    <option value="<?php echo $value['kode']; ?>"><?php echo $value['nama_hari']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>	
						<div class="form-group">
                            <label class="col-sm-3 control-label">Jam Kuliah</label>
                            <div class="col-sm-2">
								<div class="clockpicker1">
									<i>Mulai</i>
									<div class="input-group">
										<input type="text" class="form-control" name="txtStart" value="<?php echo $dataDetail['jam_mulai']; ?>" placeholder="Jam mulai" required>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</div>
								<div class="clockpicker2">
								<i>Selesai</i>
									<div class="input-group">
										<input type="text" class="form-control" name="txtFinish" value="<?php echo $dataDetail['jam_selesai']; ?>" placeholder="Jam selesai" required>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</div>
                            </div>
						</div>
						<!--
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jam Mulai</label>
                            <div class="col-sm-3">
                                <input type="time" id="form-field-1" name="txtStart" value="<?php //echo $dataDetail['jadwal_start']; ?>" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jam Berakhir</label>
                            <div class="col-sm-3">
                                <input type="time" id="form-field-1" name="txtFinish" value="<?php //echo $dataDetail['jadwal_finish']; ?>" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
						-->
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Simpan
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Reset
                                </button>
                            </div>
                        </div>

                        <div class="hr hr-24"></div>

                    </form>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->