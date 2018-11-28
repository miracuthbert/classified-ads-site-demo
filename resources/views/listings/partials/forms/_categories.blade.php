<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
    <label for="category" class="control-label">Category</label>
    <select name="category" id="category"
            class="form-control"{{ isset($listing) && $listing->live() ? ' disabled="disabled"' : '' }}>
        <option value="">--- Select a category ---</option>

        @foreach($categories as $parent)
            @if($parent->slug === "listing")
                @foreach($parent->children as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach($category->children as $child)

                            @if(
                                isset($listing) && !old('category') && $listing->category_id == $child->id ||
                                old('category') == $child->id
                            )
                                <option value="{{ $child->id }}" selected="selected">{{ $child->name }}
                                    ($. {{ number_format($child->price, 2) }})
                                </option>
                            @else
                                <option value="{{ $child->id }}">{{ $child->name }}
                                    ($. {{ number_format($child->price, 2) }})
                                </option>
                            @endif

                        @endforeach
                    </optgroup>
                @endforeach
            @endif
        @endforeach
    </select>

    @if($errors->has('category'))
        <span class="help-block">
            <strong>{{ $errors->first('category') }}</strong>
        </span>
    @endif
</div>