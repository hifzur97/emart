@extends('admin.layouts.sellermaster')
@section('title','Add New Product |')
@section('body')

@component('seller.components.breadcumb',['secondactive' => 'active'])
@slot('heading')
   {{ __('Add New Product ') }}
@endslot
@slot('menu1')
   {{ __('Product') }}
@endslot
@slot('menu1')
   {{ __('Add New Product ') }}
@endslot

@slot('button')
<div class="col-md-4 col-lg-4">
  <div class="widgetbar">
    <a href="{{ route('my.products.index') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>

  </div>
</div>
@endslot

@endcomponent

<div class="contentbar">
    @if ($errors->any())  
    <div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $error)     
    <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="color:red;">&times;</span></button></p>
        @endforeach  
    </div>
    @endif
                          
                        
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="card-title"> {{__("Add New Product ")}}</h5>
        </div>
        <div class="card-body">
          @include('seller.product.tab.product')
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="taxmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleStandardModalLabel">Product Tax Information(PTI)</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div id="accordion">
              @foreach(App\TaxClass::all() as $protax)
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#tbl{{$protax->id}}"
                      aria-expanded="false" aria-controls="{{$protax->title}}">
                      {{$protax->title}}
                    </button>
                  </h5>
                </div>
                <div id="tbl{{$protax->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                      <tr>
                        <th>Tax Name
                          <img src="{{(url('images/info.png'))}}" class="height-15" data-toggle="popover"
                            data-content="You Want to Choose Tax Class Then Apply same Tax Class And Tax Rate .">
                        </th>
                        <th>Tax Rate</th>
                        <th>Priority
                          <img src="{{(url('images/info.png'))}}" class="height-15" data-toggle="popover" data-content="1 Priority Is Higher Priority And All Numeric Number Is Lowest Priority,
                          Priority Are Accept Is Numeric Number.">
                        </th>
                        <th>Based On <img src="{{(url('images/info.png'))}}" class="height-15" data-toggle="popover"
                            data-content="You Want To Choose Billing address.. 
                       Then Billing Address And Zone Address Are Same Then Tax Will Be Applied,
                        And You Will Be Choose Store Address then Store Addrss And User Billing Address Is Same Then Tax Will Be Apply  .">
                        </th>
                        <th>Zone Details<img src="{{(url('images/info.png'))}}" class="height-15" data-toggle="popover"
                            data-content="You Want To Choose Billing address.. 
                       Then Billing Address And Zone Address Are Same Then Tax Will Be Applied,
                        And You Will Be Choose Store Address then Store Addrss And User Billing Address Is Same Then Tax Will Be Apply  .">
                        </th>
                      </tr>
                      @if(isset($protax->priority))
    
                      @foreach($protax->priority as $k => $taxRate)
    
                      @if(isset($protax->taxRate_id[$taxRate]))
                      @php $taxs = App\Tax::where('id',$protax->taxRate_id[$taxRate])->first(); @endphp
    
                      @if(isset($taxs))
    
                      <tr>
                        <td>
    
                          {{$taxs->name}}
                        </td>
                        <td>@if($taxs->type=='f'){{$taxs->rate}}{{'%'}}@else{{$taxs->rate}}@endif</td>
                        <td>{{$taxRate}}</td>
                        <td>{{$protax->based_on[$taxRate]}}</td>
                        <td>
                          <?php $zone = App\Zone::where('id',$taxs->zone_id)->first();?>
                          @if(!empty($zone))
                          {{$zone->state_id=='0'?'All Zone':$zone->title}}
                          @endif
                        </td>
                      </tr>
    
                      @endif
    
                      @endif
    
                      @endforeach
    
                      @endif
                    </table>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
      </div>
  </div>
</div>



@endsection
                
                        
                      
                      
                        
                    
                  
                    
    
                  
          
                  
    
    
          
                  
    
    
                  
                  
                
    
                
                                      


          

            
          
              




            

            
            
            
  
                 
  
               
  
          
    
             
            

          


