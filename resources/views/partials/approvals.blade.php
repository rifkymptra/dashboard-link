@foreach ($links as $link)
    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $link->link_name }} @if ($link->vpn)
                <span class="bg-cyan-400 p-1 text-[10px] font-bold rounded-full">
                    VPN!
                </span>
            @endif
        </th>
        <td class="px-2 sm:px-6 py-4">{{ $link->description_link }}</td>
        <td class="px-2 sm:px-6 py-4">{{ $link->submittedBy->section->section_name }}</td>
        <td class="px-2 sm:px-6 py-4">
            <a href="{{ $link->url }}" class="text-blue-600 hover:underline">{{ $link->url }}</a>
        </td>
        {{-- <td class="px-2 sm:px-6 py-4">{{ $link->status }}</td> --}}
        <td class="px-2 sm:px-6 py-8 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 ">
            <form action="{{ route('approval.accept', $link->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setujui</button>
            </form>
            <form action="{{ route('approval.reject', $link->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full sm:w-auto text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Tolak</button>
            </form>
        </td>
    </tr>
@endforeach
