@extends('layouts.admin')
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-earth-globe"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Trips
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    {{-- <a href="#" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a> --}}
                    &nbsp;
                    <div class="dropdown dropdown-inline">
                        <a href="{{ route('admin.trips.add') }}" class="btn btn-sm btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Add New
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__section kt-nav__section--first">
                                    <span class="kt-nav__section-text">Choose an action:</span>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-open-text-book"></i>
                                        <span class="kt-nav__link-text">Reservations</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                        <span class="kt-nav__link-text">Appointments</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-bell-alarm-symbol"></i>
                                        <span class="kt-nav__link-text">Reminders</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                                        <span class="kt-nav__link-text">Announcements</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-shopping-cart-1"></i>
                                        <span class="kt-nav__link-text">Orders</span>
                                    </a>
                                </li>
                                <li class="kt-nav__separator kt-nav__separator--fit">
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-rocket-1"></i>
                                        <span class="kt-nav__link-text">Projects</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-chat-1"></i>
                                        <span class="kt-nav__link-text">User Feedbacks</span>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Status:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_status">
                                            <option value="">All</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Delivered</option>
                                            <option value="3">Canceled</option>
                                            <option value="4">Success</option>
                                            <option value="5">Info</option>
                                            <option value="6">Danger</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Type:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_type">
                                            <option value="">All</option>
                                            <option value="1">Online</option>
                                            <option value="2">Retail</option>
                                            <option value="3">Direct</option>
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->
            <div class="kt-datatable" id="local_data"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection
@push('scripts')
<script src="./assets/js/data-trip-list.js" data-id="trip-list-script" data-url="{{ url('/') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$('.kt_sweetalert_delete_page').on('click', function(e) {
		   /* swal.fire({
		        title: 'Are you sure?',
		        text: "You won't be able to revert this!",
		        type: 'warning',
		        showCancelButton: true,
		        confirmButtonText: 'Yes, delete it!',
		        cancelButtonText: 'No, cancel!',
		        reverseButtons: true
		    }).then(function(result){
		        if (result.value) {
		            swal.fire(
		                'Deleted!',
		                'Your file has been deleted.',
		                'success'
		            )
		            // result.dismiss can be 'cancel', 'overlay',
		            // 'close', and 'timer'
		        } else if (result.dismiss === 'cancel') {
		            swal.fire(
		                'Cancelled',
		                'Your imaginary file is safe :)',
		                'error'
		            )
		        }
		    });*/
		});

	});
</script>
@endpush