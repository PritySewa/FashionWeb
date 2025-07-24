@forelse($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center text-gray-500 italic">No users match your search.</td>
    </tr>
@endforelse
