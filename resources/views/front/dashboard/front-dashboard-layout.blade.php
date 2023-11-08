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
    	<script src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>js/main.js"></script>
	 	
	 	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
      <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/jquery.loading.js"></script>
      <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/sweetalert2.all.min.js"></script>
      <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/common-function.js"></script>
      <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/stumento.js"></script>
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
	function toggleAnalytics(id){
		$("#author_bio_wrap" + id).slideToggle( "slow");
	}
</script>
<script>
	$(document).on('click', '.js-add2-row', function() { 
		//debugger;
	$('.function-table-2').append($('.function-table-2').find('.function-tr-2:last').clone());
	});
	$(document).on('click','.js-del2-row', function(event){
		// debugger;
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
<?php if(($pageName == 'user/mentor-availability')){?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	//Initialize select2 
	const noofslot= [
            {
             	"id": 1,
             	"text": 'x 1 slot',
            },
            {
                "id": 2,
                "text": 'x 2 slots'
            },
            {
                "id": 3,
                "text": 'x 3 slots'
            },
            {
                "id": 4,
                "text": 'x 4 slots'
            },
            {
                "id": 5,
                "text": 'x 5 slots'
            },
            {
                "id": 6,
                "text": 'x 6 slots'
            },
            {
                "id": 7,
                "text": 'x 7 slots'
            },
            {
                "id": 8,
                "text": 'x 8 slots'
            },
            {
                "id": 9,
                "text": 'x 9 slots'
            },
            {
                "id": 10,
                "text": 'x 10 slots',                
            },
            {
               "id": 11,
               "text": 'x 11 slots',
               // "selected": true,
            }
	        ];
	        const duration= [
	            {
	                "id": 30,
	                "text": '30 minutes',
	                "selected": true,
	            },
	            {
	                "id": 60,
	                "text": '60 minutes'
	                
	            }
	        ];

	$('.select2-frm').select2({
	    placeholder: "Select an time",
	    });

	    //$('.select2-to').select2();
	//const parentaddItmBtn= document.querySelectorAll('.add-slots > div');
	//const addItmBtn= document.querySelectorAll('.add-slot-btn');
	const addItmBtn= document.querySelectorAll('.slots__parent');
	//var selectItems = document.getElementsByClassName("slots-select-box");
	const addFromChkBtn= document.querySelectorAll('.form-check-input');
	//const slotList= document.querySelectorAll('.slots__parent');//slot__items__component

	const slotList = document.querySelectorAll('.slots__parent');


	const selectDuration = document.querySelectorAll('.select__slot__duration');

	const selectNumber = document.querySelectorAll('.select__no__ofslot');

	const selectTimeFrom = document.querySelectorAll('.select2-frm');

	const selectTimeTo= document.querySelectorAll('.select2-to');

	const applyToAllBtn= document.querySelectorAll('.btn-apply-all');

	const selections = {};




	//For adding items with add button

	//collect data that is inserted 
	const addSelectInput = (postData) => {
	  return fetch("{{route('mentor.timeslot.item')}}", {
	         method: 'POST',
	         headers: {
	            'Content-Type': 'application/json',
	            'X-Requested-With': 'XMLHttpRequest',
	            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	         },
	         body: JSON.stringify(postData)

	            })
	            .then(response => response.json())
	            .catch(error => {
	                console.error('Error fetching items:', error);
	            });

	}

	const updateOnChangeInput= (postData) => {
	   return fetch("{{route('mentor.timeslot.change')}}", {
	         method: 'POST',
	         headers: {
	            'Content-Type': 'application/json',
	            'X-Requested-With': 'XMLHttpRequest',
	            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	         },
	         body: JSON.stringify(postData)

	            })
	            .then(response => response.json())
	            .catch(error => {
	                console.error('Error fetching items:', error);
	            });
	}


	const handleAddSlot = (e) =>{
	   //add-slot-btn
	   // debugger;
	      event.preventDefault();
	      //event.stopPropagation();
	      //Delete apply to all button
	   const parent   = e.target.parentElement;
	      
	if (e.target.classList.contains('add__slot__parent')) {
	   const postData= {
	      'day': e.target.getAttribute("data-container"),
	      'action': 'stumentoAjx__new__slot__can__be__removed'
	   }
	   //alert('clicked ' + postData.day);
	   addSelectInput(postData).then((data) => {
	      
	      //const el= document.getElementById('item-list-container-' + data.containerIdentity);
	      //const el = document.querySelector('#item-list-container-' + data.containerIdentity);
	      //el.insertAdjacentHTML('beforeend', data.html);
	      //Creating parent Div
	      //const wrapEl= document.createElement('div');
	      //let classes= "slots_section_parent slots-select-box".split(' ');
	      //wrapEl.classList.add('slots_section_parent slots-select-box');
	      //wrapEl.classList.add(...classes);
	      //wrapEl.innerHtml= data.html;
	      parent.insertAdjacentHTML('afterend', '<div class="slots_section_parent slots-select-box">' + data.html + '</div>') ;
	      //parent.after(wrapEl);

	      $('.select2-frm').select2();
	      initializeDurationSelect2(duration);
	      initializeSlotNumberSelect2(noofslot);


	   });
	   
	}
	   return;

	   

	}
	const handleAddSlotFrmChkBtn= (e) => {
	   // debugger;
	         const parent= e.target.closest('div > .row');

	         let checkboxId= e.target.id;

	         let ids= checkboxId.split('_');

	         console.log(typeof ids[1]);

	         let divs= parent.children;

	         const d= collectionContains(divs, 'unavailable');

	         let nestedElements = e.target.closest('.slot-item').querySelectorAll('.slots-unavailable');

	         let el= e.target.closest('.slot-item').querySelector('.slots__parent');
	         const iDiv = document.createElement('div');
	            
	            iDiv.className = 'slots-section';
	            el.insertAdjacentElement('afterbegin', iDiv);
	            //el.appendChild(iDiv);
	   if(e.target.checked)
	      {
	         selections[e.target.id] = {
	            name: e.target.name,
	            value: e.target.value
	         };

	         //console.log({'divs': divs, 'is_txt': d, 'target': event.currentTarget});

	         if(d){
	            // Get all nested elements with the class "target-class"
	            
	            //console.log({'parentElem': nestedElements});
	            nestedElements.forEach(ele => {
	               ele.innerText="";
	            });
	         }
	         
	      
	         const postData= {
	            'day': e.target.getAttribute("data-chkcontainer"),
	            'action': 'stumentoAjx_new_slot_add'
	         }
	         
	         
	         
	         //.classList.add('invisible');
	         
	         addSelectInput(postData).then((data)=>{
	            //const el= e.currentTarget.querySelector('.slots-section');
	            //iDiv.appendChild(data.html);
	            iDiv.insertAdjacentHTML('afterbegin', '<div class="slots_section_parent slots-select-box">' + data.html + '</div>');
	            initializeDurationSelect2(duration);
	            initializeSlotNumberSelect2(noofslot);
	            //console.log({'parent' : element});
	            //add apply to all button if its index is 0
	            if(ids[1] == '0' && Object.keys(selections).length > 1){
	               const iDivApply = document.createElement('div');
	               const iAnchor = document.createElement('a');
	               //adding class
	               iDivApply.classList.add('btn-apply-all');
	               iAnchor.href= '#';
	               iAnchor.appendChild(document.createTextNode('Apply To All'));
	               iDivApply.appendChild(iAnchor);
	      
	               iDiv.appendChild(iDivApply);
	            }
	         });
	      } else{
	         delete selections[e.target.id];
	           if(! d)
	           {
	               let slotSection =e.target.closest('.slot-item').querySelectorAll('.slots-section');
	               slotSection.forEach(el => {
	                  el.remove();
	               });
	               
	               if(Object.keys(nestedElements).length === 0)
	               {
	                  //create element
	                  const iDivUnavailable = document.createElement('div');
	                  let classes= "ant-typography slots-unavailable".split(' ');
	                  iDivUnavailable.classList.add(...classes);
	                  iDivUnavailable.innerText= 'Unavailable';
	                  console.log({'unavailableDiv': iDivUnavailable});
	                  el.insertAdjacentElement('afterbegin', iDivUnavailable);



	               }else{
	                  nestedElements.forEach(ele => {
	               ele.innerText="Unavailable";
	            });
	               }
	               
	           }
	           //updating state of apply to button
	           //if(Object.keys(selections).length === 1 && )
	           
	      }
	      //return false;

	   
	}

	const handleDeleteSlot = (e) =>{
	   //alert("You clicked me!");                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
	   // if user clicks on delete item, find and remove the parent article
	   if (e.target.classList.contains('deleteItem')) {
	      
	       //const list= e.currentTarget.parentElement;
	       const parent = e.target.parentNode;
	        //const list= e.currentTarget.querySelector('.slots_section_parent');

	        //list.removeChild(list.lastChild);
	        parent.remove();
	        //updateLocalCartLocalStorage(<id>);
	    } else {
	        return;
	    }
	    

	};
	function collectionContains(collection, searchText) {
	    for (var i = 0; i < collection.length; i++) {
	        if( collection[i].innerText.toLowerCase().indexOf(searchText) > -1 ) {
	            return true;
	        }
	    }
	    return false;
	}

	//function to initialize select2
	const initializeDurationSelect2 = (duration) => {
	   // debugger;
	        
	        $('.select__slot__duration').select2({
	            data: duration,
	        });

	        

	   
	  }

	  const initializeSlotNumberSelect2 = (noofslot) => {
	        
	        $('.select__no__ofslot').select2({
	            data: noofslot,
	        });

	    
	  }

	  
	  
	  const handleCalculateTimeFrame= (e) => {

	    //if (e.target.classList.contains('deleteItem')) 
	    

	  }

	  const handleDurationChange= (e) =>{
	   // debugger;
	        //console.log("changed automatically", e.params.data);
	        if(e.target.classList.contains('select__slot__duration')) {
	            var targetEl= e.params.data;
	            var currentInstance= $(e.target).data('select2');;
	            var fromTimeEl= $(e.target).parent().parent().find('.select2-frm');
	            var slotEl= $(e.target).parent().parent().find('.select__no__ofslot');
	            var endTimeEl= $(e.target).parent().parent().find('.slot__endtime__txt');

	            var fromTimeData= $(fromTimeEl).find(':selected').val();
	            var slotData= $(slotEl).find(':selected').val();
	            var endTimeData= $(endTimeEl).val();

	            var currentDayEl= $(e.target).closest('div.slot-item');
	            
	            var currentDay= $(currentDayEl).find('input[type="checkbox"]').val();

	        }else{
	         return;
	        }

	        //console.log({'one': targetEl.id, 'two': fromTimeData, 'three': slotData, 'four': endTimeData});
	        const postData= {
	         'day': currentDay,
	         'fromTime': fromTimeData,
	         'duration': targetEl.id,
	         'slots'  : slotData,
	         'endTime' : endTimeData,
	         'action' : 'stumento__ajax__update__slot'
	        };
	        updateOnChangeInput(postData).then((data) => {
	         parentEl= $(e.target).closest('div.slots-select-box');
	         $(parentEl).html(data.html);
	         $('.select2-frm').select2();
	         //initialize
	         initializeDurationSelect2(data.durations);
	         
	         
	         
	         //initialize
	         initializeSlotNumberSelect2(data.slots);
	         
	        });


	  }

	  const handleChangeNoOfSlots = (e) => {
	        //console.log("changed automatically", e.params.data);
	        if(e.target.classList.contains('select__no__ofslot')){
	            //collect data from origin
	            var targetEl= e.params.data;
	            var fromTimeEl= $(e.target).parent().parent().find('.select2-frm');
	            var durationEl= $(e.target).parent().parent().find('.select__slot__duration');
	            var endTimeEl= $(e.target).parent().parent().find('.slot__endtime__txt');

	            var fromTimeData= $(fromTimeEl).find(':selected').val();
	            var durationData= $(durationEl).find(':selected').val();
	            var endTimeData= $(endTimeEl).val();
	            var currentDayEl= $(e.target).closest('div.slot-item');
	            
	            var currentDay= $(currentDayEl).find('input[type="checkbox"]').val();
	            
	            
	        }else{
	         return;
	        }
	        console.log({'one': targetEl.id, 'two': durationData, 'three': fromTimeData, 'four': endTimeData});
	        const postData= {
	         'day': currentDay,
	         'fromTime': fromTimeData,
	         'duration': durationData,
	         'slots'  : targetEl.id,
	         'endTime' : endTimeData,
	         'action' : 'stumento__ajax__update__slot'
	        };
	        updateOnChangeInput(postData).then((data) => {
	         parentEl= $(e.target).closest('div.slots-select-box');
	         $(parentEl).html( data.html );
	         $('.select2-frm').select2();
	         initializeDurationSelect2(data.durations);
	         initializeSlotNumberSelect2(data.slots);
	        });

	  }

	  function handleChangeTimeFrom (e) {
	      // debugger;
	    
	        if(e.target.classList.contains('select2-frm')){
	            //collect data from origin
	            var targetEl= e.params.data;
	            var durationEl= $(e.target).parent().parent().find('.select__slot__duration');
	            var slotEl= $(e.target).parent().parent().find('.select__no__ofslot');
	            var endTimeEl= $(e.target).parent().parent().find('.slot__endtime__txt');
	            var currentDayEl= $(e.target).closest('div.slot-item');
	            
	            var currentDay= $(currentDayEl).find('input[type="checkbox"]').val();

	            var durationData= $(durationEl).find(':selected').val();
	            var slotData= $(slotEl).find(':selected').val();
	            var endTimeData= $(endTimeEl).val();
	            
	            
	        }else{
	         return;
	        }
	        console.log({'one': targetEl.id, 'two': durationData, 'three': slotData, 'four': endTimeData});
	        const postData= {
	         'day': currentDay,
	         'fromTime': targetEl.id,
	         'duration': durationData,
	         'slots'  : slotData,
	         'endTime' : endTimeData,
	         'action' : 'stumento__ajax__update__slot'
	        };
	        updateOnChangeInput(postData).then((data) => {
	         parentEl= $(e.target).closest('div.slots-select-box');
	         $(parentEl).html('<div class="slots_section_parent slots-select-box">' + data.html + '</div>');
	         $('.select2-frm').select2();
	         //$('.select2-frm').val(data.selectedTimeFrom);
	         //$('.select2-frm').trigger('change');
	         initializeDurationSelect2(data.durations);
	         initializeSlotNumberSelect2(data.slots);
	        });

	  }

	  const handleApplyToAllBtn = (e) =>{
	   debugger;
	      let elList = e.target.closest('.slot-item').querySelectorAll('.slots-section');
	      const lastItem= elList[elList.length -1];
	      //elList.forEach(el => el.style.display = "none");
	      //alert("clock");
	  }

	  

	//this will check for a click event and create new list item
	addItmBtn.forEach(item => {
	   item.addEventListener("click", handleAddSlot, false);
	      
	});


	//add slot event on check button
	addFromChkBtn.forEach(item => {
	   if(item.checked){
	      selections[item.id] = {
	            name: item.name,
	            value: item.value
	         };
	   }
	   
	   item.addEventListener("click", handleAddSlotFrmChkBtn);
	});

	//check/uncheck item event
	// parentaddItmBtn.forEach((item) => {

	//    item.addEventListener('click', handleChkBtnAddSlot);
	// });

	//delete item event
	slotList.forEach((slot) => {
	   slot.addEventListener('click', handleDeleteSlot);
	});

	document.addEventListener("DOMContentLoaded", (event) => {
	    console.log("DOM fully loaded and parsed");
	    
	    //initializeSlotNumberSelect2(noofslot);

	    //initializeDurationSelect2(duration);


	});

	    selectDuration.forEach((item) =>{
	        item.addEventListener("DOMContentLoaded", initializeDurationSelect2(duration), false);
	    });

	    selectNumber.forEach((item) =>{
	        item.addEventListener("DOMContentLoaded", initializeSlotNumberSelect2(noofslot), false);
	    });

	    $(document.body).on('select2:select','.select__slot__duration', handleDurationChange);

	    $(document.body).on('select2:select', '.select__no__ofslot',handleChangeNoOfSlots);


	    $(document.body).on('select2:select','.select2-frm', handleChangeTimeFrom);

	    applyToAllBtn.forEach(el => {
	         el.addEventListener('click', handleApplyToAllBtn, false);
	    })

	   $('#document_head').change(function(e){
	      
	      var select=$(this).find(':selected').val();
	      $('.hide').hide();
	      $('#' + select).show();
	   });
    
</script>
<?php } ?>