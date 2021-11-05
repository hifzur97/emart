<form action="{{ route('brand.quick.update',$id) }}" method="POST">
      {{csrf_field()}}
      <button @if(env('DEMO_LOCK') == 0) type="submit" @else disabled title="This operation is disabled in demo !" @endif class="btn btn-xs {{ $status==1 ? "btn-success" : "btn-danger" }}">
        {{ $status ==1 ? 'Active' : 'Deactive' }}
      </button>
</form> 