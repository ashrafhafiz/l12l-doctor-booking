<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl max-auto sm:px-6 lg:px-8">
                <div class="bg-white over-flow-hidden shadow-sm sm:rounded-lg">
                    <livewire:frontend.featured-doctors :speciality_id="0" />
                    <livewire:frontend.specialist-cards />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
