<ul class="nav table-nav">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
        Action <span class="caret"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">


        <li role="presentation"><a target="__blank" role="menuitem" tabindex="-1" href="{{route('show.product',['id' => $row->id, 'slug' => $row->slug])}}">
          <i class="fa fa-eye" aria-hidden="true"></i>View Product</a></li>
        <li role="presentation" class="divider"></li>
        

       
        @can('digital-products.edit')
        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('simple-products.edit',$row->id)}}">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Product</a></li>
        @endcan
        @can('digital-products.delete')
        <li role="presentation" class="divider"></li>
        <li role="presentation">
          <a data-toggle="modal" href="#{{ $row->id}}pro">
            <i class="fa fa-trash-o" aria-hidden="true"></i> {{__("Delete")}} 
          </a>
        </li>
        @endcan
      </ul>
    </li>
  </ul>
  @can('digital-products.delete')
  <div id="{{ $row->id }}pro" class="delete-modal modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="delete-icon"></div>
        </div>
        <div class="modal-body text-center">
          <h4 class="modal-heading">Are You Sure ?</h4>
          <p>Do you really want to delete this product <b>{{ $row->product_name }}</b>? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <form method="post" action="{{route('simple-products.destroy',$row->id)}}" class="pull-right">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endcan