<x-app-layout>
    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-xl font-semibold mb-4">ثبت کارفرمای جدید</h1>

        <form method="POST" action="{{ route('orderers.store') }}">
            @csrf

            <div class="mb-4">
                <x-label for="orderer_name" value="نام کارفرما" />
                <x-input id="orderer_name" class="block mt-1 w-full" type="text" name="orderer_name" required autofocus />
            </div>

            <div class="mb-4">
                <x-label for="orderer_email" value="ایمیل" />
                <x-input id="orderer_email" class="block mt-1 w-full" type="email" name="orderer_email" />
            </div>

            <div class="mb-4">
                <x-label for="orderer_phone" value="تلفن" />
                <x-input id="orderer_phone" class="block mt-1 w-full" type="text" name="orderer_phone" />
            </div>

            <div class="mb-4">
                <x-label for="orderer_brand" value="برند کارفرما" />
                <x-input id="orderer_brand" class="block mt-1 w-full" type="text" name="orderer_brand" />
            </div>

            <x-button>ثبت</x-button>
        </form>
    </div>
</x-app-layout>
