@extends('layouts.app')
@section('title', "Update Ticket")
@push('custom-css')

@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Ticket</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Update Ticket</li>
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

                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <div class="d-flex justify-content-between">
                                <h5 class="m-0">Ticket #{{ $ticket->ticket_number }} - {{ $ticket->title }}</h5>
                                <a href="{{ route('tickets.index') }}" class="btn btn-primary float-right">Tickets</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <!-- The time line -->
                                    <div class="timeline">
                                        <div class="time-label">
                                            @if($ticket->status == "open")
                                                <span class="bg-green">Open</span>
                                            @else
                                                <span class="bg-red">Closed</span>
                                            @endif
                                        </div>
                                        <div>
                                            <i class="fas fa-user bg-green"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> {{ date('F d, Y, H:i', strtotime($ticket->created_at)) }}</span>
                                                <h3 class="timeline-header"><a href="#">{{ $ticket->user->name }}</a> Open Ticket</h3>

                                                <div class="timeline-body">
                                                    {{ $ticket->description }}
                                                </div>

                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        @foreach($ticket_responses as $t_response)
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-reply bg-blue"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> {{ date('F d, Y, H:i', strtotime($t_response->created_at)) }}</span>
                                                    <h3 class="timeline-header no-border"><a href="#">{{ $t_response->user->name }}</a> </h3>

                                                    <div class="timeline-body">
                                                        {{$t_response->message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                        @endforeach
                                    </div>
                                    @if($ticket->status == "open")
                                        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                                            <div class="row">

                                                @csrf
                                                @method('PUT')
                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <label for="message">Description <span class="text-danger">*</span></label>
                                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="status" class="control-label">Status</label>
                                                        <select name="status" id="status" class="form-control" required>
                                                            <option @if($ticket->status == "open") selected @endif value="open">Open</option>
                                                            <option @if($ticket->status == "closed") selected @endif value="closed">Closed</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="card-footer d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>

                                            </div>
                                        </form>
                                    @endif
                                </div>
                                <!-- /.col -->
                            </div>
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
