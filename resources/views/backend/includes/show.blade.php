<p>
    @lang('Displaing all the values of :module_name (Id: :id)', ['module_name' => ucwords($module_name_singular), 'id' => $$module_name_singular->id]).
</p>
<table class="table table-responsive-sm table-hover table-bordered">
    <?php
    $all_columns = $$module_name_singular->getTableColumns();
    ?>
    <thead>
        <tr>
            <th scope="col">
                <strong>
                    @lang('Name')
                </strong>
            </th>
            <th scope="col">
                <strong>
                    @lang('Value')
                </strong>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_columns as $column)
            @php
                if ($column->Field === 'more_images' || $column->Field === 'created_by' || $column->Field === 'deleted_by' || $column->Field === 'updated_by' || $column->Field === 'deleted_at' || $column->Field === 'user_id' ) {
                    continue;
                }
            @endphp
            <tr>
                <td>
                    <strong>
                        {{ __(label_case($column->Field)) }}
                    </strong>
                </td>
                <td>
                    {!! show_column_value($$module_name_singular, $column) !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Lightbox2 Library --}}
<x-library.lightbox />
