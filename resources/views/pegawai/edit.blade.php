@extends('base')
@section('title','Edit Pegawai')
@section('menupegawai', 'underline decoration-4 underline-offset-7')

@section('content')
<section class="p-4 bg-white rounded-lg max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-[#C0392B] mb-6 text-center">Edit Pegawai</h1>

    <form action="{{ route('pegawai.update', ['id' => $pegawai->id]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" name="nama" value="{{ $pegawai->nama }}" class="w-full rounded-md border px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ $pegawai->email }}" class="w-full rounded-md border px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Jenis Kelamin</label>
            <select name="gender" class="w-full rounded-md border px-3 py-2" required>
                <option value="male" {{ $pegawai->gender == 'male' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="female" {{ $pegawai->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Status</label>
            <select name="is_active" class="w-full rounded-md border px-3 py-2">
                <option value="1" {{ $pegawai->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $pegawai->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Pekerjaan</label>
            <select name="pekerjaan_id" class="w-full rounded-md border px-3 py-2" required>
                @foreach ($pekerjaan as $p)
                    <option value="{{ $p->id }}" {{ $pegawai->pekerjaan_id == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('pegawai.index') }}" class="px-4 py-2 text-sm border rounded-md">
                Batal
            </a>
            <button class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md">
                Update
            </button>
        </div>
    </form>
</section>
@endsection