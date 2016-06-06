<div id="sidebar" class="sidebar                  responsive">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large"></div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini"></div>
    </div>
    <?php 
    $cur1 = $this->uri->segment(2);
    ?>
    <ul class="nav nav-list">
        <li class="<?php echo ($cur1=="dashboard") ? "active" : ""; ?>" style="height: 100%;">
            <a href="<?php echo base_url('admin/dashboard') ?>">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> Home </span>
            </a>
            <b class="arrow"></b>
        </li>
		<li class="<?php echo ($cur1=="setting") ? "active" : ""; ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-cogs"></i>
                    <span class="menu-text">
                        Data Master
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url('admin/jurusan/daftar') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Jurusan
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url('admin/prodi/daftar') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Prodi
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url('admin/kelas/daftar') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Kelas
                        </a>
                        <b class="arrow"></b>
                    </li>
					<li class="">
                        <a href="<?php echo base_url('admin/semester/daftar') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Semester
                        </a>
                        <b class="arrow"></b>
                    </li>
					<li class="">
                        <a href="<?php echo base_url('admin/akademik/daftar') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Akademik
                        </a>
                        <b class="arrow"></b>
                    </li>
					<li class="">
                        <a href="<?php echo base_url('admin/matkul/daftar') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Mata Kuliah
                        </a>
                        <b class="arrow"></b>
                    </li>
					<li class="">
                        <a href="<?php echo base_url('admin/ruangan/daftar') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Ruangan
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
		<li class="<?php echo ($cur1=="setting") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-user"></i>
				<span class="menu-text">
					Data Dosen
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/jabatan/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Jabatan
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
                    <a href="<?php echo base_url('admin/dosen/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Daftar Dosen
                    </a>
					<b class="arrow"></b>
                </li>				
			</ul>
        </li>
		<li class="<?php echo ($cur1=="setting") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text">
					Data Mahasiswa
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/mahasiswa/add') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Tambah Data
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/mahasiswa/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Daftar Data
					</a>
					<b class="arrow"></b>
				</li>				
			</ul>
        </li>
		<li class="<?php echo ($cur1=="setting") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text">
					Jadwal
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/jadwal/add') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Tambah Data
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/jadwal/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Daftar Data
					</a>
					<b class="arrow"></b>
				</li>				
			</ul>
        </li>

		
		<li class="<?php echo ($cur1=="setting") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text">
					Kehadiran
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/kehadiran/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Daftar Data
					</a>
					<b class="arrow"></b>
				</li>				
			</ul>
        </li>	
		<div style="display:none;">
            <li class="<?php echo ($cur1=="karyawan") ? "active" : ""; ?>">
                <a href="<?php echo base_url('admin/karyawan/daftar') ?>">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text">
                       Karyawan
                    </span>

                    
                </a>

                
            </li>
			
			<li class="<?php echo ($cur1=="setting") ? "active" : ""; ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-wrench"></i>
                    <span class="menu-text">
                        Pengaturan
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url('admin/setting/lembur') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Tarif Lembur
                        </a>
                        <b class="arrow"></b>
                    </li>
					<li class="">
                        <a href="<?php echo base_url('admin/setting/pkp') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Tarif PKP
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
			
			<li class="<?php echo ($cur1=="gajihan") ? "active" : ""; ?>">
                <a href="<?php echo base_url('admin/gajihan/wizard') ?>">
                    <i class="menu-icon fa fa-calculator"></i>
                    <span class="menu-text">
                        Hitung Gajihan
                    </span>

                    
                </a>

                
            </li>
			<li class="<?php echo ($cur1=="cetak") ? "active" : ""; ?>">
                <a href="<?php echo base_url('admin/cetak/wizard') ?>" class="">
                    <i class="menu-icon fa fa-print"></i>
                    <span class="menu-text">
                        Cetak Slip
                    </span>

                    
                </a>

                
            </li>
			<li class="<?php echo ($cur1=="laporan") ? "active" : ""; ?>">
                <a href="<?php echo base_url('admin/laporan/wizard') ?>" >
                    <i class="menu-icon fa fa-calendar-o"></i>
                    <span class="menu-text">
                        Laporan
                    </span>

                    
                </a>

                
            </li>
            

    </div></ul><!-- /.nav-list -->
	
    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch (e) {
        }
    </script>
</div>
