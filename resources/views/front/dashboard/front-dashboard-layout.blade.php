<?php
   use Illuminate\Support\Facades\Route;;
   $routeName = Route::current();
   $pageName = $routeName->uri();
?>
<!doctype html>
<html lang="en">
   <head>
      <?=$head?>
   </head>
   <body>
      <!-- ********|| HEADER START ||******** -->
      <header id="header" class="header header-dashboard">
         <?=$header?>
      </header>
      <!-- *******|| HEADER ENDS ||******** -->

      <!-- *******|| MAINBODY STRATS ||******* -->
      <?=$maincontent?>
      <!-- ********|| MAINBODY ENDS ||******* --->

      <!-- ********|| FOOTER STRATS ||****** ---->
      <?=$footer?>
      <!-- ********|| FOOTER ENDS ||******** ---->

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>js/bootstrap/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    	<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>js/jquery.serialtabs.js"></script>
		<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    	<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>js/script.js" defer type="text/javascript"></script>
    	<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>owl/owl-min.js"></script>
		<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>js/easyResponsiveTabs.js"></script>

		<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
		<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>vendors/simplebar/js/simplebar.min.js"></script>
		<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>vendors/@coreui/utils/js/coreui-utils.js"></script>
	 	<!-- 
	 	
	 	 -->
	 	
	</body>
</html>
   <script type="text/javascript">
   		$(document).ready( function () {
				var table =	$('#example')
					.addClass( 'nowrap' )
					.DataTable( {
						responsive: true,
						search: {"search": ""},
				});
				var table2 = $('#example2')
					.addClass( 'nowrap' )
					.DataTable( {
	 				  	responsive: true,
						search: {"search": ""},
				});
				var table3 = $('#example3')
					.addClass( 'nowrap' )
					.DataTable( {
						responsive: true,
						search: {"search": ""},
				});
				
			});
        (function() {
			'use strict'
			document.querySelector('#myNavbarToggler4').addEventListener('click', function() {
				document.querySelector('.offcanvas-collapse').classList.toggle('open')
			})
			document.querySelector('.mobileclose').addEventListener('click', function() {
				document.querySelector('.offcanvas-collapse').classList.toggle('close');
				document.querySelector('.offcanvas-collapse').classList.remove('open')
			})
		})()
    </script>
	<script>
		$(document).on('click', '.js-add2-row', function() { 
			debugger;
		$('.function-table-2').append($('.function-table-2').find('.function-tr-2:last').clone());
		});
		$(document).on('click','.js-del2-row', function(event){
			debugger;
			$target=$(event.target);
			$target.closest('.function-tr-2').remove();
		});
		$('a.edit-link').on('click', function(e){
		e.preventDefault();
			var $parent = $(this).closest('div'); 
			$parent.find('p.message').hide();
			$parent.find('form.editForm').show();
			$parent.find('a.cancel').show();
			$(this).hide();
		});
		$('a.cancel').on('click', function(e){
			e.preventDefault();
			var $parent = $(this).closest('div'); 
			$parent.find('p.message').show();
			$parent.find('form.editForm').hide();
			$parent.find('a.edit-link').show();
			$(this).hide();
		});
	</script>
	<script>
	$(function () {
		$("#chkPassport").click(function () {
			if ($(this).is(":checked")) {
				$("#dvPassport").show();
			} else {
				$("#dvPassport").hide();
			}
		});
		$("#chkPassport1").click(function () {
			if ($(this).is(":checked")) {
				$("#dvPassport1").show();
			} else {
				$("#dvPassport1").hide();
			}
		});
		$("#chkPassport2").click(function () {
			if ($(this).is(":checked")) {
				$("#dvPassport2").show();
			} else {
				$("#dvPassport2").hide();
			}
		});
	});
	</script>