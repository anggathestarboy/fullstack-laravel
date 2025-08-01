<x-layout.admin />

<div class="flex-1 flex flex-col overflow-hidden">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 px-4 py-4 md:px-8 md:py-8">
        <div class="flex flex-col gap-1">
            <h1 class="font-semibold md:text-lg text-gray-800">Book</h1>
            <div class="flex items-center gap-1">
                <p class="text-xs text-gray-400 md:text-sm">Admin</p>
                <p class="text-xs text-gray-400 md:text-sm">/</p>
                <p class="text-xs text-gray-400 md:text-sm">Book</p>
            </div>
        </div>

        @if (session('success'))
            <div id="alertBox" class="bg-green-600 mt-4 rounded-md px-4 py-3 flex items-center">
                <i class="fas fa-check-circle text-white mr-2"></i>
                <span class="text-white font-medium text-sm">{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div id="alertBox" class="bg-red-600 mt-4 rounded-md px-4 py-3 flex items-center">
                <i class="fas fa-times-circle text-white mr-2"></i>
                <span class="text-white font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <!-- CREATE BOOK FORM -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <h2 class="text-base font-semibold mb-4 text-gray-700">📚 Create Book</h2>
            <form action="{{ route('admin.books.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <input type="text" name="book_name" placeholder="Book Name" class="px-3 py-2 border rounded w-full" />
                    <input type="text" name="book_isbn" placeholder="ISBN" class="px-3 py-2 border rounded w-full" />
                    <input type="text" name="book_img" placeholder="Image URL" class="px-3 py-2 border rounded w-full" />
                    <input type="text" name="book_description" placeholder="Description" class="px-3 py-2 border rounded w-full" />
                    <input type="number" name="book_stock" placeholder="Stock" class="px-3 py-2 border rounded w-full" />

                    <select name="book_author_id" class="px-3 py-2 border rounded w-full">
                        <option value="">-- Select Author --</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->author_id }}">{{ $author->author_name }}</option>
                        @endforeach
                    </select>

                    <select name="book_category_id" class="px-3 py-2 border rounded w-full">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>

                    <select name="book_publisher_id" class="px-3 py-2 border rounded w-full">
                        <option value="">-- Select Publisher --</option>
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->publisher_id }}">{{ $publisher->publisher_name }}</option>
                        @endforeach
                    </select>

                    <select name="book_shelf_id" class="px-3 py-2 border rounded w-full">
                        <option value="">-- Select Shelf --</option>
                        @foreach ($shelves as $shelf)
                            <option value="{{ $shelf->shelf_id }}">{{ $shelf->shelf_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-gray-800 text-white font-semibold py-2 px-6 rounded hover:bg-gray-700 transition">
                        Create Book
                    </button>
                </div>
            </form>
        </div>

        <!-- BOOK TABLE -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-10">
            <h2 class="text-base font-semibold mb-4 text-gray-700">📖 Book List</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-700 font-semibold text-xs uppercase tracking-wider">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">ISBN</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Author</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Publisher</th>
                            <th class="px-4 py-3">Shelf</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($books as $book)
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="document.getElementById('bookModal-{{ $book->id }}').showModal()">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $book->book_name }}</td>
                            <td class="px-4 py-3">{{ $book->book_isbn }}</td>
                            <td class="px-4 py-3">{{ $book->book_stock }}</td>
                            <td class="px-4 py-3">{{ $book->book_description }}</td>
                            <td class="px-4 py-3">{{ $book->author->author_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $book->category->category_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $book->publisher->publisher_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $book->shelf->shelf_name ?? '-' }}</td>
                        </tr>

                        <!-- Modal Edit/Delete -->
                        {{-- <dialog id="bookModal-{{ $book->id }}" class="modal">
                            <div class="modal-box bg-white rounded-lg shadow-lg w-full max-w-xl p-6 mx-auto my-12">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="font-semibold text-lg text-gray-800">Update Book Form</h3>
                                    <form method="dialog">
                                        <button type="submit" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                                    </form>
                                </div>

                                <form action="{{ route('pages.admin.book.edit', $book->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <input type="text" name="book_name" value="{{ $book->book_name }}" class="w-full px-3 py-2 border rounded" />
                                    <input type="text" name="book_isbn" value="{{ $book->book_isbn }}" class="w-full px-3 py-2 border rounded" />
                                    <input type="text" name="book_img" value="{{ $book->book_img }}" class="w-full px-3 py-2 border rounded" />

                                    <div class="grid grid-cols-2 gap-4">
                                        <select name="book_author_id" class="w-full px-3 py-2 border rounded">
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}" @selected($book->book_author_id == $author->id)>
                                                    {{ $author->author_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="book_category_id" class="w-full px-3 py-2 border rounded">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected($book->book_category_id == $category->id)>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="book_publisher_id" class="w-full px-3 py-2 border rounded">
                                            @foreach ($publishers as $publisher)
                                                <option value="{{ $publisher->id }}" @selected($book->book_publisher_id == $publisher->id)>
                                                    {{ $publisher->publisher_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="book_shelf_id" class="w-full px-3 py-2 border rounded">
                                            @foreach ($shelves as $shelf)
                                                <option value="{{ $shelf->id }}" @selected($book->book_shelf_id == $shelf->id)>
                                                    {{ $shelf->shelf_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="flex justify-end gap-2">
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 transition">Update</button>
                                    </div>
                                </form>

                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="mt-4 flex justify-end">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500 transition"
                                            onclick="return confirm('Yakin hapus buku ini?')">Delete</button>
                                </form>
                            </div>
                        </dialog> --}}
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 3000);
        }
    });
</script>
