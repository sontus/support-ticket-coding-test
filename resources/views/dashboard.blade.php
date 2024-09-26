@extends('layouts.app')
@section('title',"Dashboard")
@push('custom-css')

@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ticket list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Ticket list</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totalTickets }}</h3>

                                    <p>Total Tickets</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('tickets.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $openTickets }}</h3>
                                    <p>Open Tickets </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{ route('tickets.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $closedTickets }}</h3>

                                    <p>Closed Tickets</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('tickets.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <div class="d-flex justify-content-between">
                                <h5 class="m-0">Latest Tickets</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket Number</th>
                                    @can('ticket-update')
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                    @endcan
                                    <th>Ticket Title</th>
                                    <th>Ticket Description</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($latestTickets as $key => $ticket)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->ticket_number }}</a>
                                        </td>
                                        @can('ticket-update')
                                            <td>{{ $ticket->user->name }}</td>
                                            <td>{{ $ticket->user->email }}</td>
                                        @endcan
                                        <td>{{ $ticket->title }}</td>
                                        <td>{{ $ticket->description }}</td>

                                        <td class="text-center">
                                            @if($ticket->status == "open")
                                                <span class="badge badge-success">Open</span>
                                            @else
                                                <span class="badge badge-danger">Close</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Action</button>
                                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu" style="">
                                                    @can('ticket-view')
                                                        <a class="dropdown-item text-success" href="{{ route('tickets.show', $ticket->id) }}"> <i class="fa fa-eye"></i> View
                                                        </a>
                                                    @endcan
                                                    @can('ticket-update')
                                                        <a class="dropdown-item text-primary" href="{{ route('tickets.edit', $ticket->id) }}"> <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                    @endcan
                                                    @can('ticket-delete')
                                                        <form method="POST" action="{{ route('tickets.destroy', $ticket->id) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="btn btn-default dropdown-item show_confirm text-danger" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i> Delete</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket Number</th>
                                    @can('ticket-update')
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                    @endcan
                                    <th>Ticket Title</th>
                                    <th>Ticket Description</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endSection

@push('custom-js')

@endpush
