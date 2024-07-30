@foreach ($links as $link)
    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $link->link_name }}
        </th>
        <td class="px-6 py-4">{{ $link->description_link }}</td>
        <td class="px-6 py-4">{{ $link->submittedBy->section->section_name }}</td>
        <td class="px-6 py-4">
            <a href="{{ $link->url }}" class="text-blue-600 hover:underline">{{ $link->url }}</a>
        </td>
        <td class="px-6 py-4 text-right">
            <button @click="editLink({{ $link->id }})"
                class="font-medium text-blue-600 hover:underline">Edit</button>
        </td>
    </tr>
@endforeach
