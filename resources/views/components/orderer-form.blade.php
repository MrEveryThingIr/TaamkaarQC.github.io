<form method="POST" action="{{ route('orderers.store') }}" enctype="multipart/form-data">
    @csrf

    <!-- Orderer Name -->
    <div class="mb-4">
        <x-label for="orderer_name" value="نام کارفرما" />
        <x-input id="orderer_name" class="block w-full mt-1" type="text" name="orderer_name" required autofocus />
        @error('orderer_name')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Orderer Email -->
    <div class="mb-4">
        <x-label for="orderer_email" value="ایمیل" />
        <x-input id="orderer_email" class="block w-full mt-1" type="email" name="orderer_email" />
        @error('orderer_email')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Orderer Phone -->
    <div class="mb-4">
        <x-label for="orderer_phone" value="تلفن" />
        <x-input id="orderer_phone" class="block w-full mt-1" type="text" name="orderer_phone" />
        @error('orderer_phone')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Orderer Brand (Image Upload) -->
    <div class="mb-4">
        <x-label for="orderer_brand" value="برند کارفرما (تصویر)" />
        <x-input id="orderer_brand" class="block w-full mt-1" type="file" name="orderer_brand" accept="image/*" />
        <small class="text-gray-500">Accepted formats: JPG, JPEG, PNG</small>
        @error('orderer_brand')
            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Button -->
    <x-button class='items-center justify-center w-full'>ثبت کارفرما</x-button>
</form>
