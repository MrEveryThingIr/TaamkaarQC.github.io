@extends('layouts.app')
@section('content')

<button><a href="{{ route('orderers.create') }}">Create New Orderer</a></button>
<h1>All orderers</h1>
@forelse ($orderers as $orderer)
        <div x-show="showorderer" class="bg-slate-300">
        orderer_id: <p class="p-4 text-lg font-bold text-white bg-black rounded-sm ">{{ $orderer->id }}</p>
        orderer_name:<p class="p-4 text-lg font-bold text-white bg-black rounded-sm">{{ $orderer->orderer_name }}</p>
        orderer_email:<p class="p-4 text-lg font-bold text-white bg-black rounded-sm ">{{ $orderer->orderer_email }}</p>
        orderer_phone:<p class="p-4 text-lg font-bold text-white bg-black rounded-sm">{{ $orderer->orderer_phone }}</p>
    </div>
@empty

@endforelse

@endsection
