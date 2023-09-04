<x-bladewind.modal
    name="create-user"
    title="Creat new user"
    ok_button_label="Create"
    ok_button_action="saveProfile()"
    close_after_action="false"
    backdrop_can_close="false"
    size="large">

    <form method="post" action="{{ route('store') }}" enctype="multipart/form-data" class="user-form">
        <x-bladewind.input required="true" label="Name" name="name"/>
        <x-bladewind.input required="true" label="Password" name="password"/>
        <x-bladewind.input required="true" label="Confirm Password" name="password_confirmation"/>
        <x-bladewind.input required="true" label="Email" name="email"/>
        <x-bladewind.input required="true" label="Phone" name="phone"/>
        <x-bladewind.input required="true" label="City" name="city"/>
        <input type="file" name="img" placeholder="Upload your photo" />
    </form>
</x-bladewind.modal>

<script>
    saveProfile = () => {
        domEl('.user-form').submit();
    }
</script>
