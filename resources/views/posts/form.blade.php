<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title">Title: <span class='text-danger'>*</span></label>
                            {!! Form::text('title', null, ['placeholder' => 'Enter Title', 'class' => 'form-control', 'id' => 'title']) !!}
                            @error('title')
                                <span class="invalid feedback text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                         <div class="col-md-6 mb-3">
                            <label>Category: <span class='text-danger'>*</span></label>
                            <select name="category[]" id="category" class="form-control multi-select" multiple="multiple" data-placeholder="Select Category" required>
                                @foreach($categories as $key => $value)
                                    <option value="{{$key}}"
                                        @if(in_array($key, $category_ids))
                                            selected="selected"
                                        @endif>
                                        {{$value}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
