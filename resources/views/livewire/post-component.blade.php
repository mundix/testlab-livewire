<div>
    <div class="row">
        <div class="col-md-6">
            <select name="category" id="category" wire:model='category'>
                <option value="">All Categories</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <input type="text" wire:model.debounce.500ms='searchQuery' placeholder="Search ...">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="datatable table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts ?? [] as  $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>{{$post->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
