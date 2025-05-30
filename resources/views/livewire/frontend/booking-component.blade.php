<div>
    <div wire:loading>
        <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500"
            role="status" aria-label="loading">
            <span class="sr-only">Loading...</span>
        </div>
        Processing..
    </div>
    {{-- Card Blog --}}
    <div
        class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-10 bg-white dark:bg-neutral-700 dark:border-gray-600 border my-2  shadow-md rounded-md">
        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="py-8 rounded-lg bg-gray-50 text-center flex flex-col gap-4 items-center justify-center">
                <livewire:frontend.profile-image :id="$doctor_details->id" />
                <div class="mt-2 sm:mt-4 flex flex-col items-center gap-2">
                    <h3 class="text-sm font-medium text-gray-800 sm:text-base lg:text-lg dark:text-neutral-200">
                        {{ $doctor_details->user->name }}
                    </h3>
                    <p class="text-xs text-gray-600 sm:text-sm lg:text-base dark:text-neutral-400">
                        {{ $doctor_details->speciality->name }}
                    </p>
                    <p class="text-xs text-gray-600 sm:text-sm lg:text-base dark:text-neutral-400">
                        {{ $doctor_details->hospital_name }}
                    </p>
                </div>
            </div>
            {{-- End Col --}}
            <div class="flex flex-col gap-2">
                <label for="" class="text-sm font-semibold">Select Appointment Type</label>
                <select wire:model="appointment_type"
                    class="py-3 px-4 pe-9 block w-full bg-gray-100 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    <option selected="">Open this select menu</option>
                    <option value="onsite">On site</option>
                    <option value="live consultation">Live consultation</option>
                </select>
                <h3 class="text-sm font-semibold">Select an Available Date</h3>
                <input type="text" id="datepicker" autocomplete="off"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Select Available date">
                @if ($selectedDate)
                    <div>
                        <h4 class="mt-4 text-red-700">Selected Date: <span
                                class="font-semibold">{{ $selectedDate }}</span></h4>
                    </div>
                @endif
                <div>
                    <h2 class="text-sm font-semibold mb-2">Available Time Slots</h2>
                    <div class="flex flex-wrap">
                        @foreach ($timeSlots as $slot)
                            <button class="m-2 p-2 bg-blue-500 text-white rounded hover:bg-blue-700" type="button"
                                wire:click="bookAppointment('{{ $slot }}')"
                                wire:confirm="Are really want to book appointment on {{ $selectedDate }}, {{ $slot }} ?">
                                {{ date('H:i', strtotime($slot)) }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- End Col --}}
        </div>
        {{-- End Grid --}}
    </div>
    {{-- End Card Blog --}}
    <script src="pikaday.js"></script>
    <script>
        // Inject available dates from Livewire
        var availableDates = @json($availableDates);

        var picker = new Pikaday({
            field: document.getElementById('datepicker'),
            format: 'YYYY-MM-DD',
            firstDay: 0,
            i18n: {
                previousMonth: 'Previous Month',
                nextMonth: 'Next Month',
                months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                weekdays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                weekdaysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
            },
            onSelect: function(date) {
                var selectedDate = picker.toString();
                @this.call('selectDate', selectedDate);
            },
            disableDayFn: function(date) {
                // Disable all dates not in the availableDates array
                var formattedDate = moment(date).format('YYYY-MM-DD');
                return !availableDates.includes(formattedDate);
            }
        });
    </script>
</div>
