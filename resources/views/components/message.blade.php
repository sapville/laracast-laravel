@if(session()->has('success'))
    <div x-data="{show: true}">
        <div
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition:leave.duration.500ms
            class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm"
        >
            <p>{{session('success')}}</p>
        </div>
    </div>
@endif
