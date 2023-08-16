<div>


<div class="row">
            <div class="col-md-12">
          
                <div class="card">
                    <div class="card-header">
                        <h4>Category 
                            <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm float-end">Add Category</a></h4>
</div>

<div class="card-body filterable">
                <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
<th>ID</th>
<th>Name</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->status == '1' ? 'Hidden':'Visible' }}</td>
        <td>
            <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
            <a data-bs-toggle="modal" data-bs-target="#dlt{{ $category->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
</td>
</tr>
<div wire:ignore.self class="modal fade" id="dlt{{ $category->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="addnew" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete value</h5>
                                            <button type="button" class="close close-modal" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" align="center">
                                            <label>Are you sure you want delete this client?</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-modal"
                                                data-dismiss="modal">No</button>
                                            <a href="{{ Route('admin.home.category.delete', $category->id) }}"
                                                class="btn btn-danger">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
@endforeach
</tbody>
</table>

{{ $categories->links() }}

</div>
</div>
</div>
</div>
</div>

@push('script')
<script>
window.addEventListener('close-modal', event => {
  $('.modal').modal('hide');
})
</script>
@endpush