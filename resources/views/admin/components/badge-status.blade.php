@if($status == 'pending')
    <span class="badge bg-warning">Belum Diverifikasi</span>
@elseif($status == 'verified')
    <span class="badge bg-success">Terverifikasi</span>
@elseif($status == 'revisi')
    <span class="badge bg-danger">Perlu Perbaikan</span>
@endif
    