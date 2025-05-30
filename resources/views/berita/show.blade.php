<form action="{{ route('berita.destroy', $berita->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Hapus</button>
</form>
