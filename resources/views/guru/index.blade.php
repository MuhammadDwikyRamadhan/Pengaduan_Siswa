<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Guru') }}
        </h2>
    </x-slot>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <h1 class="w-full md:w-1/2">Daftar Laporan yang Masuk</h1>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">No</th>
                                <th scope="col" class="px-4 py-3">Bukti</th>
                                <th scope="col" class="px-4 py-3">Pelapor</th>
                                <th scope="col" class="px-4 py-3">Terlapor</th>
                                <th scope="col" class="px-4 py-3">Kelas</th>
                                <th scope="col" class="px-4 py-3">Laporan</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $siswa)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">
                                    @if ($siswa->bukti)
                                    <img src="{{ asset('storage/public/storage/'.$siswa->bukti) }}" alt=""
                                        class="w-16 h-16 object-cover">
                                    @else
                                        <p>There is no Image</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $siswa->pelapor }}</td>
                                <td class="px-4 py-3">{{ $siswa->terlapor }}</td>
                                <td class="px-4 py-3">{{ $siswa->kelas }}</td>
                                <td class="px-4 py-3">{{ $siswa->laporan }}</td>
                                <td class="px-4 py-3">
                                    <span class="badge @if ($siswa->status == 'Under Review') bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 
                                                    @elseif($siswa->status == 'Done') bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 
                                                    @endif">
                                        {{ $siswa->status }}
                                    </span>
                                </td>                                <td class="px-4 py-3">
                                    @if($siswa->status === 'Under Review')
                                        <form action="{{ route('guru.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Mark as Done</button>
                                        </form>
                                    @elseif ($siswa->status === 'Done')
                                        <p>This report is marked as Done</p>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <div class="alert alert-danger">
                                Data Laporan Belum Ada.
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "SUCCESS!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "FAILED!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 3000
            });
        @endif

    </script>


</x-app-layout>