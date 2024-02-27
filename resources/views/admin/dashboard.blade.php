@extends('admin.base')
@section('content')
<div class="section-header">
    <h1>Batik Vita </h1>
     <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Batik Vita</a></div>
        <div class="breadcrumb-item">Dashboard</div>
    </div>
</div>

    <div class="row">
      <div class="col-12 mb-4">
        <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="../assets/img/unsplash/andre-benz-1214056-unsplash.jpg">
          <div class="hero-inner">
            <h2>Hallo, {{ Auth::user()->name }}</h2>
            <p class="lead">Website ini merupakan sistem yang dibuat dengan tujuan untuk
                membantu toko Batik Vita dalam proses pencatatan stok barang dan laporan keuangan.
            </p>
          </div>
        </div>
      </div>
    </div>


</div>
@endsection
