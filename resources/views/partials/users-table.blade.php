<span>Total: <span class="font-medium">{{ $usersCount }}</span></span>

<form action="{{ route('users.deleteSelected') }}" method="POST" class="w-full">
    @csrf
    @method('DELETE')

    <table class="w-full">
        <thead>
            <tr class="text-neutral-200 bg-neutral-900">
                <th class=" text-center px-4 py-4 rounded-l-full">
                    <input type="checkbox" id="select-all">
                </th>
                <th></th>
                <th class="px-4">
                    <button onclick="HandleOrderBy(event, `{{ $orderBy === 'desc' ? ' asc' : 'desc' }}`, 'name')"
                        class="flex items-center gap-2">
                        Name
                        @if ($orderIn === 'name')
                            @if ($orderBy === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-up">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M16 9l-4 -4" />
                                    <path d="M8 9l4 -4" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M16 15l-4 4" />
                                    <path d="M8 15l4 4" />
                                </svg>
                            @endif
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-sort">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                            </svg>
                        @endif
                    </button>
                </th>
                <th class="px-4">
                    <button onclick="HandleOrderBy(event, `{{ $orderBy === 'desc' ? ' asc' : 'desc' }}`, 'email')"
                        class="flex items-center gap-2">
                        Email Address
                        @if ($orderIn === 'email')
                            @if ($orderBy === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-up">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M16 9l-4 -4" />
                                    <path d="M8 9l4 -4" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M16 15l-4 4" />
                                    <path d="M8 15l4 4" />
                                </svg>
                            @endif
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-sort">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                            </svg>
                        @endif
                    </button>
                </th>
                <th class="px-4 text-left">Role</th>
                <th class="px-4 min-w-40">
                    <button onclick="HandleOrderBy(event, `{{ $orderBy === 'desc' ? ' asc' : 'desc' }}`, 'updated_at')"
                        class="flex items-center gap-2">
                        Updated At
                        @if ($orderIn === 'updated_at')
                            @if ($orderBy === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-up">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M16 9l-4 -4" />
                                    <path d="M8 9l4 -4" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M16 15l-4 4" />
                                    <path d="M8 15l4 4" />
                                </svg>
                            @endif
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-sort">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                            </svg>
                        @endif
                    </button>
                </th>
                <th class="px-4 min-w-40 rounded-r-full">
                    <button onclick="HandleOrderBy(event, `{{ $orderBy === 'desc' ? ' asc' : 'desc' }}`, 'created_at')"
                        class="flex items-center gap-2">
                        Created At
                        @if ($orderIn === 'created_at')
                            @if ($orderBy === 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-up">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M16 9l-4 -4" />
                                    <path d="M8 9l4 -4" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M16 15l-4 4" />
                                    <path d="M8 15l4 4" />
                                </svg>
                            @endif
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-sort">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                            </svg>
                        @endif
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($users as $user)
                <tr class="@if ($i % 2 == 0) bg-yellow-100 @endif">
                    <td class="text-center rounded-l-full py-4">
                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                    </td>
                    <td>
                        <div class="flex items-center justify-center m-0 gap-1">
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="p-1 rounded-md hover:opacity-70 flex gap-2 text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                                Edit
                            </a>
                        </div>
                    </td>
                    {{-- <td class="px-4">{{ strlen($user->name) > 10 ? substr($user->name, 0, 25) . '...' : $user->name }}</td> --}}
                    <td class="px-4">{{ $user->name }}</td>
                    <td class="px-4">{{ $user->email }}</td>
                    <td class="px-4">
                        @if ($user->hasRole('admin'))
                            Admin
                        @else
                            User
                        @endif
                    </td>
                    <td class="px-4">{{ $user->updated_at }}</td>
                    <td class="px-4 rounded-r-full">{{ $user->created_at }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

        </tbody>
    </table>

    <button onclick="HandleDeleteSelected(event)"
        class="px-4 py-2 rounded-md bg-red-500 hover:opacity-70 text-white flex gap-2 my-7">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 7l16 0" />
            <path d="M10 11l0 6" />
            <path d="M14 11l0 6" />
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg>

        Delete Selected
    </button>
</form>

<div class="w-full flex flex-col gap-2 items-center py-4 text-sm">
    <div class="flex gap-1">
        @for ($a = $currentPage - 3; $a <= $currentPage + 3; $a++)
            @if ($a > 0 && $a <= $totalPages)
                <button onclick="HandlePage({{ $a }})"
                    class="w-6 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">{{ $a }}</button>
            @endif
        @endfor
    </div>
    <div class="flex gap-1">
        @if ($currentPage > 2)
            <button onclick="HandlePage({{ $currentPage - 2 }})"
                class="w-10 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">
                << </button>
        @endif
        @if ($currentPage > 1)
            <button onclick="HandlePage({{ $currentPage - 1 }})"
                class="w-20 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">
                < Previous</button>
        @endif
        @if ($currentPage < $totalPages)
            <button onclick="HandlePage({{ $currentPage + 1 }})"
                class="w-20 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">Next
                ></button>
        @endif
        @if ($currentPage < $totalPages - 1)
            <button onclick="HandlePage({{ $currentPage + 2 }})"
                class="w-10 py-2 border rounded-md hover:bg-neutral-400 flex justify-center items-center">
                >></button>
        @endif
    </div>
    <p>Pages: {{ $currentPage }} / {{ $totalPages }}</p>
</div>


<script>
    // Select all user checkbox
    document.getElementById('select-all').addEventListener('click', function(event) {
        var checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = event.target.checked;
        });
    });
</script>
