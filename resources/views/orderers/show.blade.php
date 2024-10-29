@extends('layouts.app')
@section('content')
<div x-show="showorderer" class="bg-slate-300">
    orderer_id: <p class="p-4 text-lg font-bold text-white bg-black rounded-sm ">{{ $orderer->id }}</p>
    orderer_name:<p class="p-4 text-lg font-bold text-white bg-black rounded-sm">{{ $orderer->orderer_name }}</p>
    orderer_email:<p class="p-4 text-lg font-bold text-white bg-black rounded-sm ">{{ $orderer->orderer_email }}</p>
    orderer_phone:<p class="p-4 text-lg font-bold text-white bg-black rounded-sm">{{ $orderer->orderer_phone }}</p>
</div>
<button>
    <a href="{{ route('orderers.projects.create', ['orderer' => $orderer->id]) }}">Create New Project</a>
</button>

@endsection
