@extends('templates.master')
@section('title', 'Bantuan | BanMas')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Data Penerima Bantuan</h4>
            <p class="card-category">Tahun. 2021</p>
          </div>
          <div class="card-body table-responsive">
              <div class="responsive-data-table">  
                  <table id="tabel_bantuan" class="display">
                    <thead>
                      <tr>
                        <th>Nama Bantuan</th>
                        <th>Jumlah Bantuan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $row)
                          <tr>
                              <td>{{ $row->nama_bantuan }}</td>
                              <td>{{ $row->total }}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  $(document).ready( function () {
    $('#tabel_bantuan').DataTable();  
  });
</script>

@endsection
