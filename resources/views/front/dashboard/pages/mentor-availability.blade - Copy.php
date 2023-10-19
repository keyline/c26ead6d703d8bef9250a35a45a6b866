<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
				<i class="fa-solid fa-bars"></i>
				</button>
				<h4 class="pagestitle-item mb-0">Availability</h4>
				<ul class="header-nav ms-auto"></ul>
			</div>
		</header>
		<div class="body flex-grow-1 px-3">
			<div class="container-lg">
				<div class="row">
					<div class="col-md-12">
						<div class="topAvailability_btn">
							<ul>
								<li><a href="#" class="btn">Default</a></li>
								<li><a href="#" class="btn newscheuld">+ New Schedule</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-12 col-lg-8">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body profile_cardbody">
								<div class="col-md-12">
									<div class="aftertop_part">
										<h3>Default</h3>
										<a href="#" class="myprof_btn">Save</a>
									</div>
								</div>
								<div class="ant-col ant-col-24 add-slots">
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
														<label for="chkPassport">
														<input class="form-check-input" type="checkbox" id="chkPassport" />
														Saturday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div id="dvPassport" class="slots-section" style="display: none">
												<div class="slots-select-box">
													<div class="slot_starttime">
														<select id="selectbox">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<div style="display: inline; margin: 0px 1em;">-</div>
													<div class="slot_endtime">
														<select id="selectbox2">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<label for="chkPassport">
														<input class="form-check-input" type="checkbox" id="chkPassport1" />
														Sunday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div id="dvPassport1" class="slots-section" style="display: none">
												<div class="slots-select-box">
													<div class="slot_starttime">
														<select id="selectbox3">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<div style="display: inline; margin: 0px 1em;">-</div>
													<div class="slot_endtime">
														<select id="selectbox4">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<label for="chkPassport">
														<input class="form-check-input" type="checkbox" id="chkPassport1" />
														Monday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div id="dvPassport1" class="slots-section" style="display: none">
												<div class="slots-select-box">
													<div class="slot_starttime">
														<select id="selectbox5">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<div style="display: inline; margin: 0px 1em;">-</div>
													<div class="slot_endtime">
														<select id="selectbox6">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
													<label class="form-check-label" for="flexCheckChecked">
													Tuesday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="slots-section">
												<div class="ant-typography slots-unavailable">Unavailable</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
													<label class="form-check-label" for="flexCheckChecked">
													Wednesday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="slots-section">
												<div class="ant-typography slots-unavailable">Unavailable</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
													<label class="form-check-label" for="flexCheckChecked">
													Thursday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="slots-section">
												<div class="ant-typography slots-unavailable">Unavailable</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
											<div class="col-md-4">
												<div class="slot_weeksday">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
														<label class="form-check-label" for="flexCheckChecked">
														Friday
														</label>
													</div>
												</div>
											</div>
											<div class="col-md-8">
												<div class="slots-section">
													<div class="ant-typography slots-unavailable">Unavailable</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4">
							<div class="card mb-4 text-white bg-whitebg">
								<div class="card-body ">
									<div class="col-md-12">
										<div class="aftertop_part mb-2">
											<h3>Block dates</h3>
										</div>
										<p>Add dates when you will be unavailable to take calls</p>
										<div class="afterblock_section">
											<div class="d-grid gap-2">
											<button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">Add unavailable dates</button>
											</div>
											<div class="metor_datenotwork">
												<ul>
													<li>
														<div class="date">13 December 2023</div>
														<div class="dateunavailable">unavailable</div>
														<div class="dateremove"><a href="#"><i class="fa-solid fa-trash"></i></a></div>
													</li>
													<li>
														<div class="date">20 December 2023</div>
														<div class="dateunavailable">unavailable</div>
														<div class="dateremove"><a href="#"><i class="fa-solid fa-trash"></i></a></div>
													</li>
													<li>
														<div class="date">31 December 2023</div>
														<div class="dateunavailable">unavailable</div>
														<div class="dateremove"><a href="#"><i class="fa-solid fa-trash"></i></a></div>
													</li>
													<li>
														<div class="date">13 December 2023</div>
														<div class="dateunavailable">unavailable</div>
														<div class="dateremove"><i class="fa-solid fa-trash"></i></div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Select date(s) you are unavailable on</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="#" class="row">
					<div class="col-md-12">
					<div id="inline_cal"></div>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>
</div>

<script>
   //const parentaddItmBtn= document.querySelectorAll('.add-slots > div');
   //const addItmBtn= document.querySelectorAll('.add-slot-btn');
   const addItmBtn= document.querySelectorAll('.slots__parent');
   //var selectItems = document.getElementsByClassName("slots-select-box");
   const addFromChkBtn= document.querySelectorAll('.form-check-input');
   //const slotList= document.querySelectorAll('.slots__parent');//slot__items__component

   const slotList = document.querySelectorAll('.slots__parent');

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


   const handleAddSlot = (e) =>{
      //add-slot-btn
      debugger;
         event.preventDefault();
         //event.stopPropagation();
         
   if (e.target.classList.contains('add__slot__parent')) {
      const postData= {
         'day': e.target.getAttribute("data-container"),
         'action': 'stumentoAjx__new__slot__can__be__removed'
      }
      //alert('clicked ' + postData.day);
      addSelectInput(postData).then((data) => {
         
         //const el= document.getElementById('item-list-container-' + data.containerIdentity);
         const el = document.querySelector('#item-list-container-' + data.containerIdentity);
         el.insertAdjacentHTML('beforeend', data.html);

      });
      
   }
      return;

      

   }
   const handleAddSlotFrmChkBtn= (e) => {
            const parent= e.target.closest('div > .row');

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
               iDiv.insertAdjacentHTML('afterbegin', data.html);
               //console.log({'parent' : element});
            });
         } else{
              if(! d)
              {
                  let slotSection =e.target.closest('.slot-item').querySelectorAll('.slots-section');
                  slotSection.forEach(el => {
                     el.remove();
                  });
                  //console.log({'is_it_available' : Object.keys(nestedElements).length});
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
     function initializeSelect2(selectElementObj) {
       selectElementObj.select2({
         width: "80%",
         tags: true
       });
     }

   //this will check for a click event and create new list item
   addItmBtn.forEach(item => {
      item.addEventListener("click", handleAddSlot);
         
   });


   //add slot event on check button
   addFromChkBtn.forEach(item => {
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
</script>