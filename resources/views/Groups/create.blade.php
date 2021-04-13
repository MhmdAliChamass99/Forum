
  @extends('layouts.app')
  @section('content')
      <form action="/group" method="POST">
@csrf
<div class="form-group row">
                            <label for="groupname" class="input100 col-md-4 col-form-label text-md-right">{{ __('Group Name') }}</label>

                            <div class="col-6">
                                <input id="groupname" type="text" class="form-control @error('groupname') is-invalid @enderror" name="groupname" value="{{ old('groupname') }}" required autocomplete="groupname" autofocus>

                                @error('groupname')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="input100 col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
                               
                                </textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
<label  class="input100 col-md-4 col-form-label text-md-right">Group Status</label>

<div class="col-8 input100 col-md-8 col-form-label">
            <select name="state" class="input100 col-md-8 col-form-label"  id="state">
              <option value="1">Public</option>
              <option value="2">Private</option>
            </select>
</div>
</div>

<div class="row">
    <div class="col-8"></div>
    <div class="col-2">
        <button class="btn btn-info" type="submit">Create Group</button>
    </div>
</div>
</div>
</div>
</form>
@endsection