@extends('layouts.main')

@section('container')
<div class="col-auto">
    <h1 class="app-page-title mb-0">Data Supplier</h1>
</div>

<div class="app-card app-card-orders-table shadow-sm mb-5">
    <div class="app-card-body">
        <div class="table-responsive">
            <table id="tableSupplier" class="table app-table-hover mb-0 text-left">
                <thead>
                    <tr>
                        <th class="cell">No</th>
                        <th class="cell">Nama</th>
                        <th class="cell">Email</th>
                        <th class="cell">No.Telp</th>
                        <th class="cell">Kota</th>
                        <th class="cell" style="width: 300px;text-align:center"><i class="fa-solid fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $all_suppliers)
                    <tr>
                        <td class="cell">{{$loop->iteration}}</td>
                        <td class="cell">{{$all_suppliers->nama}}</td>
                        <td class="cell">{{$all_suppliers->email}}</td>
                        <td class="cell">{{$all_suppliers->no_telp}}</td>
                        <td class="cell">{{$all_suppliers->kota}}</td>
                        <td class="cell">
                            <form action="{{ route('supplier.destroy', $all_suppliers->id) }}" method="POST">
                                <input type="hidden" value="{{ $all_suppliers->id }}" id="supplier_id">
                                <a id="show-supplier" class="btn btn-outline-info btn-xs" data-bs-toggle="modal"
                                    data-bs-target="#supplierDetail" role="button"><i class="fa fa-eye"></i>
                                    Detail</a>
                                <a class="btn btn-outline-warning btn-xs"
                                    href="{{ route('supplier.edit',$all_suppliers->id) }}">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-xs show-alert-delete-box"
                                    data-toggle="tooltip"><i class="fa fa-trash-o"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" style="margin-top: 9%; margin-left: 9%;" data-bs-backdrop="static" data-bs-keyboard="false"
    id="supplierDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Supplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="supplier-body">

            </div>
        </div>
    </div>
</div>
<script src="/js/jquery-3.6.3.min.js"></script>
<script src="/js/show-supplier.js"></script>
{{-- <script>
    new DataTable('#tableSupplier');
</script> --}}
@endsection