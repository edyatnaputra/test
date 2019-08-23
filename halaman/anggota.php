<?php
$connect = mysqli_connect("localhost", "root", "", "koprasi");
$query = "SELECT a.id_anggota, a.nik, a.nama, a.jenis_kelamin, a.tanggal_lahir, a.alamat, k.kota, p.prov, a.foto from t_anggota a LEFT JOIN t_kota k ON a.id_kota = k.id_kota LEFT JOIN t_prov p ON k.id_prov = p.id_prov ORDER BY nama ASC";
$result = mysqli_query($connect, $query);
?>
<html>  
 <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            
    <script src="jquery.tabledit.min.js"></script>
    </head>  
    <body>  
  <div class="container">
            <div class="table-responsive">  
    <h3 align="center" style="font-size: 50px">Daftar Keanggotaan Koperasi</h3><br />
<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm" id="tambah_anggota">
    Tambah Anggota
</button>
<br/>
<br/>
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu"><span id="judul_modal"><span>Tambah Anggota</span></span></h4>
            </div>
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="masukkanNik">NIK</label>
                        <input type="text" class="form-control" id="masukkanNik" placeholder="Masukkan NIK Anda" onkeypress="return isNumberKey(event)"/>
                    </div>
                    <div class="form-group">
                        <label for="masukkanNama">Nama</label>
                        <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan Nama Anda" onkeypress="return isAbcdKey(event)"/>
                    </div>
                    <div class="form-group">
                        <label for="masukkanJk">Jenis Kelamin</label><br/>
                        <input name="jenis_kelamin" id="jenis_kelamin" type="radio" value="Laki-laki" checked> Laki-Laki</input><br/>
                        <input name="jenis_kelamin" id="jenis_kelamin" type="radio" value="Perempuan"> Perempuan</input>
                    </div>
                    <div class="form-group">
                        <label for="masukkanTgl">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="masukkanTgl"/>
                    </div>
                    <div class="form-group">
                        <label for="masukkanKota">Kota</label><br/>
                            <?php
                                $resultset = mysqli_query($connect, "SELECT id_kota, kota FROM t_kota");
                            ?>
                            <select name="kota" id="masukkanKota" style="width: 100%">
                              <option value="" disabled selected>Pilih Kota</option>
                             <?php
                                while ($rows = $resultset -> fetch_assoc()) {
                                  $kota = $rows['kota'];
                                  $id_kota = $rows['id_kota'];
                                  echo "<option value='$id_kota'>$kota</option>";
                                }
                            ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="masukkanJk">Alamat</label>
                        <input type="text" class="form-control" id="masukkanAlamat" placeholder="Masukkan Alamat Anda"/>
                    </div>
                    <div class="form-group">
                        <label for="masukkanJk">Upload Foto</label>
                        <input type="file" id="foto" name="uploadfoto" accept="image/*">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary submitBtn" id="tambahAnggota">Tambah</button>
            </div>
        </div>
    </div>
</div>
    <table id="editable_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th style="text-align: center;">ID</th>
       <th style="text-align: center;">NIK</th>
       <th style="text-align: center;">Nama</th>
       <th style="text-align: center;">Jenis Kelamin</th>
       <th style="text-align: center;">Tanggal Lahir</th>
       <th style="text-align: center;">Umur</th>
       <th style="text-align: center;">Alamat</th>
       <th style="text-align: center;">Kota</th>
       <th style="text-align: center;">Provinsi</th>
       <th style="text-align: center;">Foto</th>
       <th style="text-align: center;">Edit</th>
       <th style="text-align: center;">Hapus</th>
      </tr>
     </thead>
     <tbody>
     <?php
     $no=1;
     while($row = mysqli_fetch_array($result))
     {
      $tanggal = new DateTime($row["tanggal_lahir"]);
      $today = new DateTime('today');
      $y = $today->diff($tanggal)->y;
      echo '
      <tr>
       <td>'.$no++.'</td>
       <td>'.$row["nik"].'</td>
       <td>'.$row["nama"].'</td>
       <td>'.$row["jenis_kelamin"].'</td>
       <td>'.$row["tanggal_lahir"].'</td>
       <td>'.$y.'</td>
       <td>'.$row["alamat"].'</td>
       <td>'.$row["kota"].'</td>
       <td>'.$row["prov"].'</td>
       <td><img style="width: 70px; height: 100px" src="foto/'.$row["foto"].'"></td>
       <td><button type="button" id="'.$row["id_anggota"].'" class="edit">Edit</button></td>
       <td><button type="button" id="'.$row["id_anggota"].'" class="hapus">Hapus</button></td>
      </tr>
      ';
     }
     ?>
     </tbody>
    </table>
   </div>  
  </div>  
 </body>  
</html>  
<script>
$( document ).ready(function() {
  $('#tambahAnggota').click(function(){

      var nik = $('#masukkanNik').val();
      var nama = $('#masukkanNama').val();
      var jenis_kelamin = $("input[name='jenis_kelamin']:checked").val();
      var tgl = $('#masukkanTgl').val();
      var kota = $("#masukkanKota option:selected").val();
      var alamat = $('#masukkanAlamat').val();
      var file = $("input:file").val();

      if(nik.trim() == '' ){
        alert('Masukkan NIK Anda.');
        $('#masukkanNik').focus();
        return false;
      }else if(nama.trim() == '' ){
        alert('Masukkan Nama Anda.');
        $('#masukkanNama').focus();
        return false;
      }else if(tgl.trim() == '' ){
        alert('Masukkan Tanggal Lahir Anda.');
        $('#masukkanTgl').focus();
        return false;
      }else if(kota.trim() == '' ){
        alert('Masukkan Kota Anda.');
        $('#masukkanKota').focus();
        return false;
      }else if(alamat.trim() == '' ){
        alert('Masukkan Alamat Anda.');
        $('#masukkanAlamat').focus();
        return false;
      }else{

      var file_data = $('#foto').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      $.ajax({
          url: 'model/kirim_foto.php?nik='+nik, 
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          success: function(php_script_response){
          }
       });


        $.ajax({
        url: 'model/kirim_form.php',
        type: 'POST',
        data: {
          'save': 1,
          'nik': nik,
          'nama': nama,
          'jenis_kelamin': jenis_kelamin,
          'tgl': tgl,
          'kota': kota,
          'alamat': alamat,
          'foto': file,
        },
        success: function(response){
        location.reload();
        alert(response);

        }

      });
    }
  });

  $('.edit').click(function(){
    var id = this.id;
     $.ajax({
      url: 'model/kirim_form.php',
      type: 'POST',
      data: {
        'edit': 1,
        'id_anggota': id,
      },
      success: function(response){
        var data = response.split(",");
        var id_anggota = data[0];
        var nama = data[1];
        var tanggal_lahir = data[2];
        var id_kota = data[3];
        var alamat = data[4];
        var nik = data[5];
        var jenis_kelamin = data[7];

        $('#modalForm').modal('show');

        $('#masukkanNik').val(nik);
        $('#masukkanNik').prop('readonly', true);
        $('#labelModalKu span').text('Edit Anggota');
        $('#tambahAnggota').text('Simpan');
        $('#masukkanNama').val(nama);
        $('#masukkanTgl').val(tanggal_lahir);
        $("#masukkanKota").val(id_kota);
        $('#masukkanAlamat').val(alamat);
        $('[name="jenis_kelamin"][value='+jenis_kelamin+']').prop('checked', true);
      }
    });
  });

  $('.hapus').click(function(){
    var id = this.id;
    $.ajax({
      url: 'model/kirim_form.php',
      type: 'POST',
      data: {
        'delete': 1,
        'id_anggota': id,
      },
      success: function(response){

        location.reload();
        if (response==true) {
          alert("Hapus Data Sukses");
        }else{
          alert("Hapus Data Gagal");          
        }
      }
    });
  });

  $('#tambah_anggota').click(function(){
    $('#labelModalKu span').text('Tambah Anggota');
    $('#masukkanNik').prop('readonly', false);    
  });

});
 </script>