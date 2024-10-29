@extends('layouts.app')
@section('content')

<div  x-data="{showordererform:false , showorderer=false}">

    <button @click="showordererform=!showordererform"
     class="p-2 text-black bg-blue-500 rounded">
     create orderer
    </button>
    <div x-show="showordererform">
        <x-orderer-form></x-orderer-form>
    </div>

    <div class=" flex-col col-span-3">
        @forelse ($orderers as $orderer)
        <button @click="showorderer=!showorderer"
        class="p-2 text-black bg-blue-500 rounded">
        {{ $orderer->orderer_name }}
       </button>
        @empty
            there is not any orderer
        @endforelse
    </div>
    {{-- <div x-show="showorderer" class="bg-slate-300">
        orderer_id: <p class="rounded-sm p-4 bg-black text-white">{{ $orderer->orderer_id }}</p>
        orderer_name:<p class="rounded-sm p-4 bg-black text-white">{{ $orderer->orderer_name }}</p>
        orderer_email:<p class="rounded-sm p-4 bg-black text-white">{{ $orderer->orderer_email }}</p>
        orderer_phone:<p class="rounded-sm p-4 bg-black text-white">{{ $orderer->orderer_phone }}</p>
    </div> --}}

</div>

@forelse ($orderers as $orderer )



@empty
کارفرمایی وجود ندارد
@endforelse


{{-- @foreach ($orderers as $orderer)
    شناسه کارفرما: <p>{{ $orderer }}</p>
@endforeach --}}

@endsection
