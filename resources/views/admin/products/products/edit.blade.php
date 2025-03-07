<x-authenticated-layout>
    <x-slot name="head">
        <title>Product | Update</title>
    </x-slot>

    <section class="Products">
        <div class="custom_form">
            <div class="header">
                <div class="icon">
                    <a href="{{ route('xxx.index') }}">
                        <span class="fas fa-arrow-left"></span>
                    </a>
                </div>
                <p>Update xxx</p>
            </div>

            <form action="{{ route('xxx.update', $xxx->id) }}" method="post">
                @csrf
                @method('patch')

                xxx_inputs

                <div class="buttons">
                    <button type="submit">Update xxx</button>

                    <button type="button" class="btn_danger" onclick="deleteItem({{ $xxx->id }}, 'xxx');"
                        form="deleteForm_{{ $xxx->id }}">
                        <i class="fas fa-trash-alt delete"></i>
                        <span>Delete xxx</span>                        
                    </button>
                </div>
            </form>

            <form id="deleteForm_{{ $xxx->id }}" action="{{ route('xxx.destroy', $xxx->id) }}" method="post"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </section>

    <x-slot name="scripts">
        <x-sweetalert />
    </x-slot>
</x-authenticated-layout>
