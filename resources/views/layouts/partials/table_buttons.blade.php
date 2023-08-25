<style>
    .table_buttons {
        display: flex;
        width: 100%;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        align-content: center;
        margin: 0;
        padding: 0;
    }

    .table_buttons>* {
        margin-right: 5px;
        min-width: 27%;
        max-width: 100%;
        display: inline-block;
        font-size: 0.8em;
    }
</style>
<div class="row table_buttons">
    @if ($edit == true)
        <a href="{{ route($url . '.edit', $id) }}" class="btn btn-warning d-inline-block"><i class="fa fa-edit"></i></a>
    @endif
    @if ($delete == true)
        <form action="{{ route($url . '.destroy', $id) }}" method="post" style="display:inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger w-100"><i class="fa fa-trash"></i></button>
        </form>
    @endif
    @if ($view)
        <a href="{{ route($url . '.show', $id) }}" class="btn btn-info d-inline-block">
            @if (auth()->check() && auth()->user()->is_admin == true)
                <i class="fa fa-eye"></i>
            @else
                @lang('additional.buttons.more')
            @endif
        </a>
    @endif
</div>
