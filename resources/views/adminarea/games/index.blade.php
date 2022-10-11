@extends('adminarea.layout')

@section('content')
	<!-- begin::LivewireTable -->
	<livewire:adminarea.overview model="{{$model}}"></livewire:adminarea.overview>
	<!-- end::LivewireTable -->
@endsection


@push('actions')
	<x-adminarea.partials.pill-button text="Search" icon="magnifying-glass" id='trigger-search'></x-adminarea.partials.pill-button>
@endpush


@push('footer-scripts')
	<script>

		function toggleSearch(){
			if($('#model-search').css('display') === 'flex'){
				$('#model-search').fadeToggle()
			} else {
				$('#model-search').fadeToggle().css('display', 'flex');
				$('#model-search input[type="text"]').focus();
			}
		}

		$(document).ready(function() {

			$('#trigger-search').on('click', function(e) {
                e.preventDefault();
				toggleSearch();
			});


			$(document).on("keyup", function( e ) {
				// Ctrl+space opens the autocomplete dropdown
				if(e.code === 'Backquote'){
					toggleSearch();
				}

			})

			$(document).on('keyup', function(e) {
				if (e.key === "Escape" || e.key === "Enter") { // escape key maps to keycode `27`
					toggleSearch();
				}
			});
		});
	</script>
@endpush