<span>Total: <span class="font-medium">{{ $paymentsCount }}</span></span>

<div class="w-full">

    <table class="w-full">
        <thead>
            <tr class="text-neutral-200 bg-neutral-900">
                <th class=" text-center px-4 py-4 rounded-l-full">
                    <input type="checkbox" id="select-all">
                </th>
                <th>Payment ID</th>

                <th class="px-4">Status</th>
                <th class="px-4">
                    <button onclick="HandleOrderBy(event, `{{ $orderBy === 'desc' ? ' asc' : 'desc' }}`, 'total_price')"
                        class="flex items-center gap-2">
                        Total Price
                        @if ($orderIn === 'title')
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
                <th class="px-4 text-left">Guest</th>
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
            @foreach ($payments as $payment)
                <tr class="@if ($i % 2 == 0) bg-yellow-100 @endif">
                    {{-- <td class="px-4">{{ strlen($user->name) > 10 ? substr($user->name, 0, 25) . '...' : $user->name }}</td> --}}
                    <td class="px-4 py-4">{{ $i }}</td>
                    <td class="px-4">{{ $payment->payment_id }}</td>
                    <td class="px-4">{{ $payment->status }}</td>
                    <td class="px-4">Rp{{ number_format($payment->total_price, 0, '.', '.') }}</td>
                    <td class="px-4">{{ $payment->guest }}</td>
                    <td class="px-4">{{ $payment->updated_at }}</td>
                    <td class="px-4 rounded-r-3xl">{{ $payment->created_at }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

        </tbody>
    </table>
</div>

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
    // Select all event checkbox
    document.getElementById('select-all').addEventListener('click', function(event) {
        var checkboxes = document.querySelectorAll('input[name="event_ids[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = event.target.checked;
        });
    });
</script>
