@include('header')
@include('menu')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit User</h1>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Form Edit User</h5>

           <form action="{{ url('/users/update/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="id_jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                  <select name="id_jabatan" class="form-control" required>
                    @foreach($jabatans as $jab)
                      <option value="{{ $jab->id }}" {{ $user->id_jabatan == $jab->id ? 'selected' : '' }}>
                        {{ $jab->nama_jabatan }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>
              </div>

              <div class="row mb-3">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="foto" name="foto">
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ url('/users') }}" class="btn btn-secondary">Kembali</a>
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>

@include('footer')