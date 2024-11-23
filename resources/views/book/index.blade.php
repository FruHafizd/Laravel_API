<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Book Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <main class="container mx-auto px-4 py-12 max-w-6xl">
        <h1 class="text-3xl font-playfair mb-8 text-gray-800 text-center font-semibold">Book Collection Management</h1>

        <!-- START FORM -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12 backdrop-blur-sm bg-opacity-95">
            <h2 class="text-xl font-playfair mb-6 text-gray-700 border-b pb-2">Add New Book</h2>
            <form action='' method='post' class="space-y-6">
                @csrf

                @if (Route::current()->uri == 'book/{id}')
                    @method('PUT')
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline"> Mohon periksa kembali form anda:</span>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $item)
                                <li class="text-sm">{{ $item }}</li>
                            @endforeach
                        </ul>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Berhasil!</span>
                        </div>
                        <div class="mt-1">{{ session('success') }}</div>
                        <button class="absolute top-0 right-0 mt-3 mr-4" onclick="this.parentElement.remove()">
                            <svg class="h-4 w-4 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title Book</label>
                        <input type="text"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                            name='title' id="title" placeholder="Enter book title"
                            value="{{ isset($data['title']) ? $data['title'] : old('title') }}">
                    </div>
                    <div class="space-y-2">
                        <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                        <input type="text"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                            name='author' id="author" placeholder="Enter author name"
                            value="{{ isset($data['author']) ? $data['author'] : old('author') }}">
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="publication_date" class="block text-sm font-medium text-gray-700">Publication
                        Date</label>
                    <input type="date"
                        class="w-full md:w-1/3 px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white "
                        name='publication_date' id="publication_date"
                        value="{{ isset($data['publication_date']) ? $data['publication_date'] : old('publication_date') }}">
                </div>
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all duration-200 flex items-center space-x-2 text-sm font-medium"
                        name="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Save Entry</span>
                    </button>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        @if (Route::current()->uri == 'book')
            <!-- START DATA -->
            <div class="bg-white rounded-xl shadow-lg p-8 backdrop-blur-sm bg-opacity-95">
                <h2 class="text-xl font-playfair mb-6 text-gray-700 border-b pb-2">Book Collection</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-l-lg">
                                    No</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengarang</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Publikasi</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-r-lg">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $i =$data['from']; ?>
                            @forelse ($data['data'] as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $i }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        {{ $item['title'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item['author'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ date('d/m/Y', strtotime($item['publication_date'])) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center space-x-2">
                                            <a href="{{ url('book/' . $item['id']) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-700 rounded-md hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-opacity-50 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span class="font-medium">Edit</span>
                                            </a>
                                            
                                            <form action="{{ url('book/' . $item['id']) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this item?')"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-md hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50 transition-all duration-200">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span class="font-medium">Delete</span>
                                                </button>
                                            </form>
                                        </td>
                                </tr>
                                <?php $i++; ?>
                            @empty
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No Data Found....
                                    </td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                    @if ($data['links'])
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        {{-- Mobile View --}}
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="{{ $data['prev_page_url'] }}" 
                            class="{{ !$data['prev_page_url'] ? 'opacity-50 cursor-not-allowed' : '' }} relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                Previous
                            </a>
                            <a href="{{ $data['next_page_url'] }}" 
                            class="{{ !$data['next_page_url'] ? 'opacity-50 cursor-not-allowed' : '' }} relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                Next
                            </a>
                        </div>

                        {{-- Desktop View --}}
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium text-gray-900">{{ $data['from'] ?? 0 }}</span>
                                    to
                                    <span class="font-medium text-gray-900">{{ $data['to'] ?? 0 }}</span>
                                    of
                                    <span class="font-medium text-gray-900">{{ $data['total'] }}</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    @foreach ($data['links'] as $item)
                                        @php
                                            $isActive = str_contains($item['label'], $data['current_page']);
                                            $isPrevNext = in_array($item['label'], ['&laquo; Previous', 'Next &raquo;']);
                                        @endphp

                                        <a href="{{ $item['url2'] }}" 
                                        class="{{ !$item['url2'] ? 'cursor-not-allowed opacity-50' : '' }}
                                                {{ $isActive ? 'z-10 bg-amber-50 border-amber-500 text-amber-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50' }}
                                                {{ $isPrevNext ? 'hidden sm:inline-flex' : '' }}
                                                relative inline-flex items-center px-4 py-2 border text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500
                                                {{ $loop->first ? 'rounded-l-md' : '' }}
                                                {{ $loop->last ? 'rounded-r-md' : '' }}"
                                        @if(!$item['url2']) aria-disabled="true" @endif>
                                            {!! $item['label'] !!}
                                        </a>
                                    @endforeach
                                </nav>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- AKHIR DATA -->
        @endif

    </main>

    <style>
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</body>

</html>
