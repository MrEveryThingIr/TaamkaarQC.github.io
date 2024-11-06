<div class="container px-4 py-8 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Git Commits</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('git-commits.index') }}" class="flex flex-col gap-4 mb-6 md:flex-row">
        <input type="text" name="branch" placeholder="Search by branch" value="{{ request('branch') }}" class="w-full p-2 border rounded-lg md:w-1/4">
        <input type="text" name="safdarCoded" placeholder="Search by safdarCoded" value="{{ request('safdarCoded') }}" class="w-full p-2 border rounded-lg md:w-1/4">
        <input type="text" name="gitCode" placeholder="Search by gitCode" value="{{ request('gitCode') }}" class="w-full p-2 border rounded-lg md:w-1/4">
        <input type="text" name="commitMessage" placeholder="Search by commitMessage" value="{{ request('commitMessage') }}" class="w-full p-2 border rounded-lg md:w-1/4">
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg">Search</button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-3 text-sm font-semibold text-left text-gray-700">Branch</th>
                    <th class="p-3 text-sm font-semibold text-left text-gray-700">SafdarCoded</th>
                    <th class="p-3 text-sm font-semibold text-left text-gray-700">Git Code</th>
                    <th class="p-3 text-sm font-semibold text-left text-gray-700">Commit Message</th>
                    <th class="p-3 text-sm font-semibold text-left text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gitCommits as $commit)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 text-sm text-gray-700">{{ $commit->branch }}</td>
                    <td class="p-3 text-sm text-gray-700">{{ $commit->safdarCoded }}</td>
                    <td class="p-3 text-sm text-gray-700">{{ $commit->gitCode }}</td>
                    <td class="p-3 text-sm text-gray-700">{{ $commit->commitMessage }}</td>
                    <td class="p-3 text-sm text-gray-700">
                        <a href="{{ route('git-commits.show', $commit) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('git-commits.edit', $commit) }}" class="ml-2 text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('git-commits.destroy', $commit) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $gitCommits->links() }}
    </div>
</div>
