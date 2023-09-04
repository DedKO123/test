<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <x-bladewind.table>
        <x-slot name="header">
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
            <th>Created At</th>
        </x-slot>
        @foreach($users as $user)
            <tr>
                <td> @if($user->hasMedia('photo'))
                        <img
                            src="{{ asset('storage/' . $user->getMedia('photo')->first()->id . '/' . $user->getMedia('photo')->first()->file_name) }}"/>
                    @endif</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
    </x-bladewind.table>
    <div class="flex justify-center">
        <x-bladewind.button wire:click="load" size="small" class="mt-2">Show more</x-bladewind.button>
    </div>
    <x-bladewind.button color="green" size="small"
                        onclick="showModal('create-user')">
        Add new user
    </x-bladewind.button>
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet"/>

    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet"/>

    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>

    <script src="//unpkg.com/alpinejs" defer></script>
    @include('modals.user-create')
</div>

