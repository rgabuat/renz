@extends('layouts.app')

@section('title',"Invoivces")
@section('content')
<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <h2 class="text-primary"><b>Invoices</b></h2>
        @if (session('status'))
            <div class="bg-success text-center text-white py-2 mb-3">
                {{ session('status') }}
            </div>
        @endif
        
        <table class="table" id="article_tbl">
        <div class="col-4">
			<div class="btn-group submitter-group float-left" style="z-index:10">
				<div class="input-group-prepend">
						<div class="input-group-text form-control-sm  rounded-0">Status Filter</div>
				</div>
				<select class="form-control form-control-sm status-dropdown rounded-0">
					<option value="">All</option>
					<option value="published">Published</option>
					<option value="draft">Draft</option>
				</select>
			</div>
		</div>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Date</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice['id'] }}</td>
                <td>{{ $invoice['invoice_date_gen'] }}</td>
                <td>{{ $invoice['created_by'] }}</td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                            <!-- <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#publish#"><span class="fas fa-newspaper mr-2"></span>Publish Article</a> -->
                            <a class="dropdown-item" href="{{ url('invoice/show/'.$invoice['id']); }}"><span class="fas fa-eye mr-2"></span>View Invoice</a>
                    </div>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection
