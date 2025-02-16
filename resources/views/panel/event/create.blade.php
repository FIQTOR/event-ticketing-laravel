@extends('layouts.panel')

@section('container')
    <main class="w-full py-24 px-7 md:px-14">
        <form id="create-form" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col md:flex-row gap-28">
            <aside class="flex flex-col gap-4 md:w-1/4">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-center">
                        <img id="preview_thumbnail" alt="event Thumbnail" class="border w-52 md:w-full">
                    </div>
                    <div>
                        <label for="thumbnail"><b>Event Thumbnail</b></label><br>
                        <input type="file" name="thumbnail" id="thumbnail">
                        @error('thumbnail')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </aside>
            <div class="flex flex-col gap-4 md:w-full">

                <div>
                    <h1 class="text-2xl font-bold">Create New Event</h1>
                    <p class="text-neutral-700">You can create new event</p>
                </div>

                @if (session()->has('message'))
                    <p class="{{ session('status') === 'success' ? 'text-green-400' : 'text-red-400' }}">
                        {{ session('message') }}
                    </p>
                @endif

                <div class="flex flex-col gap-2">
                    <label for="title">Title</label>
                    <div class="flex flex-col">
                        <input type="text" name="title" id="title" required value="{{ old('title') }}"
                            placeholder="example: Ekspectanica"
                            class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        @error('title')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="organizer">Organizer</label>
                    <div class="flex flex-col">
                        <input type="text" name="organizer" id="organizer" required value="{{ old('organizer') }}"
                            placeholder="example: Ekspectanica"
                            class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        @error('organizer')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="address">Address</label>
                    <div class="flex flex-col">
                        <input type="text" name="address" id="address" required value="{{ old('address') }}"
                            placeholder="example: Ekspectanica"
                            class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        @error('address')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="event_date">Event Date</label>
                    <div class="flex flex-col">
                        <input type="date" name="event_date" id="event_date" required value="{{ old('event_date') }}"
                            placeholder="example: Ekspectanica"
                            class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">
                        @error('event_date')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="description">Description Menu</label>
                    <div class="flex flex-col">
                        <textarea name="description" id="description" rows="5"
                            class="px-4 py-2 rounded-2xl outline outline-1 focus:outline-neutral-900">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2 w-full">
                    <div class="flex justify-between flex-wrap">
                        <span>Price (IDR)</span>
                    </div>
                    <input type="number" name="price" id="price"
                        class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900" value="1000"
                        onkeyup="handleExpectPrice()" min="0">
                    @error('price')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="add-layout">Add Layout</label>
                    <input type="text" name="add-layout" id="add-layout" placeholder="example: Cat 1"
                        class="px-4 py-2 rounded-full outline outline-1 focus:outline-neutral-900">

                    <button id="add-layout-btn"
                        class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 mt-4">
                        Add Layout
                    </button>

                    <ul id="list-layout" class="list-disc pl-4 mt-4">
                        <!-- Dynamically added layouts will appear here -->
                    </ul>
                </div>

                <div class="flex gap-4">
                    <input type="checkbox" name="isTopPopular" id="isTopPopular" value="{{ old('isTopPopular') }}">
                    <label for="isTopPopular" class="font-semibold">Is Popular Event</label>
                </div>

                <div class="text-white flex gap-4 w-full">
                    <a href="{{ route('events.index') }}"
                        class="w-full px-4 py-2 text-center bg-red-500 rounded-full hover:opacity-70">Cancel</a>
                    <button class="w-full px-4 py-2 text-center bg-blue-500 rounded-full hover:opacity-70">Create</button>
                </div>
            </div>
        </form>
    </main>

    <script>
        document.getElementById('thumbnail').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview_thumbnail');
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        handleDiscountPrice($('#discount-checkbox'));

        $('#discount').on('input', function() {
            if ($(this).val() > 100)
                $(this).val(100)
            else if ($(this).val() < 0)
                $(this).val(0)
        });

        $('#price').on('input', function() {
            if ($(this).val() < 0)
                $(this).val(0)
        });

        function handleDiscountPrice(element) {
            if (element.checked) {
                $('#discount-input').addClass('flex');
                $('#discount-input').removeClass('hidden');
            } else {
                $('#discount-input').addClass('hidden');
                $('#discount-input').removeClass('flex');
            }
        }

        function handleExpectPrice() {
            let expectPrice = Math.floor($('#price').val() - ($('#price').val() / 100 * $('#discount').val()));
            $('#expected').val(expectPrice);
        }

        let layout = []; // Store the list of layouts

        function renderList() {
            const listLayout = document.getElementById('list-layout');
            listLayout.innerHTML = ''; // Clear the current list

            layout.forEach((item, index) => {
                // Create a new list item element for each layout
                const li = document.createElement('li');
                li.className = 'w-1/2';

                const div = document.createElement('div');
                div.className = 'w-full flex justify-between';

                const span = document.createElement('span');
                span.textContent = item;

                const button = document.createElement('button');
                button.className = 'hover:opacity-70';
                button.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>`;

                // Add delete functionality
                button.onclick = function() {
                    layout.splice(index, 1); // Remove layout from array
                    renderList(); // Re-render the list
                };

                div.appendChild(span);
                div.appendChild(button);
                li.appendChild(div);
                listLayout.appendChild(li);
            });
        }

        document.getElementById('add-layout-btn').addEventListener('click', function(event) {
            event.preventDefault();
            const input = document.getElementById('add-layout');
            const layoutName = input.value.trim();

            if (layoutName) {
                layout.push(layoutName); // Add new layout to the array
                input.value = ''; // Clear the input field
                renderList(); // Re-render the list
            }
        });

        document.getElementById('create-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            formData.append('layouts', JSON.stringify(layout));

            // Log form data entries
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            $.ajax({
                url: '{{ route('events.store') }}',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log('Success:', response);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseJSON);
                }
            });
        });
    </script>
@endsection
