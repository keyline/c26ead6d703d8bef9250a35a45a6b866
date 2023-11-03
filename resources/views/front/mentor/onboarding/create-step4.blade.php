@extends('front.layouts.master', ['title'=> 'Mentor Signup', 'pageName' => 'mentor-signup-4'])
@section('content')
<link rel="stylesheet" type="text/css" href="<?=env('FRONT_ASSETS_URL')?>assets/css/bvselect.css">
<section class="mentor_element">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="metor_dashboard_top">
               <div class="metor_progess">
                  <div class="stepper-wrapper">
                     <div class="stepper-item first + completed"></div>
                     <div class="stepper-item  + completed"></div>
                     <div class="stepper-item  + completed">
                     </div>
                     <div class="stepper-item  + active">
                        <img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png" alt="logo">
                     </div>
                     <div class="last-counter stepper-item  + ">
                        <div class="progress-dot step-counter"></div>
                     </div>
                  </div>
                  <div class="me_probar"></div>
                  <!--<div class="met_prolight"><img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png" alt="logo"></div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="row justify-content-around">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="metor_dashboard">
               <div class="metor_information">
                  <h2>Great! Now let's set your availability</h2>
                  <p class="text-muted mb-4">Let your audience know when you're available. You can edit this later</p>
                  <div class="metor_step1_form">
                  @if ($errors->any())         
                     <div class="invalid-feedback d-block" role="alert">
                        <ul>                        
                           @foreach (json_decode($errors) as $file_index => $error)
                           <li>
                              <strong>{{$file_index.': '}} 
                              <ul>
                                 @foreach ($error as $error_item)
                                    <li>{{$error_item}}</li>
                                 @endforeach
                              </ul>
                              </strong>
                           </li>
                           @endforeach
                        </ul>
                        </div>
                  @endif
                     <form action="{{ route('mentor.create.step4') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="ant-col ant-col-24 add-slots">
                           @foreach($days AS $day)
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input chk__slots__show__hide" type="checkbox" name="day_of_week[{{ $day->id }}]" value="{{ $day->day }}" data-chkcontainer="{{ strtolower($day->day_text) }}" id="flexCheckChecked"
                                        {{ (in_array($day->day_index, [6,7])) ? 'checked' : '' }}>
                                       
                                       <label class="form-check-label" for="flexCheckChecked">
                                       
                                        {{ $day->day_text }}
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9 slots__parent">
                                 @if(in_array($day->day_index, [6,7]))
                                 <div class="slots-section">
                                    <div class="slots-select-box">
                                       <div class="slot_starttime">
                                          <select class="select2-frm" name="availability[from][{{ $day->id }}][]">
                                             @foreach($slot_dropdown AS $option)
                                             <option value="{{ $option['value'] }}" 
                                             {{ ($option['selected_from'] == $option['value']) ? 'selected' : '' }}>
                                              {{ $option['name'] }}</option>
                                             @endforeach
                                             <!-- <option value="1">12.00 AM</option>
                                             <option value="2">12.15 AM</option>
                                             <option value="3">12.30 AM</option>
                                             <option value="4">12.45 AM</option>
                                             <option value="5">1.00 AM</option>
                                             <option value="6">1.15 AM</option>
                                             <option value="7">1.30 AM</option>
                                             <option value="8">1.45 AM</option>
                                             <option value="9">2.00 AM</option> -->
                                          </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 1em;">-</div>
                                       <div class="slot_endtime">
                                          <select class="select2-to" name="availability[to][{{ $day->id }}][]">
                                             @foreach($slot_dropdown AS $option)
                                             <option value="{{ $option['value'] }}"
                                             {{ ($option['selected_to'] == $option['value']) ? 'selected' : '' }}>
                                             {{ $option['name'] }}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                       <button class="add-slot-btn add__slot__parent" data-container="{{ strtolower($day->day_text) }}"><span style="pointer-events: none;"><i class="fa-solid fa-plus"></i></span></button>
                                    </div>
                                    <!-- <div class="btn-apply-all"><a href="#">Apply To All</a></div> -->
                                    
                                 </div>
                                    @else
                                    <div class="ant-typography slots-unavailable">Unavailable</div>

                                    @endif
                                    <div class="slot__items__component" id="item-list-container-{{ strtolower($day->day_text) }}">
                                    </div>
                              </div>
                           </div>
                           @endforeach
                           
                        </div>
                        </br>
                        </br>
                        <label><small>(Any one of the document)</small></label>
                                               
                        @foreach($documents AS $document)                         
                        <div class="form-group pt-5">
                           <label>{{ $document->document }}</label>
                           <label><small>Max 1 mb in size and supported format (Jpg/Jpeg/pdf)</small></label>
                           <input type="file" class="form-control" name="docs_attachment[{{ $document->document }}]">
                        </div>
                        @endforeach
                        <div class="input-group mb-3">
                           <button class="next-btn">Next</button>
                           <!-- <a href="mentor3.html" class="next-btn">Finish</a> -->
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="rightside_testslider">
               <div class="login_sidebar_testimorial">
                  @include('front.elements.side-testimonial')
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@push('scripts')

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
@endpush