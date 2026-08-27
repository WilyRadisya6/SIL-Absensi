<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold" style="color: #15803d;">
                    {{ __('Lokasi Kantor') }}
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">Kelola data lokasi kantor perusahaan</p>
            </div>
            <label class="btn btn-warning btn-sm gap-2 font-bold shadow-md" for="create_modal"
                style="background: linear-gradient(135deg, #facc15, #eab308); color: #14532d; border: none; border-radius: 0.625rem; padding: 0.5rem 1.1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Data
            </label>
        </div>
    </x-slot>

    <div class="container mx-auto px-5 pt-6">
        <div class="sil-table-wrapper">
            <!-- Table Header Strip -->
            <div style="background: linear-gradient(135deg, #15803d, #16a34a); padding: 1rem 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <div style="background: rgba(250,204,21,0.25); border: 1px solid rgba(250,204,21,0.5); border-radius: 0.5rem; padding: 0.4rem 0.7rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#facc15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <div style="color: white; font-weight: 700; font-size: 0.95rem;">Daftar Lokasi Kantor</div>
                    <div style="color: rgba(255,255,255,0.7); font-size: 0.75rem;">Data lokasi kantor yang terdaftar dalam sistem</div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="sil-table-inner">
                    <thead>
                        <tr>
                            <th style="width: 3.5rem; text-align: center;">#</th>
                            <th>Kota</th>
                            <th>Alamat</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th style="text-align: center;">Is Used?</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokasiKantor as $value => $item)
                        <tr>
                            <td style="text-align: center;">
                                <span class="row-badge">{{ $lokasiKantor->firstItem() + $value }}</span>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #15803d;">{{ $item->kota }}</span>
                            </td>
                            <td style="color: #6b7280; max-width: 200px;">{{ $item->alamat }}</td>
                            <td>
                                <span style="font-family: monospace; font-size: 0.8rem; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 0.2rem 0.5rem; border-radius: 0.375rem; color: #15803d;">{{ $item->latitude }}</span>
                            </td>
                            <td>
                                <span style="font-family: monospace; font-size: 0.8rem; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 0.2rem 0.5rem; border-radius: 0.375rem; color: #15803d;">{{ $item->longitude }}</span>
                            </td>
                            <td style="text-align: center;">
                                @if ($item->is_used)
                                <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #dcfce7; color: #15803d; border: 1px solid #86efac; padding: 0.25rem 0.65rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 600;">
                                    <i class="ri-checkbox-circle-fill text-base"></i> Aktif
                                </span>
                                @else
                                <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; padding: 0.25rem 0.65rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 600;">
                                    <i class="ri-close-circle-fill text-base"></i> Tidak
                                </span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                    <label class="btn btn-warning btn-sm" for="edit_button" onclick="return edit_button('{{ $item->id }}')"
                                        style="border-radius: 0.5rem; min-height: 0; height: 2rem; padding: 0 0.65rem;">
                                        <i class="ri-pencil-fill"></i>
                                    </label>
                                    <label class="btn btn-error btn-sm" onclick="return delete_button('{{ $item->id }}', '{{ $item->kota }}')"
                                        style="border-radius: 0.5rem; min-height: 0; height: 2rem; padding: 0 0.65rem;">
                                        <i class="ri-delete-bin-line"></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="padding: 1rem 1.5rem; border-top: 1px solid rgba(22,163,74,0.08); display: flex; justify-content: flex-end;">
                {{ $lokasiKantor->links() }}
            </div>
        </div>
    </div>

    {{-- Awal Modal Create --}}
    <input type="checkbox" id="create_modal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <div class="mb-3 flex justify-between">
                <h3 class="text-lg font-bold">Tambah {{ $title }}</h3>
                <label for="create_modal" class="cursor-pointer">
                    <i class="ri-close-large-fill"></i>
                </label>
            </div>
            <div>
                <form action="{{ route('admin.lokasi-kantor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="reset" class="btn btn-neutral btn-sm">Reset</button>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Kota<span class="text-red-500">*</span></span>
                            </span>
                        </div>
                        <input type="text" name="kota" placeholder="Kota" class="input input-bordered w-full text-blue-700" value="{{ old('kota') }}" required />
                        @error('kota')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Alamat<span class="text-red-500">*</span></span>
                            </span>
                        </div>
                        <textarea name="alamat" placeholder="Alamat" class="textarea textarea-bordered w-full text-blue-700">{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Latitude<span class="text-red-500">*</span></span>
                            </span>
                        </div>
                        <input type="text" name="latitude" placeholder="Latitude" class="input input-bordered w-full text-blue-700" value="{{ old('latitude') }}" required />
                        @error('latitude')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Longitude<span class="text-red-500">*</span></span>
                            </span>
                        </div>
                        <input type="text" name="longitude" placeholder="Longitude" class="input input-bordered w-full text-blue-700" value="{{ old('longitude') }}" required />
                        @error('longitude')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Radius (Meter)<span class="text-red-500">*</span></span>
                            </span>
                        </div>
                        <input type="number" min="0" name="radius" placeholder="Radius (Meter)" class="input input-bordered w-full text-blue-700" value="{{ old('radius') }}" required />
                        @error('radius')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <div>
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Is Used?<span class="text-red-500">*</span></span>
                            </span>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Iya</span>
                                <input type="radio" name="is_used" value='1' class="radio checked:bg-red-500" />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Tidak</span>
                                <input type="radio" name="is_used" value='0' class="radio checked:bg-blue-500" checked />
                            </label>
                        </div>
                        @error('is_used')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success mt-3 w-full text-white">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Akhir Modal Create --}}

    {{-- Awal Modal Edit --}}
    <input type="checkbox" id="edit_button" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <div class="mb-3 flex justify-between">
                <h3 class="text-lg font-bold">Ubah {{ $title }}</h3>
                <label for="edit_button" class="cursor-pointer">
                    <i class="ri-close-large-fill"></i>
                </label>
            </div>
            <div>
                <form action="{{ route('admin.lokasi-kantor.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id" hidden>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Kota<span class="text-red-500">*</span></span>
                                <span class="label-text-alt" id="loading_edit1"></span>
                            </span>
                        </div>
                        <input type="text" name="kota" placeholder="Kota" class="input input-bordered w-full text-blue-700" value="{{ old('kota') }}" required />
                        @error('kota')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Alamat<span class="text-red-500">*</span></span>
                                <span class="label-text-alt" id="loading_edit2"></span>
                            </span>
                        </div>
                        <textarea name="alamat" placeholder="Alamat" class="textarea textarea-bordered w-full text-blue-700">{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Latitude<span class="text-red-500">*</span></span>
                                <span class="label-text-alt" id="loading_edit3"></span>
                            </span>
                        </div>
                        <input type="text" name="latitude" placeholder="Latitude" class="input input-bordered w-full text-blue-700" value="{{ old('latitude') }}" required />
                        @error('latitude')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Longitude<span class="text-red-500">*</span></span>
                                <span class="label-text-alt" id="loading_edit4"></span>
                            </span>
                        </div>
                        <input type="text" name="longitude" placeholder="Longitude" class="input input-bordered w-full text-blue-700" value="{{ old('longitude') }}" required />
                        @error('longitude')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Radius (Meter)<span class="text-red-500">*</span></span>
                                <span class="label-text-alt" id="loading_edit6"></span>
                            </span>
                        </div>
                        <input type="number" min="0" name="radius" placeholder="Radius (Meter)" class="input input-bordered w-full text-blue-700" value="{{ old('radius') }}" required />
                        @error('radius')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </label>
                    <div>
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Is Used?<span class="text-red-500">*</span></span>
                                <span class="label-text-alt" id="loading_edit5"></span>
                            </span>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Iya</span>
                                <input type="radio" name="is_used" value='1' class="radio checked:bg-red-500" />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Tidak</span>
                                <input type="radio" name="is_used" value='0' class="radio checked:bg-blue-500" checked />
                            </label>
                        </div>
                        @error('is_used')
                        <div class="label">
                            <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning mt-3 w-full text-slate-700">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Akhir Modal Edit --}}

    {{-- Pesan Flash --}}
    @if (session()->has('success'))
    <div id="flash-success" data-message="{{ session('success') }}" class="hidden"></div>
    @endif

    @if (session()->has('error'))
    <div id="flash-error" data-message="{{ session('error') }}" class="hidden"></div>
    @endif

    <script>
        let flashSuccess = document.getElementById('flash-success');
        if (flashSuccess) {
            Swal.fire({
                title: 'Berhasil',
                text: flashSuccess.getAttribute('data-message'),
                icon: 'success',
                confirmButtonColor: '#6419E6',
                confirmButtonText: 'OK',
            });
        }

        let flashError = document.getElementById('flash-error');
        if (flashError) {
            Swal.fire({
                title: 'Gagal',
                text: flashError.getAttribute('data-message'),
                icon: 'error',
                confirmButtonColor: '#6419E6',
                confirmButtonText: 'OK',
            });
        }

        function edit_button(id) {
            // Loading effect start
            let loading = `<span class="loading loading-dots loading-md text-purple-600"></span>`;
            $("#loading_edit1").html(loading);
            $("#loading_edit2").html(loading);
            $("#loading_edit3").html(loading);
            $("#loading_edit4").html(loading);
            $("#loading_edit5").html(loading);
            $("#loading_edit6").html(loading);

            $.ajax({
                type: "get",
                url: "{{ route('admin.lokasi-kantor.edit') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    // console.log(data);
                    let items = [];
                    $.each(data, function(key, val) {
                        items.push(val);
                    });

                    $("input[name='id']").val(items[0]);
                    $("input[name='kota']").val(items[1]);
                    $("textarea[name='alamat']").html(items[2]);
                    $("input[name='latitude']").val(items[3]);
                    $("input[name='longitude']").val(items[4]);
                    $("input[name='radius']").val(items[5]);
                    if (items[6] == 1) {
                        $("input[name='is_used'][value='1']").prop('checked', true);
                    } else if (items[6] == 0) {
                        $("input[name='is_used'][value='0']").prop('checked', true);
                    }


                    // Loading effect end
                    loading = "";
                    $("#loading_edit1").html(loading);
                    $("#loading_edit2").html(loading);
                    $("#loading_edit3").html(loading);
                    $("#loading_edit4").html(loading);
                    $("#loading_edit5").html(loading);
                    $("#loading_edit6").html(loading);
                }
            });
        }

        function delete_button(id, kota) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: "<p>Data yang dihapus tidak dapat dipulihkan kembali!</p>" +
                    "<div class='divider'></div>" +
                    "<div class='flex flex-col'>" +
                    "<b>Lokasi Kantor: " + kota + "</b>" +
                    "</div>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6419E6',
                cancelButtonColor: '#F87272',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.lokasi-kantor.delete') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#6419E6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.responseJSON.message
                            })
                        }
                    });
                }
            })
        }
    </script>
</x-app-layout>