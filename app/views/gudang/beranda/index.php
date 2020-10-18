<!-- Stat Boxes -->
<div class="row">    
    <div class="col m6 s12">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $data['pembelian']; ?></h3>
                <p><b>Pembelian</b><br><?= date('F'); ?></p>
            </div>
            <div class="icon">
                <i class="material-icons">shopping_cart</i>
            </div>
            <a href="<?= BASEURL; ?>/Pembelian" class="small-box-footer" class="animsition-link">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col m6 s12">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $data['penjualan']; ?></h3>
                <p><b>Penjualan</b><br><?= date('F'); ?></p>
            </div>
            <div class="icon">
                <i class="material-icons">attach_money</i>
            </div>
            <a href="<?= BASEURL; ?>/Penjualan" class="small-box-footer" class="animsition-link">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col m6 s12">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $data['return_pembelian']; ?></h3>
                <p><b>Return Pembelian</b><br><?= date('F'); ?></p>
            </div>
            <div class="icon">
                <i class="material-icons">rotate_left</i>
            </div>
            <a href="<?= BASEURL; ?>/Return_pembelian" class="small-box-footer" class="animsition-link">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col m6 s12">
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $data['return_penjualan']; ?></h3>
                <p><b>Return Penjualan</b><br><?= date('F'); ?></p>
            </div>
            <div class="icon">
                <i class="material-icons">rotate_right</i>
            </div>
            <a href="<?= BASEURL; ?>/Return_penjualan" class="small-box-footer" class="animsition-link">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>



<div class="row">
    <div class="col s12">        
        <div class="quick-links center-align">
            <h3>Tautan Cepat</h3>               
            <div class="row">
                <div class="col l6 s12 tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Pembelian">
                    <a class="waves-effect waves-light btn-large teal" href="<?= BASEURL; ?>/Pembelian/transaksi">
                        Pembelian
                        <i class="material-icons left">add</i>
                    </a>
                </div>
                <div class="col l6 s12 tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Penjualan">
                    <a class="waves-effect waves-light btn-large teal" href="<?= BASEURL; ?>/Penjualan/transaksi">
                        Penjualan
                        <i class="material-icons left">add</i>
                    </a>
                </div> 
            </div>                    
            <div class="row">
                <div class="col l6 s12 tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Return Pembelian">
                    <a class="waves-effect waves-light btn-large teal" href="<?= BASEURL; ?>/Return_pembelian/transaksi">
                        Return Pembelian
                        <i class="material-icons left">add</i>
                    </a>
                </div>
                <div class="col l6 s12 tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Return Penjualan">
                    <a class="waves-effect waves-light btn-large teal" href="<?= BASEURL; ?>/Return_penjualan/transaksi">
                        Return Penjualan
                        <i class="material-icons left">add</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>