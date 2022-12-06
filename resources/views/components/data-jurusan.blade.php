@foreach ($jurusan as $item)    
<li><a class="dropdown-item" href="/alumni/{{ $item->id }}">{{ $item->nama_jurusan }}</a></li>
@endforeach
