@extends("admin/layouts.master-soyuz")
@section('title','Cities | ')
@section("body")


    <div class="box">
      <div class="box-header with-border">
        <button type="button" data-toggle="modal" data-target="#createCity" class="pull-right btn btn-md btn-success">
          <i class="fa fa-plus"></i> {{__("Add new city")}}
        </button>
        <div class="box-title">City</div>
      </div>
      
      <div class="box-body">
        <table id="citytable" class="table table-hover table-responsive">
          <thead>
            <tr class="table-heading-row">
              
              <th>ID</th>
              <th>City </th>
              <th>State </th>
              <th>Country</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>

<!--Add new city Modal -->
<div class="modal fade" id="createCity" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New State</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('city.store') }}" method="POST">
          @csrf
         
             
                <div class="row">
                  <div class="form-group">
                    
                    <div class="col-md-11">
                      
                      <div class="form-group">
                        <label>
                          Select Country: <span class="text-red">*</span>
                        </label>
                        <select id="country_id" required data-placeholder="{{ __("Select country") }}" class="select2 form-control">
                        
                          @foreach($countries as $country)
                            <option value="">{{ __("Select country") }}</option>
                            <option {{ old('country_id') == $country->id ? "selected" : "" }} value="{{$country->id}}">{{ $country->nicename }}</option>
                          @endforeach

                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label class="" for="first-name">
                          Select State: <span class="text-red">*</span>
                        </label>
                        <select id="upload_id" required name="state_id" data-placeholder="{{ __("Select state") }}" class="select2 form-control">
                            
                          <option value="">{{ __("Select state") }}</option>
                         
                        </select>
                      </div>

                    </div>
                    <br> 
                    <button data-dismiss="modal" title="Add new state" type="button" data-toggle="modal" data-target="#createState" class="btn btn-md btn-success">
                      <i class="fa fa-plus"></i>
                    </button>

                  </div>
                  
                </div>

          <div class="form-group">
            <label>Enter City Name: <span class="text-red">*</span></label>
            <input value="{{ old('name') }}" required type="text" class="form-control" name="name" placeholder="Enter city name">
          </div>

          <div class="form-group">
            <label>Enter City Pin/Zip or postal code: @if($pincodesystem == 1) <span class="text-red">*</span> @endif</label>
            <input {{ $pincodesystem == 1 ? "required" : "" }} value="{{ old('pincode') }}"  type="text" class="form-control" name="pincode" placeholder="Enter city pin/zip or postal code">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-md btn-success">+ Create</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!--Add new state Modal -->
<div class="modal fade" id="createState" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          {{__('Add New State')}}
        </h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('state.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label>Select Country: <span class="text-red">*</span></label>
            <select required name="country_id" class="form-control select2">
              @foreach(App\Allcountry::orderBy('name','ASC')->get() as $country)
                <option {{ old('value') == $country['id'] ? "selected" : "" }} value="{{ $country['id'] }}">{{ $country['nicename'] }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Enter State Name: <span class="text-red">*</span></label>
            <input value="{{ old('name') }}" required type="text" class="form-control" name="name" placeholder="Enter state name">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-md btn-success">
              <i class="fa fa-plus"></i> {{__("Create")}}
            </button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

        <!-- /page content -->
@endsection
@section('custom-script')
   <script>var url = @json(route('city.index'));</script>
   <script src="{{ url('js/city.js') }}"></script>
   <script>var baseUrl = @json(url('/'));</script>
   <script src="{{ url('js/ajaxlocationlist.js') }}"></script>
@endsection