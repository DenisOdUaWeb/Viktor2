@csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" placeholder="Name" value="{{old('name') ?? $customer->name}}" name="name" type="text">
                </div>

                <!-- SOMETHING TEMPORARY THING !!!===-> MAKE IT BEACAUSE FORGET TO ADD FILLIBLE IN THE MODEL-->
                <!--<div class="form-group">
                    <label for="something">Name</label>
                    <input id="something" class="form-control" placeholder="something" value="{{old('something')}}" name="something" type="text">
                </div> -->
<!--END  SOMETHING TEMPORARY THING -->
                <div><strong>{{ $errors->first('name') }}</strong></div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" placeholder="Email" value="{{old('email') ?? $customer->email}}" name="email" type="text">
                </div>
                <div><strong>{{ $errors->first('email') }}</strong></div>

                <div class="form-group">
                    <label for="active">Status</label>
                    <select class="form-control" name="active" id="active">
                        <option value="" disabled="disabled">Select customer status</option>
                        @foreach($customer->activeOptions() as $activeOptionKey => $activeOptionValue)
                            <option value="{{$activeOptionKey}}" {{$customer->active == $activeOptionValue ? 'selected' : ''}}>{{$activeOptionValue}} refactored</option>
                        @endforeach
                        <option value="1" {{$customer->active == 'Active' ? 'selected' : ''}} >Active</option> <!-- {{$customer->active}} ?? -->
                        <option value="0" {{$customer->active == 'Inactive' ? 'selected' : ''}} >Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="company_id">Company</label>
                    <select class="form-control" name="company_id" id="company_id">
                        <option value="" disabled="disabled">Select company</option>
                        @foreach($companies as $company)
                            <option value="{{$company->id}}" {{$company->id == $customer->company_id ? 'selected' : ''}}>{{$company->name}}</option>
                        @endforeach    
                    </select>
                </div>
                <!-- IMAGE -->
                <div class="form-group">
                    <label for="image">Profile image</label>
                    <input id="image" name="image" type="file" class="form-control">
                    <div><strong>{{ $errors->first('image') }}</strong></div>
                </div>
                
                <!-- END IMAGE -->
