<!-- resources/views/livewire/dynamic-search.blade.php -->

<div>
    <label for="searchTerm">Search:</label>
    <input type="text" id="searchTerm" wire:model.debounce.300ms="searchTerm">

    @if (!empty($results))
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <!-- ... add other columns ... -->
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->id }}</td>
                        <!-- ... display other attributes ... -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
