<div class="main-content">
    <div class="main-content-inner">
            <!-- /section:settings.box -->
            <div class="page-header" style="display:none;">
                <h1>
                    Formulir Tambah Tarif PKP
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        
                    </small>
                </h1>
            </div><!-- /.page-header -->
			
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/setting/doAddPKP/'?>" role="form"> 
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Golongan</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtGolonganPKP" value="<?php echo $dataOld['txtGolonganPKP']; ?>" placeholder="Isi Golongan PKP" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nominal PKP</label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="txtNominalPKP" value="<?php echo $dataOld['txtNominalPKP']; ?>" placeholder="Isi nominal PKP" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
                        
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