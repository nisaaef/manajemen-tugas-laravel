<!-- Modal Delete-->
<div class="modal fade" id="modalTugasDestroy{{ $item->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered
  modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Hapus {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        Apakah Anda Yakin untuk Menghapus Data Tugas ini? 
        <div class="row">
           <div class="col-6">
            Nama 
           </div>
           <div class="col-6">
            : {{ $item->user->name }}
           </div>
        </div>
        <div class="row">
           <div class="col-6">
            Tugas 
           </div>
           <div class="col-6">
            : {{ $item->tugas }}
           </div>
        </div>
        <div class="row">
           <div class="col-6">
            Tanggal Mulai 
           </div>
           <div class="col-6">
            : {{ $item->tanggal_mulai }}
           </div>
        </div> 
        <div class="row">
           <div class="col-6">
            Tanggal Selesai
           </div>
           <div class="col-6">
            : {{ $item->tanggal_selesai }}
           </div>
        </div> 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i>
            Tutup
        </button>
        <form action="{{ route('tugasDestroy', $item->id) }}" method="post">
          @csrf
          @method('delete')
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i>
            Hapus
        </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Show-->
<div class="modal fade" id="modalTugasShow{{ $item->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered
  modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Detail {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        Detail Tugas Karyawan
        <div class="row">
           <div class="col-6">
            Nama 
           </div>
           <div class="col-6">
            : {{ $item->user->name }}
           </div>
        </div>
        <div class="row">
           <div class="col-6">
            Tugas 
           </div>
           <div class="col-6">
            : {{ $item->tugas }}
           </div>
        </div>
        <div class="row">
           <div class="col-6">
            Tanggal Mulai 
           </div>
           <div class="col-6">
            : {{ $item->tanggal_mulai }}
           </div>
        </div> 
        <div class="row">
           <div class="col-6">
            Tanggal Selesai
           </div>
           <div class="col-6">
            : {{ $item->tanggal_selesai }}
           </div>
        </div> 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i>
            Tutup
        </button>
        </form>
      </div>
    </div>
  </div>
</div>