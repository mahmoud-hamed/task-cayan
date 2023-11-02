@forelse ($departments as $key=>$item)

<tr class="align-self-center" id="test">
    <td>{{ $key+1 }}</td>
 <td>
    {{ $item->name }}
 </td>

    <td>
        <span class=" btn round btn-outline-danger delete-row text-danger"
            data-url="{{ url('department/delete/' . $item->id) }}">
            <i class="fa-solid fa-trash"></i></span>

            <a class=" btn round btn-outline-primary  text-primary update_package_form"
            data-toggle="modal" 
            data-target="#updateModal"
            data-id = "{{ $item->id }}"
            data-name = "{{ $item->name}}"
            
               >
            <i class="fa-solid fa-edit"></i></a>
    </td>
  
</tr>
@empty
<tr>
    <td colspan="7">{{ __('admin.there_is_no_data_at_the_moment') }}</td>
</tr>
@endforelse