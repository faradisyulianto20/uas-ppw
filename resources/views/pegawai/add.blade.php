@extends('base')
@section('title','Tambah Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')

@section('content')
<section class="p-4 bg-white rounded-lg max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-[#C0392B] mb-6 text-center">Tambah Pegawai</h1>

    <form action="{{ route('pegawai.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" name="nama" class="w-full rounded-md border px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" class="w-full rounded-md border px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Jenis Kelamin</label>
            <select name="gender" class="w-full rounded-md border px-3 py-2" required>
                <option value="">-- Pilih --</option>
                <option value="male">Laki-Laki</option>
                <option value="female">Perempuan</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Status</label>
            <select name="is_active" class="w-full rounded-md border px-3 py-2">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Pekerjaan</label>
            <select name="pekerjaan_id" class="w-full rounded-md border px-3 py-2" required>
                <option value="">-- Pilih Pekerjaan --</option>
                @foreach ($pekerjaan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('pegawai.index') }}" class="px-4 py-2 text-sm border rounded-md">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-sm bg-green-600 text-white rounded-md">
                Simpan
            </button>
        </div>
    </form>
</section>
@endsection
