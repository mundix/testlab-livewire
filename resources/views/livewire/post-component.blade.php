<div>
    <div class="row">
        <select name="category" id="category">
            @foreach($categories ?? [] as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
</div>
