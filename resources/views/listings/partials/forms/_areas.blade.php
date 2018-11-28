<div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
    <label for="area" class="control-label">Areas</label>
    <select name="area" id="area" class="form-control">
        <option value="">--- Select an area ---</option>

        @foreach($areas as $country)
            <optgroup label="{{ $country->name }}">
                @if($country->slug == "world-wide")
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endif
                @foreach($country->children as $state)

                    @if(
                        isset($listing) && !old('area') && $listing->area->id == $state->id ||
                        !isset($listing) && !old('area') && $area->id == $state->id ||
                        old('area') == $state->id
                    )
                        <option value="{{ $state->id }}" selected="selected">{{ $state->name }}</option>
                    @else
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endif
                @endforeach
            </optgroup>
        @endforeach
    </select>

    @if($errors->has('area'))
        <span class="help-block">
            <strong>{{ $errors->first('area') }}</strong>
        </span>
    @endif
</div>