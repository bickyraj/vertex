"use strict";
// Class definition

var url = document
  .querySelector('script[data-id="blog-list-script"][data-url]')
  .getAttribute('data-url');
var KTDatatableJsonRemoteDemo = function () {
	// Private functions
	var dataTable;

	// basic demo
	var demo = function () {

		dataTable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				method: 'get',
				source: {
					read: {
						url: '/admin/blogs/list',
						method: 'GET'
					}
				},
				pageSize: 10,
                saveState: true,
                serverPaging: true
			},
			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer,
                icons: {
                    pagination: {
                      next: 'la la-angle-right',
                      prev: 'la la-angle-left',
                      first: 'la la-angle-double-left',
                      last: 'la la-angle-double-right',
                      more: 'la la-ellipsis-h'
                    }
                }
			},
			// column sorting
			sortable: true,
			pagination: true,
			search: {
				input: $('#generalSearch')
			},
			// columns definition
			columns: [
				{
					field: 'id',
					title: '#',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {class: 'kt-checkbox--solid'},
					textAlign: 'center',
				},
				{
					field: 'name',
					title: 'Title',
				},
				{
					field: 'image_url',
					title: 'Banner',
					template: function(item) {
						return '\
						<img class="tbl-img" src="'+item.thumbImageUrl+'" />\
						';
					}
				},
				{
					field: 'slug',
					title: 'Slug'
				},
				{
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 110,
					autoHide: false,
					overflow: 'visible',
					template: function(item) {
						return '\
						<a href="'+url+'/admin/blogs/edit/'+item.id+'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
							<i class="la la-edit"></i>\
						</a>\
						<button class="btn btn-sm btn-clean btn-icon btn-icon-md kt_sweetalert_delete_blog" data-id="'+item.id+'" title="Delete">\
							<i class="la la-trash"></i>\
						</button>\
					';
					},
				}
            ],
            toolbar: {
                layout: ['pagination', 'info']
            }
		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Status');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

	};

	$(document).on('click', '.kt_sweetalert_delete_blog', function(event) {
		var e = $(this);

		swal.fire({
		    title: 'Are you sure you want to delete this?',
		    // text: "You won't be able to revert this!",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonText: 'Yes'
		}).then(function(result) {
		    if (result.value) {
		    	var id = e.attr('data-id');
		    	var action_url = url + '/admin/blogs/delete/' + id;
		    	$.ajax({
		    		url: action_url,
		    		type: "DELETE",
		    		dataType: "json",
		    		async: "false",
		    		success: function(res) {
		    			dataTable.reload();
		    			Toast.fire({
		    			  type: 'success',
		    			  title: 'The blog has been deleted.'
		    			})
		    		}
		    	})
		    }
		});
	});

	return {
		// public functions
		init: function () {
			demo();
		}
	};
}();

jQuery(document).ready(function () {
	setTimeout(function() {
		KTDatatableJsonRemoteDemo.init();
	}, 100);
});
