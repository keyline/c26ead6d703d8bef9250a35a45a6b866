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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>vendors/simplebar/js/simplebar.min.js"></script>
    <script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>js/main.js"></script>
    
   </body>
</html>
   <script type="text/javascript">
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
		document.addEventListener("DOMContentLoaded", function() {
				var demo1 = new BVSelect({
				selector: "#selectbox",
				searchbox: false,
				offset: false
				});
			var demo2 = new BVSelect({
				selector: "#selectbox2",
				searchbox: false,
				offset: false
				});
			var demo3 = new BVSelect({
				selector: "#selectbox3",
				searchbox: false,
				offset: false
				});
			var demo4 = new BVSelect({
				selector: "#selectbox4",
				searchbox: false,
				offset: false
				});
			var demo5 = new BVSelect({
				selector: "#selectbox5",
				searchbox: false,
				offset: false
				});
			var demo6 = new BVSelect({
				selector: "#selectbox6",
				searchbox: false,
				offset: false
				});
				
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
   <script>
      $(function() {
         rome(inline_cal, { time: false });
      });
   </script>